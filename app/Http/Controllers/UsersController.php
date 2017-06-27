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
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


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

        if($user_id!=Auth::id()){
            $error='No puedes editar este perfil';
            \Session::flash('error',$error);
            return Redirect::to('/');
        }

        #RETRIEVE USER
        try{
            $user = User::findOrFail($user_id);
            $userIsNew = false;
        }catch (ModelNotFoundException $e){
            $error = 'Usuario no encontrado';
            \Session::flash('error', $error);
            return Redirect::to('/');
        }


        #RETURN VIEW
        return view('pages.admin.users.single' ,compact('userIsNew','user'));

    }
    
    public function postUpdateUser (Request $request, $user_id){

        #VALIDATE DATA

        $rules = [
            'name'=>'required',
            'last_name' => 'required',
            'phone' => 'required|numeric',
            'born_date' => 'required|date',
            'email'=>['required','email',Rule::unique('users')->ignore($user_id)],

        ];

        $fields = [
            'name' => $request->name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'born_date' => $request->birth,
            'email' => $request->email,
        ];

        $pass=isset($request->password);

        if($pass){
            $rules['password']='required|min:6|confirmed';
            $rules['password_confirmation']='required|min:6';
            $fields['password']=($request->password);
            $fields['password_confirmation']=($request->password_confirmation);
        }


           
        $validator = \Illuminate\Support\Facades\Validator::make($fields, $rules);
        if($validator->fails()){
            $errors = $validator->errors()->all();
            \Session::flash('error', implode(',',$errors));
            return Redirect::to('/user/edit/'.$user_id);
        }
        #RETRIEVE USER
        try{
            $user = User::findOrFail($user_id);
        }catch (ModelNotFoundException $e) {
            $error = $e->getMessage();
            \Session::flash('error', $error);
            return view('pages.admin.users.single', compact('userIsNew', 'error'));
        }

        if($pass){
            $fields['password']=bcrypt($fields['password']);
        }

/*        if($validator->fails()){
            $errors = $validator->messages();
            \Session::flash('error', $errors);
            $userIsNew = false;
            return view('pages.admin.users.single' ,compact('userIsNew','errors', 'user'));
        }*/

        #SAVE USER

        if($request->hasFile('picture')) {
            $file = $request->file('picture');
            // Now you have your file in a variable that you can do things with
            $name = 'user'.$user_id.'.png';
            $path = '/storage/users/'.$name;
            try{
                $user->picture=$path;
                $user->save();
                $success = 'La imagen se actualizó correctamente.';
                \Session::flash('success', $success);
                Storage::disk('public')->put('/users/'.$name, file_get_contents($file));
            }catch (\PDOException $e){
                $error = 'No se pudo actualizar la imagen.';
                \Session::flash('error', $error);
            }
        }
        

        try{
            $user->update($fields);
            $success = 'El perfil se actualizó correctamente.';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $errors = 'No se pudo actualizar el perfil.';
            \Session::flash('error', $errors);
            $userIsNew = false;
            return view('pages.admin.users.single' ,compact('userIsNew','errors'));
        }

        return Redirect::to('/user/'.$user_id);

    }

    public function getBuyCredits (){
        $price = Configuration::find('1')->price;
        return view('pages.admin.users.purchaseView', compact('price'));
    }

    public function postBuyCredits (Request $request){
        $credit_card = $request->credit_card;
        $credits = $request->credits;
        $security_code = $request->security_code;
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
                        $error = 'No se pudo realizar la compra.';
                        \Session::flash('error', $error);
                        return view('pages.admin.users.purchaseView', compact('error', 'credit_card', 'credits', 'security_code'));
                    }
                    return Redirect::to('/');
                }
                /*código de tarjeta inválido*/
                $errors = 'El codigo de seguridad no corresponde a la tarjeta ingresada.';
                \Session::flash('error', $errors);
                return view('pages.admin.users.purchaseView', compact('errors', 'credit_card', 'credits', 'security_code'));
                break;
            case '5105105105100510': /*tarjeta sin saldo*/
                $errors = 'La tarjeta no tiene saldo.';
                \Session::flash('error', $errors);
                return view('pages.admin.users.purchaseView', compact('errors', 'credit_card', 'credits', 'security_code'));
                break;
            default: /*tarjeta inválida*/
                $errors = 'La tarjeta es inválida.';
                \Session::flash('error', $errors);
                return view('pages.admin.users.purchaseView', compact('errors', 'credit_card', 'credits', 'security_code'));
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
            $error = 'Usuario no encontrado.';
            \Session::flash('error', $error);
            $result='fail';
        }

        try{
            $user->delete();
            $error = 'Usuario borrado';
        }catch (\PDOException $e){
            $error = 'No se pudo borrar el usuario.';
            \Session::flash('error', $error);
            $result='fail';
        }

        if($result=='success'){
            return response('El usuario ha sido borrado.',200);
        }else{
            return response("No se puede realizar la acción.",500);
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
            return Redirect::to('/');
        }
    }

    public function emptyUser(){
        return Redirect::to('/login');
    }

    public function setOriginalPhoto($userId){
        try {
            $user=User::findOrFail($userId);
            if(Auth::id()!=$user->id){
                $error='No tienes permiso para editar este perfil';
                \Session::flash('error',$error);
            }
            else{
                $user->picture='/images/users/default_photo_profile.jpg';
                try {
                    $user->save();
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
        return Redirect::to('/user/'.$userId);
    }

    public function getPendingPublications(){
        try{
            $publications=Publication::where('user_id','=',Auth::id())->where('finish_date', '>=', Carbon::now())->get();
            $hasFilter=false;
            return view('pages.admin.users.pending',compact('publications','hasFilter'));
        }
        catch(\ModelNotFoundException $e){
            $error='El usuario no existe';
            \Session::flash('error',$error);
            return Redirect::to('/');
        }
    }

    public function postFilterPendingPublications(Request $request){
        if ($request->title!=null){
            $filterTitle = $request->title;
            $publications = Publication::where([['finish_date', '>=', Carbon::now()],['title', 'LIKE', "%$filterTitle%"]],['user_id','=',Auth::id()])->get();
        }
        else{
            $publications = Publication::all()->where('finish_date', '>=', Carbon::now())->where('user_id','=',Auth::id());
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
        return view('pages.admin.users.pending', compact('publications', 'hasFilter', 'filterCategory', 'filterCity', 'filterTitle'));
    }

}
