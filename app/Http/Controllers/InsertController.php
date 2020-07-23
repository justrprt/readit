<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Question;
use App\Answer;

class InsertController extends Controller
{

    // return insert question page
    public function insert_view()
    {
        return view('insertquestion');
    }

    // function to add question and its id of correspond user and redirecting to homepage
    public function ask(Request $request)
    {
        $user_id = Auth::user()->id;
        Question::create([
            'title_question' => $request->title_question,
            'detail_question' => $request->detail_question,
            'id_question' => $user_id
        ]);
        return redirect()->route('home');
    }
    
    // function to submit reply
    public function reply(Request $request)
    {   
        // return $request->id_question;
        $user_id = Auth::user()->id;

        Answer::create([
            'the_answer' => $request->the_answer,
            'id_question' => $request->id_question,
            'id_answer' => $user_id
        ]);

        // $questions = DB::table('questions')
        //                 ->join('users', 'users.id', '=', 'questions.id_question')
        //                 ->select('users.name', 'questions.created_at', 'questions.updated_at',
        //                         'questions.title_question', 'questions.detail_question', 'questions.id')
        //                 ->where('questions.id', '=', )
        //                 ->first();

        // $answers = DB::table('answers')
        //                 ->join('users', 'users.id', '=', 'answers.id_answer')
        //                 ->where('answers.id_question', '=', )
        //                 ->get();

        $questions = DB::table('questions')
                        ->join('users', 'users.id', '=', 'questions.id_question')
                        ->select('users.name as name', 'questions.created_at', 'questions.updated_at',
                                'questions.title_question', 'questions.detail_question', 'questions.id as id', 'users.created_at as user_created_at')
                        ->where('questions.id', '=', $request->id_question)
                        ->first();

        $answers = DB::table('answers')
                        ->join('users', 'users.id', '=', 'answers.id_answer')
                        ->select('users.name as name', 'answers.created_at', 'answers.updated_at',
                                'answers.id_question', 'answers.id as id', 'answers.id_answer', 'users.created_at as user_created_at', 'answers.the_answer')
                        ->where('answers.id_question', '=', $request->id_question)
                        ->get();

        $count = DB::table('answers')
                        ->select('*')
                        ->where('answers.id_question', '=', $id)
                        ->count();


        return view('detailthread')
            ->with(['questions' => $questions])
            ->with(['answers' => $answers])
            ->with(['count' => $count]);

        return view('detailthread', ["id_question"=>$id_question]);
    }
}