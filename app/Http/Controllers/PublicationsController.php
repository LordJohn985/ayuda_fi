<?php

namespace App\Http\Controllers;

use App\Application;
use App\Calification;
use App\Category;
use App\City;
use App\Http\Controllers\Controller;
use App\Mail\mailToCandidate;
use App\Mail\mailToCreator;
/*use App\Mail\myMailable;*/
use App\Postulation;
use App\Publication;
use App\User;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Session\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;




class PublicationsController extends Controller
{

    #CREATE
    public function getCreatePublication(){
        $user = User::withTrashed()->find(auth::id());
        /*$publications = Publication::all();*/
        if($user->credits<1){
            $errors='No se puede crear una gauchada debido a que no te quedan créditos';
            \Session::flash('error', $errors);
            /*return view('home', compact('publications'));*/
            return Redirect::to('/');
        }
        $calificationsRemaining = Publication::where('publications.user_id', '=', $user->id)->join('califications', 'califications.publication_id', '=', 'publications.id')->where('label_id', '=', 1)->count();
        if($calificationsRemaining!=0){
            $errors='No se puede crear una gauchada debido a que tienes calificaciones pendientes.';
            \Session::flash('error', $errors);
            /*return view('home', compact('publications'));*/
            return Redirect::to('/');
        }
        $publicationIsNew = true;
        return view('pages.admin.publications.single' ,compact('publicationIsNew'));

    }

    public function postCreatePublication(Request $request){

        if(!Auth::check()){
            Redirect::to('/login');
        }
        #VALIDATE DATA
        $rules = [
            'title' => 'required|max:255',
            'category' => 'required|exists:categories,id',
            'publication_city' => 'required|exists:cities,id',
            'finish_date' => 'required|date|after:tomorrow',
        ];

        $fields = [
            'title' => $request->title,
            'category' => $request->category,
            'publication_city' => $request->city,
            'finish_date' => $request->finish_date,

        ];
        $validator = \Illuminate\Support\Facades\Validator::make($fields, $rules);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            \Session::flash('error', implode(',',$errors));
            $publicationIsNew = true;
            return view('pages.admin.publications.single' ,compact('publicationIsNew','errors'));
        }

        #CREATE PUBLICATION
        $publication = new Publication();
        $publication->title = $request->title;
        $publication->finish_date = $request->finish_date;
        $publication->content = $request->body_content;
        $publication->city_id = $request->city;
        $publication->title = $request->title;
        $publication->category_id = $request->category;
        $publication->image = '/images/publications/default_publication_pic.jpg';
        $publication->user_id = Auth::user()->id;

        #CHARGE PUBLICATION COST
        $user = User::findOrFail(Auth::user()->id);
        $user->credits --;
        try{
            $user->save();
            $success = 'Se cargó el costo de crear la publicación.';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $error = 'No se cargó el costo de crear la publicación.';
            \Session::flash('error', $error);
        }

        #SAVE PUBLICATION
        try{
            $publication->save();
            $success = 'La gauchada se creó con éxito.';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $error = 'No se pudo crear la gauchada.';
            \Session::flash('error', $error);
        }

        #STORE UPLOADED IMAGE
        if( $request->hasFile('image') ) {
            $file = $request->file('image');
            // Now you have your file in a variable that you can do things with
            $name = 'publication'.$publication->id.'.png';
            $path = '/storage/publications/'.$name;
            try{
                $publication->image=$path;
                $publication->save();
                $success = 'La gauchada se creó con éxito.';
                \Session::flash('success', $success);
                Storage::disk('public')->put('/publications/'.$name, file_get_contents($file));
            }catch (\PDOException $e){
                $error = 'No se pudo guardar la imagen de la gauchada.';
                \Session::flash('error', $error);
            }
        }

