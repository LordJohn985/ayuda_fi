<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Log;
use App\Http\Requests;



class UsersController extends Controller
{

    #CREATE
    public function getCreateUser(){

        $userIsNew = true;
        return view('pages.admin.users.single' ,compact('userIsNew'));

    }
    
    public function postCreateUser (Request $request){

        #VALIDATE DATA
        $rules = [
            'user_name' => 'required|max:255|unique:users,name',
            'role' => 'required|exists:roles,id',
            'user_email' => 'required|max:255|unique:users,email',
            'user_password' => 'required|max:12',
        ];

        $fields = [
            'user_name' => $request->name,
            'role' => $request->role,
            'user_email' => $request->email,
            'user_password' => $request->password,

        ];
        $validator = \Illuminate\Support\Facades\Validator::make($fields, $rules);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            \Session::flash('error', $errors);
            $userIsNew = true;
            return view('pages.admin.users.single' ,compact('userIsNew','errors'));
        }



        #CREATE USER
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = $request->role;

        #SAVE USER
        try{
            $user->save();
            $success = 'The operation has succeed';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $errors = $e->getMessage();
            \Session::flash('error', $errors);
            $userIsNew = true;
            return view('pages.admin.users.single' ,compact('userIsNew','errors'));
        }

        return Redirect::to('dashboard/users/list');
    }

    #READ
    public function getListUser (){

        $users = User::with("role")->paginate(5);
        return view("pages.admin.users.list", compact("users"));

    }

    #UPDATE
    public function getUpdateUser ($user_id){

        #RETRIEVE USER
        try{
            $user = User::findOrFail($user_id);
            $userIsNew = false;
        }catch (ModelNotFoundException $e){
            $error = 'User not found';
            \Session::flash('error', $error);
            return Redirect::to('users/list');
        }


        #RETURN VIEW
        return view('pages.admin.users.single' ,compact('userIsNew','user'));

    }
    
    public function postUpdateUser (Request $request, $user_id){

        #VALIDATE DATA
        $rules = [
            'user_name'=>'required|unique:users,name,'. $user_id,
            'role' => 'required|exists:roles,id',
            'user_email'=>'required|email|unique:users,email,'. $user_id,
            'user_password' => 'required|max:12',
        ];

        $fields = [
            'user_name' => $request->name,
            'role' => $request->role,
            'user_email' => $request->email,
            'user_password' => $request->password,
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($fields, $rules);

        #RETRIEVE USER
        try{
            $user = User::findOrFail($user_id);
        }catch (ModelNotFoundException $e) {
            $error = $e->getMessage();
            \Session::flash('error', $error);
            return view('pages.admin.users.single', compact('userIsNew', 'error'));
        }

        if($validator->fails()){
            $errors = $validator->messages();
            \Session::flash('error', $errors);
            $userIsNew = false;
            return view('pages.admin.users.single' ,compact('userIsNew','errors', 'user'));
        }





        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role_id = $request->role;

        #SAVE USER
        try{
            $user->save();
            $success = 'The operation has succeed';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $errors = $e->getMessage();
            \Session::flash('error', $errors);
            $userIsNew = false;
            return view('pages.admin.users.single' ,compact('userIsNew','errors'));
        }

        return Redirect::to('dashboard/users/list');

    }

    #DELETE
    public function getDeleteUser ($user_id, Request $request){
        $result='success';
        $user=null;
        #RETRIEVE USER
        try{
            $user = User::findOrFail($user_id);
        }catch (ModelNotFoundException $e){
            $error = 'User not found';
            \Session::flash('error', $error);
            $result='fail';
        }

        try{
            $user->delete();
            $error = 'success';
        }catch (\PDOException $e){
            $error = 'The operation has failed';
            \Session::flash('error', $error);
            $result='fail';
        }

        if($result=='success'){
            return response('The user has been deleted.',200);
        }else{
            return response("The action can't be performed.",500);
        }

    }

    

    




}
