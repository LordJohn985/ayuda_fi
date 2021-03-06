<?php

namespace App\Http\Controllers;

use App\Reputation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class ReputationsController extends Controller
{
    public function getListReputations(){
    	$reputations=Reputation::all();
    	return view('pages.admin.reputations.list',compact("reputations"));
    }

    public function getCreateReputation(){
    	$reputationIsNew = true;
    	return view('pages.admin.reputations.single',compact('reputationIsNew'));
    }

    public function postCreateReputation (Request $request){
    	$rules=[
    		'name' => 'required|max:255|unique:reputations,name',
    		'necesary_score' => 'required|numeric|unique:reputations,necesary_score',
    	];

    	$fields=[
    		'name' => $request->name,
    		'necesary_score' => $request->necesary_score,
    	];

    	$validator = \Illuminate\Support\Facades\Validator::make($fields, $rules);
    	if($validator->fails()){
    		$errors = $validator->errors()->all();
            \Session::flash('error', implode(',',$errors));
            $reputationIsNew = true;
            /*return view('pages.admin.reputations.single' ,compact('reputationIsNew','errors'));*/
            return back()->withInput();
    	}

    	$reputations=Reputation::where('name','=',$request->name)->orWhere('necesary_score','=',$request->necesary_score)->count();
    	if($reputations>0){
    		$error= 'La reputación ya existe.';
    		\Session::flash('error', $error);
            $reputationIsNew = true;
            return view('pages.admin.reputations.single',compact('reputationIsNew','error'));
        }
	    $reputation=new Reputation();
	    $reputation->name=$request->name;
	    $reputation->necesary_score=$request->necesary_score;
	    try{
	    	$reputation->save();
	    	$success = 'La reputación ha sido creada.';
	        \Session::flash('success', $success);
	    }
	    catch(\PDOExeption $e){
	    	$error = 'No se pudo crear la reputación.';
	       \Session::flash('error', $error);
	    }
    	return Redirect::to('/reputations');
    }

    public function getEditReputation($reputationId){
    	if($reputationId<=2){
    		$error="No se puede editar esta reputacion";
    		\Session::flash('error',$error);
    		return Redirect::to('/reputations');
    	}
    	$reputation=Reputation::find($reputationId);
    	$reputationIsNew=false;
    	return view('pages.admin.reputations.single',compact('reputationIsNew','reputation'));
    }

    public function postEditReputation($reputationId,Request $r){
    	$rules=[
    		'name' => ['required',Rule::unique('reputations')->ignore($reputationId)],
    		'necesary_score' => ['required','numeric',Rule::unique('reputations')->ignore($reputationId)],
    	];

		$fields=[
    		'name' => $r->name,
    		'necesary_score' => $r->necesary_score,
    	];

    	$validator=\Illuminate\Support\Facades\Validator::make($fields,$rules);
    	if($validator->fails()){
    		$error='Otra reputacion utiliza los datos ingresados';
    		\Session::flash('error',$error);
    		return Redirect::to('/reputations/edit/'.$reputationId);
    	}

    	try{
	    	$reputation=Reputation::findOrFail($reputationId)->update(['name'=>$r->name,'necesary_score'=>$r->necesary_score]);
	    	$success = 'Reputacion editada';
	        \Session::flash('success', $success);
	        return Redirect::to('/reputations');
		}
		catch(\PDOExeption $e){
			$error='La reputacion no pudo ser editada';
			\Session::flash('error',$error);
			Log::info($e);
			$reputationIsNew=false;
			return Redirect::to('/reputations/edit/'.$reputationId);
		}
    }

    public function getDeleteReputation($reputationId){
    	if($reputationId<=2){
    		$error='La reputacion elegida no se puede eliminar';
    		\Session::flash('error',$error);
    	}
    	else{
	    	$reputation=Reputation::find($reputationId);
	    	if($reputation!=null){
		    	try{
		    		$reputation->delete();
		    		$success='Reputacion eliminada';
		    		\Session::flash('success',$success);
		    	}
		    	catch(\PDOExeption $e){
		    		$error='No se ha podido eliminar la reputacion';
		    		\Session::flash('error',$error);
		    	}
	    	}
	    	else{
	    		$error='La reputacion no existe';
	    		\Session::flash('error',$error);
	    	}
    	}
    	return Redirect::to('/reputations');
    }
}
