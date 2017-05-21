<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Session\Session;




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
            'category_name' => 'required|max:255|unique:categories,name',
        ];

        $fields = [
            'category_name' => $request->name,

        ];
        $validator = \Illuminate\Support\Facades\Validator::make($fields, $rules);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            \Session::flash('error', $errors);
            $categoryIsNew = true;
            return view('pages.admin.categories.single' ,compact('categoryIsNew','errors'));
        }


        #CREATE CATEGORY
        $category = new Category();
        $category->name = $request->name;

        #SAVE CATEGORY
        try{
            $category->save();
            $success = 'The operation has succeed';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $error = $e->getMessage();
            \Session::flash('error', $error);
            $categoryIsNew = true;
            return view('pages.admin.categories.single' ,compact('categoryIsNew','errors'));
        }

        return Redirect::to('dashboard/categories/list');
    }

    #READ
    public function getListCategory(){
        $categories = Category::paginate(5);
        return view("pages.admin.categories.list", compact("categories"));
    }

    public function getShowCategory($category_id){
        #RETRIEVE CATEGORY
        try{
            $category = Category::findOrFail($category_id);
        }catch(ModelNotFoundException $e){
            $error = 'Category not found.';
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
            $error = 'Category not found';
            \Session::flash('error', $error);
            return Redirect::to('dashboards/categories/list');
        }


        #RETURN VIEW
        return view('pages.admin.categories.single' ,compact('categoryIsNew','category'));
    }

    public function postUpdateCategory(Request $request, $category_id){
        #VALIDATE DATA
        $rules = [
            'category_name' => 'required|max:255|unique:categories,name',
        ];

        $fields = [
            'category_name' => $request->name,
        ];
        $validator = \Illuminate\Support\Facades\Validator::make($fields, $rules);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            \Session::flash('error', $errors);
            $categoryIsNew = true;
            return view('pages.admin.categories.single' ,compact('categoryIsNew','errors'));
        }



        #RETRIEVE CATEGORY
        try{
            $category = Category::findOrFail($category_id);
        }catch (ModelNotFoundException $e){
            $error = $e->getMessage();
            \Session::flash('error', $error);
            $categoryIsNew = true;
            return view('pages.admin.categories.single' ,compact('categoryIsNew','error'));

        }

        $category->name = $request->name;

        #SAVE CATEGORY
        try{
            $category->save();
            $success = 'The operation has succeed';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $error = $e->getMessage();
            \Session::flash('error', $error);
            $categoryIsNew = true;
            return view('pages.admin.categories.single' ,compact('categoryIsNew','error'));
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
            $error = 'Category not found';
            \Session::flash('error', $error);
            $result='fail';
        }

        try{
            $category->delete();
            $error = 'success';
        }catch (\PDOException $e){
            $error = 'The operation has failed';
            \Session::flash('error', $error);
            $result='fail';
        }

        if($result=='success'){
            return response('The category has been deleted.',200);
        }else{
            return response("The action can't be performed.",500);
        }
    }



}