        $publications = Publication::all();
        return Redirect::to('/');

    }

    #READ
    public function getListPublication(){

        $publications = Publication::with('user')->paginate(5);
        return view("pages.admin.publications.list", compact("publications"));
    }

    public function getShowPublication($publicationId){
        $publication = Publication::withTrashed()->find($publicationId);
        $publicationIsExpired = $publication->finish_date < Carbon::now();
        $canSomeoneAply = !(($publication->finish_date < Carbon::now()) || (Calification::where('publication_id','=', $publicationId)->count()!==0));
        $questionsAll = Question::where('publication_id','=', $publicationId)->get();
        $userIsLoggedIn = auth::check();
        if($userIsLoggedIn){
            $userIsCreator = $publication->user->id == auth::id();
            if($userIsCreator){
                #view returned to a logged user who is the creator of the publication
                $candidates = Postulation::where('publication_id', $publicationId)->join('users','users.id','=','postulations.user_id')->get();
                $candidateSelected = Calification::where('publication_id','=', $publicationId)->join('users', 'users.id', '=', 'califications.user_id')->get();
                $candidateIsRated =  Calification::where('publication_id','=', $publicationId)->first();
                return view("pages.admin.publications.showToCreator", compact("candidates", "candidateSelected", "candidateIsRated", "publication", "publicationIsExpired", "questionsAll"));

            }else {
                #view returned to a logged user who is no the creator of the publication
                $userIsCandidate = Postulation::where('publication_id','=', $publicationId)->where('user_id','=', auth::id())->get();

                $userMadeQuestion = Question::where('publication_id','=', $publicationId)->where('user_id','=', auth::id())->get();

                return view("pages.public.publications.showToUser", compact("userIsCandidate", "canSomeoneAply", "publication", "userMadeQuestion"));
            }
        }
        #view returned to a visitor, who is not logged into the system
        return view("show", compact("publication", "canSomeoneAply",'questionsAll'));
    }

    #UPDATE
    public function getUpdatePublication($publicationId){
        try{
            $publication=Publication::findOrFail($publicationId);
            if(Auth::id()!=$publication->user_id){
                $error='No puedes editar esta gauchada';
                \Session::flash('error',$error);
                return Redirect::to('/');
            }
            if(count($publication->postulations)!=0){
                $error='No puedes editar esta gauchada porque tiene postulantes';
                \Sesssion::flash('error',$error);
                return Redirect::to('/dashboard/publications/show/'.$publicationId);
            }
            $publicationIsNew=false;
            return view('pages.admin.publications.single',compact('publication','publicationIsNew'));
        }
        catch(ModelNotFoundException $e){
            $error='La gauchada no existe';
            \Session::flash('error',$error);
            return Redirect::to('/');
        }
    }

    public function postUpdatePublication($publicationId,Request $request){
        if(!Auth::check()){
            Redirect::to('/login');
        }
        #VALIDATE DATA
        $rules = [
            'title' => 'required|max:255',
            'category' => 'required|exists:categories,id',
            'publication_city' => 'required|exists:cities,id',
            'finish_date' => 'required|date|after:tomorrow',
            'description'=>'required|string',
        ];

        $fields = [
            'title' => $request->title,
            'category' => $request->category,
            'publication_city' => $request->city,
            'finish_date' => $request->finish_date,
            'description'=>$request->body_content,
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($fields, $rules);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            \Session::flash('error', implode(',',$errors));
            $publicationIsNew = false;
            return view('pages.admin.publications.single' ,compact('publicationIsNew','errors'));
        }
        try{
            $publication=Publication::findOrFail($publicationId);
            $publication->title = $request->title;
            $publication->finish_date = $request->finish_date;
            $publication->content = $request->body_content;
            $publication->city_id = $request->city;
            $publication->title = $request->title;
            $publication->category_id = $request->category;
            if($request->hasFile('image')){
                $file = $request->file('image');
                $name = 'publication'.$publication->id.'.png';
                $path = '/storage/publications/'.$name;
                $publication->image=$path;
                Storage::disk('public')->put('/publications/'.$name, file_get_contents($file));
            }
            try{
                $publication->save();
                $success = 'Gauchada editada';
                \Session::flash('success', $success);
            }catch (\PDOException $e){
                $error = 'La gauchada no ha podido ser editada';
                \Session::flash('error', $error);
                return Redirect::to("/");
            }
            if( $request->hasFile('image') ) {
               $file = $request->file('image');
                // Now you have your file in a variable that you can do things with
                $name = 'publication'.$publication->id.'.png';
                $path = '/storage/publications/'.$name;
                try{
                    $publication->image=$path;
                    $publication->save();
                    $success = 'Gauchada editada';
                    \Session::flash('success', $success);
                    Storage::disk('public')->put('/publications/'.$name, file_get_contents($file));
                }catch (\PDOException $e){
                    $error = 'La gauchada no ha podido ser editada';
                    \Session::flash('error', $error);
                }
            }
        }
        catch(ModelNotFoundException $e){
            $error='No se ha encontrado la gauchada';
            \Session::flash('error',$error);
        }
        return Redirect::to('/dashboard/publications/show/'.$publicationId);
    }

    #DELETE
    public function getDeletePublication($publicationId){

}

    #APLY
    public function postAplyPublication($publicationId, Request $request){

        $publications = Publication::all();

        #VALIDATE DATA
        $rules = [
            'comment' => 'required|max:255',
        ];

        $fields = [
            'comment' => $request->comment,
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($fields, $rules);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            \Session::flash('error', implode(',',$errors));
            return Redirect::to('/dashboard/publications/show/'.$publicationId ,compact('errors'));
        }

        #CREATE POSTULATION
        $postulation = new Postulation();
        $postulation->publication_id=$publicationId;
        $postulation->user_id=auth::id();
        $postulation->comment=$request->comment;
        \Log::info($postulation);


        #SAVE POSTULATION
        try{
            $postulation->save();
            $success = 'Te postulaste exitosamente a la gauchada '.Publication::find($publicationId)->title;
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $errors = 'No pudiste postularte debido a un error del sistema. Intentalo nuevamente';
            \Session::flash('error', $errors);
            return Redirect::to('/dashboard/publications/show/'.$publicationId ,compact('errors'));

        }

        return Redirect::to('/dashboard/publications/show/'.$publicationId);
    }


    #SELECT CANDIDATE
    public function getSelectCandidate($userId, $publicationId){

        $publications = Publication::all();

        #CREATE CANDIDACY
        $calification = new Calification();
        $calification->publication_id=$publicationId;
        $calification->user_id=$userId;

        #SAVE CANDIDACY
        try{
            $calification->save();
            Mail::to($calification->user)->send(new mailToCandidate(Auth::user()));
            Mail::to(Auth::user())->send(new mailToCreator($calification->user, $calification->publication));
            $success = 'Has elegido un postulante. Se les enviará un mail con los datos de cada uno para que se pongan en contacto.';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $errors = 'No se pudo hacer la selección del postulante, vuelve a intentarlo.';
            \Session::flash('error', $errors);
            return Redirect::to('/dashboard/publications/show/'.$publicationId, compact('errors'));
        }

        return Redirect::to('/dashboard/publications/show/'.$publicationId);
    }

    #RATE CANDIDATE
    public function postRateCandidate($publicationId, Request $request)
    {

        if ($request->label == 1){
            $error = 'Debes elegir una etiquéta válida para calificar.';
            \Session::flash('error', $error);
            return Redirect::to('/dashboard/publications/show/'.$publicationId);
        }
        #UPDATE CANDIDACY
        $calification = Calification::where('publication_id', '=', $publicationId)->first();
        $calification->content = $request->comment;
        $calification->label_id = $request->label;

        #SAVE CANDIDACY
        try{
            $calification->save();
            $this->updateUserOnCalification($calification);
            $publication = Publication::find($publicationId);
            $publication->delete();
            $success = 'El usuario fue calificado exitosamente.';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $errors = 'El usuario no se pudo calificar';
            \Session::flash('error', $errors);
            return Redirect::to('/dashboard/publications/show/'.$publicationId, compact('errors'));
        }
        return Redirect::to('/dashboard/publications/show/'.$publicationId);
    }

    public function updateUserOnCalification($calification)
    {
        $publicationId = $calification->publication;
        if($calification->label->name == 'positivo'){
            #BUSINESS RULES WHEN CALIFICATION IS POSITIVE
            $usuario = User::find($calification->user_id);
            $usuario->score += 2;
            $usuario->credits ++;
            try{
                $usuario->save();
                $success = 'Se calificó de forma positiva';
                \Session::flash('success', $success);
            }catch (\PDOException $e){
                $errors = 'No se pudo calificar positivo';
                \Session::flash('error', $errors);
                return Redirect::to('/dashboard/publications/show/'.$publicationId, compact('errors'));
            }
        }elseif($calification->label->name == 'negativo'){
            #BUSINESS RULES WHEN CALIFICATION IS NEGATIVE
            $usuario = User::find($calification->user_id);
            $usuario->score --;
            try{
                $usuario->save();
                $success = 'Se calificó de forma negativa';
                \Session::flash('success', $success);
            }catch (\PDOException $e){
                $errors = 'No se pudo calificar negativo';
                \Session::flash('error', $errors);
                return Redirect::to('/dashboard/publications/show/'.$publicationId, compact('errors'));
            }
        }
    }

    public function getHome()
    {
        $hasFilter = false;
        if(Auth::check()){
            $publications = Publication::all()->where('finish_date', '>=', Carbon::now());
            return view('home', compact('publications', 'hasFilter'));
        }else{
            $publications = Publication::all()->where('finish_date', '>=', Carbon::now());
            return view('welcome', compact('publications', 'hasFilter'));
        }
    }

    public function postFilterPublications(Request $request)
    {

        if ($request->title!=null){
            $filterTitle = $request->title;
            $publications = Publication::where([['finish_date', '>=', Carbon::now()],['title', 'LIKE', "%$filterTitle%"]])->get();
        }
        else{
            $publications = Publication::all()->where('finish_date', '>=', Carbon::now());
        }
        if ($request->category!="all"){
            $filterCategory = $request->category;
            $publications = $publications->where('category_id', '=', $request->category);
        }
        if ($request->city!="all"){
            $filterCity = $request->city;
            $publications = $publications->where('city_id', '=', $request->city);
        }

        $hasFilter = true;

        if(Auth::check()){
            return view('home', compact('publications', 'hasFilter', 'filterCategory', 'filterCity', 'filterTitle'));
        }else{
            return view('welcome', compact('publications', 'hasFilter', 'filterCategory', 'filterCity', 'filterTitle'));
        }
    }

    public function setOriginalPhoto($publicationId){
        try {
            $publication=Publication::findOrFail($publicationId);
            if(Auth::id()!=$publication->user_id){
                $error='No tienes permiso para editar esta gauchada';
                \Session::flash('error',$error);
            }
            else{
                $publication->image='/images/publications/default_publication_pic.jpg';
                try {
                    $publication->save();
                    $success='Foto original puesta';
                    \Session::flash('success',$success);
                } catch (\PDOException $e) {
                    $error='No se ha podido borrar la foto';
                    \Session::flash('error',$error);
                }
            }
        } catch (ModelNotFoundException $e) {
            $error='No se ha podido borrar la foto';
            \Session::flash('error',$error);
        }
        return Redirect::to('/dashboard/publications/show/'.$publicationId);
    }

}
