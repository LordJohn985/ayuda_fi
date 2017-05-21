<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Publication;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;





class PublicationsController extends Controller
{

    
    #CREATE
    public function getCreatePublication(){

        $publicationIsNew = true;
        return view('pages.admin.publications.single' ,compact('publicationIsNew'));

    }

    public function postCreatePublication(Request $request){

        #VALIDATE DATA
        $rules = [
            'title' => 'required|max:255|unique:users,name',
            'role' => 'required|exist:roles,id',
            'user_email' => 'required|max:255|unique:users,email',
            'user_password' => 'required|max:12',
        ];

        $fields = [
            'user_name' => $request->user_name,
            'role' => $request->user_role,
            'user_email' => $request->user_password,
            'user_password' => $request->user_password,

        ];
        $validator = \Illuminate\Support\Facades\Validator::make($fields, $rules);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            Session::flash('error', $errors);
            return Redirect::to('dashboard/publications/list');
        }



        #CREATE USER
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;

        #SAVE USER
        try{
            $user->save();
            $success = 'The operation has succeed';
            Session::flash('success', $success);
        }catch (\PDOException $e){
            $error = 'The operation has failed';
            Session::flash('error', $error);
            Log::info($user);
        }

        return Redirect::to('dashboard/publications/list');

    }

    #READ
    public function getListPublication(){

        $publications = Publication::with('user')->paginate(5);
        return view("pages.admin.publications.list", compact("publications"));
    }

    public function getShowPublication($publicationId){

    }

    #UPDATE
    public function getUpdatePublication($publicationId){

    }

    public function postUpdatePublication(Request $request){

    }

    #DELETE
    public function getDeletePublication($publicationId){

    }












}
