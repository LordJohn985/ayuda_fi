<?php

namespace App\Http\Controllers;

use App\Reputation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class QuestionsController extends Controller
{
    public function postCreateQuestion($publicationId,Request $r){
    	
    }

    public function postAnswerQuestion($questionId,Request $r){

    }
}
