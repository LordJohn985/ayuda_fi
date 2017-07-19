<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\DB;



class CategoriesController extends Controller
{

    #CREATE
    public function getCreateCategory(){
        $categoryIsNew = true;
        return view('pages.admin.categories.single' ,compact('categoryIsNew'));
    }

    public function postCreateCategory(Request $request){

        #VALIDATE DATA
        $rules = [
            'nombre_elegido' => 'required|max:255|unique:categories,name',
        ];

        $fields = [
            'nombre_elegido' => $request->name,

        ];
        $validator = \Illuminate\Support\Facades\Validator::make($fields, $rules);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            \Session::flash('error', implode(',',$errors));
            $categoryIsNew = true;
            return view('pages.admin.categories.single' ,compact('categoryIsNew','errors'));
        }


        #CREATE CATEGORY
        $category = new Category();
        $category->name = $request->name;

        #SAVE CATEGORY
        try{
            $category->save();
            $success = 'La categoría ha sido creada con éxito.';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $error = 'La categoría no pudo ser creada.';
            \Session::flash('error', $error);
            $categoryIsNew = true;
            return view('pages.admin.categories.single' ,compact('categoryIsNew','errors'));
        }

        return Redirect::to('dashboard/categories/list');
    }

    #READ
    public function getListCategory(){
        $categories= Category::paginate(100);
        return view("pages.admin.categories.list", compact("categories"));
    }

    public function getShowCategory($category_id){
        #RETRIEVE CATEGORY
        try{
            $category = Category::findOrFail($category_id);
        }catch(ModelNotFoundException $e){
            $error = 'Categoria no encontrada.';
            \Session::flash('error', $error);
            return Redirect::to('dashboard/categories/list');
        }
        #RETURN VIEW
        return View('dashboard/categories/show',compact("category"));
    }
    
    #UPDATE
    public function getUpdateCategory($category_id){
        #RETRIEVE CATEGORY
        try{
            $category = Category::findOrFail($category_id);
            $categoryIsNew = false;
        }catch (ModelNotFoundException $e){
            $error = 'Categoria no encontrada.';
            \Session::flash('error', $error);
            return Redirect::to('dashboards/categories/list');
        }


        #RETURN VIEW
        return view('pages.admin.categories.single' ,compact('categoryIsNew','category'));
    }

    public function postUpdateCategory(Request $request, $category_id){
        #VALIDATE DATA
        $rules = [
            'nombre_elegido' => 'required|max:255|unique:categories,name',
        ];

        $fields = [
            'nombre_elegido' => $request->name,
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($fields, $rules);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            \Session::flash('error', implode(',',$errors));
            $categoryIsNew = true;
            return back()->withInput()->with($errors);
            /*return view('pages.admin.categories.single' ,compact('categoryIsNew','error'));*/
        }



        #RETRIEVE CATEGORY
        try{
            $category = Category::findOrFail($category_id);
        }catch (ModelNotFoundException $e){
            $error = 'Categoria no encontrada.';
            \Session::flash('error', $error);
            $categoryIsNew = true;
            return back()->withInput()->with($error);
            /*return view('pages.admin.categories.single' ,compact('categoryIsNew','error'));*/

        }

        $category->name = $request->name;

        #SAVE CATEGORY
        try{
            $category->save();
            $success = 'La categoría ha sido editada.';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $error = 'La categoría no pudo editarse';
            \Session::flash('error', $error);
            $categoryIsNew = true;
            return back()->withInput()->with($error);
            /*return view('pages.admin.categories.single' ,compact('categoryIsNew','error'));*/
        }

        return Redirect::to('dashboard/categories/list');
    }

    #DELETE
    public function getDeleteCategory($category_id, Request $request){
        $result='success';
        $category=null;
        #RETRIEVE CATEGORY
        try{
            $category = Category::findOrFail($category_id);
        }catch (ModelNotFoundException $e){
            $error = 'Categoria no encontrada';
            \Session::flash('error', $error);
            $result='fail';
            return Redirect::to('/dashboard/categories/list');
        }

        if ($category->publications->count()==0){
            try{
                $category->delete();
                $success = 'La categoría se borró exitosamente.';
                \Session::flash('success', $success);
            }catch (\PDOException $e){
                $error = 'No se pudo borrar la categoría';
                \Session::flash('error', $error);
                $result='fail';
                return Redirect::to('/dashboard/categories/list');
            }
        }else{
            $error = 'Existen gauchadas que pertenecen a la categoría que intentas borrar.';
            \Session::flash('error', $error);
        }
        return Redirect::to('/dashboard/categories/list');

        /*if($result=='success'){
            return response('The category has been deleted.',200);
        }else{
            return response("The action can't be performed.",500);
        }*/
    }

    public function getDeactivateCategory($category_id){
        try{
            $category=Category::findOrFail($category_id);
            $category->active=0;
            $category->save();
            $success='La categoria ha sido deshabilitada';
            \Session::flash('success',$success);
        }
        catch(\ModelNotFoundException $e){
            $error='La categoria elegida no existe';
            \Session::flash('error',$error);
        }
        finally{
            return Redirect::to('/dashboard/categories/list');
        }
    }

    public function getActivateCategory($category_id){
        try{
            $category=Category::findOrFail($category_id);
            $category->active=1;
            $category->save();
            $success='La categoria ha sido habilitada';
            \Session::flash('success',$success);
        }
        catch(\ModelNotFoundException $e){
            $error='La categoria elegida no existe';
            \Session::flash('error',$error);
        }
        finally{
            return Redirect::to('/dashboard/categories/list');
        }            
    }

}
