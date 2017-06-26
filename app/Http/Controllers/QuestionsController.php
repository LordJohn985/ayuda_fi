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


        #VALIDATE DATA
        $rules = [
            'content' => 'required|max:255',
        ];

        $fields = [
            'content' => $request->body_content,
        ];

        $validator = \Illuminate\Support\Facades\Validator::make($fields, $rules);

        if($validator->fails()){
            $errors = $validator->errors()->all();
            \Session::flash('error', implode(',',$errors));
            return Redirect::to('/dashboard/publications/show/'.$publicationId, compact('errors'));
        }

        #CREATE QUESTION
        $question = new Question();
        $question->publication_id=$publicationId;
        $question->user_id=auth::id();
        $question->content=$request->body_content;
        $question->answer='Sin respuesta aun';


        #SAVE QUESTION
        try{
            $question->save();
            $success = 'Tu pregunta fue enviada, ahora espera la respuesta sobre: '.Publication::find($publicationId)->title;
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $errors = 'No pudimos enviar tu pregunta debido a un error del sistema. Intentalo nuevamente';
            \Session::flash('error', $errors);
            return Redirect::to('/dashboard/publications/show/'.$publicationId, compact('errors'));
        }

        return Redirect::to('/dashboard/publications/show/'.$publicationId);
    }

    public function postAnswerQuestion($questionId,Request $request){

        $publicationId = Question::find($questionId)->publication->id;

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
            return Redirect::to('/dashboard/publications/show/'.$publicationId, compact('errors'));
        }

        #ANSWER QUESTION
        $question = Question::find($questionId);
        $question->answer=$request->answer;

        #DB::table('questions')
         #   ->where('id', $questionId)
          #  ->update(['answer' => $request->answer]);


        #SAVE ANSWER
        try{
            $question->save();
            $success = 'Tu respuesta fue enviada.';
            \Session::flash('success', $success);
        }catch (\PDOException $e){
            $errors = 'No pudimos enviar tu respuesta debido a un error del sistema. Intentalo nuevamente';
            \Session::flash('error', $errors);
            return Redirect::to('/');

        }

        return Redirect::to('/dashboard/publications/show/'.$publicationId);
    }
}
