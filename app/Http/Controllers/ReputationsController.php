<?php

namespace App\Http\Controllers;


use App\Reputation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ReputationsController extends Controller
{
    public function getListReputations(){
    	$reputations=Reputation::all()->sortBy('necesary_score');
    	return view('pages.admin.reputations.home',compact("reputations"));
    }

    public function getCreateReputation(){
    	return view('pages.admin.reputations.single',compact('reputationIsNew'));
    }

    public function postCreateReputation (Request $request){
    	$rules=[
    		'name' => 'required|max:255|unique',
    		'necesary_score' => 'required|number',
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
            return view('pages.admin.reputations.single' ,compact('reputationIsNew','errors'));
    	}

    	$reputations=Reputation::where('name','=',$request->name)->orWhere('necesary_score','=',$request->necesary_score)->count();
    	exit(var_dump($reputations));
    	if($reputations>0){
    		$error= 'Reputation already exists';
    	}

    	$reputation=new Reputation();
    	$reputation->name=$request->name;
    	$reputation->necesary_score=$request->necesary_score;
    	try{
    		$reputation->save();
    		$success = 'The operation has succeed';
            \Session::flash('success', $success);
    	}
    	catch(\PDOExeption $e){
    		$error = 'The operation has failed';
            \Session::flash('error', $error);
            Log::info($e);
    	}

    	$reputations = Reputation::all();
        return view('pages.admin.reputations.single',compact('reputations'));

    }
}
