<?php

namespace App\Http\Controllers;

use App\Application;
use App\Calification;
use App\Category;
use App\City;
use App\Http\Controllers\Controller;
use App\Mail\mailToCandidate;
use App\Mail\mailToCreator;
use App\Mail\mailToCandidateOnDelete;
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
use Illuminate\Support\Facades\DB;

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

        try{
            $category=Category::findOrFail($request->category);
            if($category->active<1){
                $error='La categoria se encuentra deshabilitada';
                \Session::flash('error',$error);
                $publicationIsNew = true;       
                return view('pages.admin.publications.single' ,compact('publicationIsNew','errors','publication'));
            }
        }catch(ModelNotFoundException $e){
            $error='La categoria no existe';
            \Sesssion::flash('error',$error);
            $publicationIsNew = true;
            return view('pages.admin.publications.single' ,compact('publicationIsNew','errors','publication'));
        }

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
        $publicationIsExpired = (($publication->finish_date < Carbon::now())||($publication->deleted_at!==null));
        $canSomeoneAply = !(($publication->finish_date < Carbon::now()) || (Calification::withTrashed()->where('publication_id','=', $publicationId)->count()!==0)||($publication->deleted_at!==null));
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
                $myId= Auth::id();
                $userIsCandidate = Postulation::where('publication_id','=', $publicationId)->where('user_id','=', auth::id())->get();
                /*$userMadeQuestion = Question::where('publication_id','=', $publicationId)->where('user_id','=', auth::id())->get();*/
                return view("pages.public.publications.showToUser", compact("userIsCandidate", "canSomeoneAply", "publication", "myId"));
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
                \Session::flash('error',$error);
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

        #GET ALL CANDIDATES
        $candidates = Postulation::where('publication_id', $publicationId)->join('users','users.id','=','postulations.user_id')->get();

        if($candidates->count() == 0){
            $usuario = User::find(auth::id());
            $usuario->credits++;
            \Log::info($usuario);

            try{
                $usuario->save();
            }catch (\PDOException $e){
                $errors = 'No se pudo eliminar gauchada';
                \Session::flash('error', $errors);
                /*return view('home' ,compact('errors', 'publications'));*/
                return Redirect::to('/');
            }

        }else{
                #REPORTING FROM THE DELETE TO THE CHOSEN
                $candidateSelected = Calification::where('publication_id','=', $publicationId)->join('users', 'users.id', '=', 'califications.user_id')->get();
                $publication = Publication::find($publicationId);
                if($candidateSelected->count() > 0 && $publication->finish_date >= Carbon::now()){
                    #ENVIAR MAIL DEL BORRADO A ELEGIDO
                    Mail::to($candidateSelected->first())->send(new mailToCandidateOnDelete($publication));
                }

        }

        #DELETE PUBLICATION
        $publications = Publication::all();
        try{
            #GET PUBLICATION
            $publication = Publication::find($publicationId)->delete();
            \Log::info($publication);
            $success = 'Eliminaste exitosamente la gauchada';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $errors = 'No pudimos eliminar la gauchada debido a un error del sistema. Intentalo nuevamente';
            \Session::flash('error', $errors);
        }
        return Redirect::to('/');
    }

    #APLY
    public function postAplyPublication($publicationId, Request $request){

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

    public function postQuitAplyPublication($publicationId){
        $postulation = Publication::find($publicationId)->postulations->where('user_id', '=', Auth::id())->first();
        try{
            $postulation->delete();
            $success = 'La postulación ha sido borrada';
            \Session::flash('success', $success);
        }catch(\PDOException $e){
            $errors = 'La postulación no pudo cancelarse, vuelve a intentarlo.';
            \Session::flash('error', $errors);
            return back()->withInput()->with($errors);
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
            Mail::to($calification->user)->send(new mailToCandidate(Auth::user(), $calification->publication));
            Mail::to(Auth::user())->send(new mailToCreator($calification->user, $calification->publication));
            $success = 'Has elegido un postulante. Se les enviará un mail con los datos de cada uno para que se pongan en contacto.';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $errors = 'No se pudo hacer la selección del postulante, vuelve a intentarlo.';
            \Session::flash('error', $errors);
        }
        return Redirect::to('/dashboard/publications/show/'.$publicationId);
    }

    #RATE CANDIDATE
    public function postRateCandidate($publicationId, Request $request)
    {
        $comment = $request->comment;
        if ($request->label == 1){
            $error = 'Debes elegir una etiquéta válida para calificar.';
            \Session::flash('error', $error);
            /*return Redirect::to('/dashboard/publications/show/'.$publicationId);*/
            return back()->withInput()->with($comment);
        }
        #UPDATE CANDIDACY
        $calification = Calification::where('publication_id', '=', $publicationId)->first();
        $calification->content = $request->comment;
        $calification->label_id = $request->label;

        #SAVE CANDIDACY
        try{
            $calification->save();
            $this->updateUserOnCalification($calification);
            /*$publication = Publication::find($publicationId);
            $publication->delete();*/
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
                return Redirect::to('/dashboard/publications/show/'.$publicationId);
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
                return Redirect::to('/dashboard/publications/show/'.$publicationId);
            }
        }
    }

    public function getHome()
    {
        $hasFilter = false;
        $califications=Calification::select('publication_id')->get();
        $publications = Publication::where('finish_date', '>=', Carbon::now())->whereNotIn('id',$califications)->get();
        if(Auth::check()){
            return view('home', compact('publications', 'hasFilter'));
        }else{
            return view('welcome', compact('publications', 'hasFilter'));
        }
    }

    public function postFilterPublications(Request $request)
    {

        if ($request->title!=null){
            $filterTitle = $request->title;
            $publications = Publication::where([['finish_date', '>=', Carbon::now()],['title', 'LIKE', "%$filterTitle%"]])->has('calification','<=',0)->get();
        }
        else{
            $publications = Publication::where('finish_date', '>=', Carbon::now())->has('calification','<=',0)->get();
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

    public function getUserPublications($userId){
        try{
            $user=User::findOrFail($userId);
            $publications=Publication::where('user_id','=',$userId)->get();
            $hasFilter=false;
            return view('pages.admin.users.publications',compact('publications','hasFilter','user'));
        }
        catch(\ModelNotFoundException $e){
            $error='El usuario no existe';
            \Session::flash('error',$error);
            return Redirect::to('/');
        }
    }

    public function postFilterUserPublications(Request $request){
        try{
            $user=User::findOrFail($request->user);
            $state=$request->state;
            if($state=='all'){
                $hasFilter=false;    
                $publications=Publication::all()->where('user_id','=',$request->user);
            }
            else{
                $hasFilter=true;
                switch ($state){
                    case 1:
                        $partialQ=Publication::join('califications','publications.id','=','califications.publication_id')->where('label_id','=',1)->where('publications.user_id','=',$request->user)->select('publications.id')->get();
                        $publications=Publication::whereIn('id',$partialQ)->orWhere('user_id','=',$request->user)->where('finish_date','>',Carbon::now())->get();
                        break;
                    case 2:
                        $partialQ=Calification::join('publications','publications.id','=','califications.publication_id')->where('label_id','>',1)->where('publications.user_id','=',$request->user)->select('publications.id')->get();
                        $publications=Publication::whereIn('id',$partialQ)->get();
                        break;
                    case 3:
                        $publications=Publication::where('finish_date','<=',Carbon::now())->where('user_id','=',$request->user)->get();
                        break;
                }
            }
            return view('pages.admin.users.publications', compact('publications', 'hasFilter','user','state'));
        }
        catch(\ModelNotFoundException $e){
            $error='El usuario no existe';
            \Session::flash('error',$error);
            return Redirect::to('/');
        }
    }

    public function getUserPostulations($userId){
        if(Auth::id()!=$userId){
            $error='No tienes permisos para ver las postulaciones de este usuario';
            \Session::flash('error',$error);
            return Redirect::to('/');
        }
        try{
            $publications=Postulation::where('user_id','=',$userId)->select('publication_id')->get();
            $postulations=Publication::whereIn('id',$publications)->get();
            $user=User::findOrFail($userId);
            $hasFilter=false;
            return view('pages.admin.users.postulations', compact('postulations','hasFilter','user'));
        }
        catch(ModelNotFoundException $e){
            $error='El usuario no existe';
            \Session::flash('error',$error);
            return Redirect::to('/');
        }
    }

    public function postFilterUserPostulations(Request $request){
        if(Auth::id()!=$request->user){
            $error='No tienes permisos para ver las postulaciones de este usuario';
            \Session::flash('error',$error);
            return Redirect::to('/');
        }
        try{
            $state=$request->state;
            if($state=='all'){
                $hasFilter=false;
                $publications=Postulation::where('user_id','=',$request->user)->select('publication_id')->get();
                $postulations=Publication::whereIn('id',$publications)->get();
            }
            else{
                $hasFilter=true;
                if($state>1){
                    $partialQ=Postulation::where('user_id','=',$request->user)->select('publication_id')->get();
                }
                switch ($state) {
                    case 1:
                        $partialQ=Calification::where('user_id','=',$request->user)->select('publication_id')->get();
                        $postulations=Publication::whereIn('publications.id',$partialQ)->get();
                        break;
                    case 2:
                        $partialQ1=Calification::whereIn('publication_id',$partialQ)->where('user_id','<>',$request->user)->select('publication_id')->get();
                        $postulations=Publication::whereIn('publications.id',$partialQ1)->get();
                        break;
                    case 3:
                        $postulations=Publication::whereIn('id',$partialQ)->has('calification','<=',0)->get();
                        break;
                }
            }
            $user=User::findOrFail($request->user); 
            return view('pages.admin.users.postulations', compact('postulations','hasFilter','user','state'));
        }
        catch(ModelNotFoundException $e){
            $error='El usuario no existe';
            \Session::flash('error',$error);
            return Redirect::to('/');
        }  
    }

    public function setOriginalPhoto($publicationId){
        try {
            $publication=Publication::findOrFail($publicationId);
            if(Auth::id()!=$publication->user_id){
                $error='No tienes permiso para editar esta gauchada';
                \Session::flash('error',$error);
            }
            elseif (count($publication->postulations)!=0) {
                $error='No puedes editar esta gauchada porque tiene postulantes';
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
