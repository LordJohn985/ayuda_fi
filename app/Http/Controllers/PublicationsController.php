<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Postulation;
use App\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Session\Session;





class PublicationsController extends Controller
{

    #CREATE
    public function getCreatePublication(){

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
        $publication->image = 'algo.jpg';
        $publication->user_id = Auth::user()->id;



        #SAVE PUBLICATION
        try{
            $publication->save();
            $success = 'The operation has succeed';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $error = 'The operation has failed';
            \Session::flash('error', $error);
            Log::info($e);
        }

        if( $request->hasFile('image') ) {
            $file = $request->file('image');
            // Now you have your file in a variable that you can do things with
            Storage::disk('local')->put('publications/images/'.$publication->id.'jpg', $file);
        }

        return Redirect::to('home');

    }

    #READ
    public function getListPublication(){

        $publications = Publication::with('user')->paginate(5);
        return view("pages.admin.publications.list", compact("publications"));
    }

    public function getShowPublication($publicationId){
        $publication = Publication::find($publicationId);
        $users = Postulation::where('publication_id', $publicationId)->join('users','users.id','=','postulations.id')->select('users.name')->get();
        return view("pages.admin.publications.show", compact("users", "publication"));
    }

    #UPDATE
    public function getUpdatePublication($publicationId){

    }

    public function postUpdatePublication(Request $request){

    }

    #DELETE
    public function getDeletePublication($publicationId){

    }

    #APLY
    public function getAplyPublication($publicationId, Request $request){

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
            return view('home' ,compact('errors'));
        }

        #CREATE POSTULATION
        $postulation = new Postulation();
        $postulation->publication_id=$publicationId;
        $postulation->user_id=auth::id();
        $postulation->comment=$request->comment;

        #SAVE POSTULATION
        try{
            $postulation->save();
            $success = 'The operation has succeed';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $errors = $e->getMessage();
            \Session::flash('error', $errors);
            return view('home' ,compact('errors'));
        }

        return Redirect::to('home');
    }













}
