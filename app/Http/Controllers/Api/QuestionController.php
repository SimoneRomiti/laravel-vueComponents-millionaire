<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
    public function questions($num){
        $question = Question::where('level', $num)->with('answers')->get();

        return response()->json($question);
    }

    
}
