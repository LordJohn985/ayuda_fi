<?php

namespace App\Http\Controllers;


use App\Configuration;
use App\Publication;
use App\Postulation;
use App\Calification;
use App\Label;
use App\Purchase;
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
use Illuminate\Support\Facades\DB;


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

        return Redirect::to('/dashboard/users/list');

    }

    public function getBuyCredits (){
        $price = Configuration::find('1')->price;
        return view('pages.admin.users.purchaseView', compact('price'));
    }

    public function postBuyCredits (Request $request){
        switch ($request->credit_card){
            case '4242424242424242': /*tarjeta válida*/
                if ($request->security_code == 123){ /*código de tarjeta válido*/
                    $user = User::find(auth::id());
                    $user->credits += $request->credits;
                    $purchase = new Purchase();
                    $purchase->purchase_date = Carbon::now();
                    $purchase->count = $request->credits;
                    $purchase->total = $request->credits * Configuration::find('1')->price;
                    $purchase->user_id = $user->id;

                    try{
                        $user->save();
                        $purchase->save();
                        $success = 'La compra se realizó con éxito';
                        \Session::flash('success', $success);
                    }catch(\PDOException $e){
                        $error = 'The operation has failed';
                        \Session::flash('error', $error);
                    }
                    $publications = Publication::all();
                    return view('home', compact('success', 'publications'));
                }
                /*código de tarjeta inválido*/
                $errors = 'El codigo de seguridad no corresponde a la tarjeta ingresada.';
                \Session::flash('error', $errors);
                return view('pages.admin.users.purchaseView', compact('errors'));
                break;
            case '5105105105100510': /*tarjeta sin saldo*/
                $errors = 'La tarjeta no tiene saldo.';
                \Session::flash('error', $errors);
                return view('pages.admin.users.purchaseView', compact('errors'));
                break;
            default: /*tarjeta inválida*/
                $errors = 'La tarjeta es inválida.';
                \Session::flash('error', $errors);
                return view('pages.admin.users.purchaseView', compact('errors'));
                break;
        }
    }

    #DELETE
    public function getDeleteUser ($user_id){
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

    public function getShowUser($userId){
        try{
            $user=User::findOrFail($userId);
            $postulations=Postulation::where('postulations.user_id',$userId)->join('publications','postulations.publication_id','=','publications.id')->get();
            $publications=$user->publications;
            //$califications=Calification::where('califications.user_id',$userId)->where('califications.label_id','>','1')->join('publications','califications.publication_id','=','publications.id')->join('labels','califications.label_id','=','label.id')->get();
            $califications=DB::select("select publication_id,califications.content as content,name,title from `califications` inner join `publications` on `califications`.`publication_id` = `publications`.`id` inner join `labels` on `califications`.`label_id` = `labels`.`id` where `califications`.`user_id` = 2 and `califications`.`label_id` > 1 and `califications`.`deleted_at` is null");
            if($userId==Auth::id()){
                return view('pages.admin.users.showToSelf',compact('user','postulations','publications','califications'));
            }
            return view('pages.admin.users.show',compact('user','postulations','publications','califications'));
        }
        catch(ModelNotFoundException $e){
            $error='El usuario no existe';
            \Session::flash('error',$error);
            return Redirect::to('/home');
        }
    }
}
