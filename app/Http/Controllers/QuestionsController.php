<?php

namespace App\Http\Controllers;

use App\Reputation;
use App\Question;
use App\Publication;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class QuestionsController extends Controller
{
    public function postCreateQuestion($publicationId,Request $request){

    	$publications = Publication::all();

        #VALIDATE DATA
        $rules = [
            'content' => 'required|max:255',
        ];

        $fields = [
            'content' => $request->content,
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($fields, $rules);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            \Session::flash('error', implode(',',$errors));
            return view('home' ,compact('errors', 'publications'));
        }

        #CREATE QUESTION
        $question = new Question();
        $question->publication_id=$publicationId;
        $question->user_id=auth::id();
        $question->content=$request->content;
        $question->answer='Sin respuesta aun';
        \Log::info($question);


        #SAVE QUESTION
        try{
            $question->save();
            $success = 'Tu pregunta fue enviada, ahora espera la respuesta sobre: '.Publication::find($publicationId)->title;
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $errors = 'No pudimos enviar tu pregunta debido a un error del sistema. Intentalo nuevamente';
            \Session::flash('error', $errors);
            return view('home' ,compact('errors', 'publications'));

        }

        return view('home' ,compact('publications'));
    	
    }

    public function postAnswerQuestion($questionId,Request $request){

    	$publications = Publication::all();

        #VALIDATE DATA
        $rules = [
            'answer' => 'required|max:255',
        ];

        $fields = [
            'answer' => $request->answer,
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($fields, $rules);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            \Session::flash('error', implode(',',$errors));
            return view('home' ,compact('errors', 'publications'));
        }

        #ANSWER QUESTION
        $answer = Question::where('id', '=', $questionId);
        $answer->answer=$request->answer;

        #DB::table('questions')
         #   ->where('id', $questionId)
          #  ->update(['answer' => $request->answer]);

        \Log::info($answer);

        #SAVE ANSWER
        try{
            $answer->save();
            $success = 'Tu respuesta fue enviada.';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $errors = 'No pudimos enviar tu respuesta debido a un error del sistema. Intentalo nuevamente';
            \Session::flash('error', $errors);
            return view('home' ,compact('errors', 'publications'));

        }

        return view('home' ,compact('publications'));

    }
}
