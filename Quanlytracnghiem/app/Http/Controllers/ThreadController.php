<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Model\Thread;
use App\Model\ThreadDetail;
use App\Model\User;
use App\Model\Question;
use App\Model\Answer;

class ThreadController extends Controller
{
    //list thread
   public function listThread(Request $request)
   {
        $data['arr'] = DB::table('threads')->join('users','threads.user_id','=','users.id')
                                           ->select('threads.id','threads.time','threads.total_point','users.name','threads.total_questions')
                                           ->paginate(3);
        $data['details'] = DB::table('thread_details')->join('questions','thread_details.questions_id','=','questions.id')
                                                      ->select(DB::raw('group_concat(questions.content) as content'),'thread_details.threads_id',DB::raw('sum(questions.point) as point'))
                                                      ->groupBy('thread_details.threads_id')
                                                      ->paginate(3);
        return view('backend.listThread',$data);
   }

   //edit
    public function edit(Request $request, $id){
    	//lay 1 ban ghi
    	$data["record"] = DB::table('threads')->where('id','=',$id)->first();
        $data["arr"] = DB::table('users')->get();
    	return view("backend.addEditThread",$data);
    }

    //do_edit
    public function doEdit(Request $request, $id){
    	$time = $request->get('time');
        $total_point = $request->get('total_point');
        $total_questions = $request->get('total_questions');
        $user_id = $request->get('user_id');
        $old_questions = old('total_questions');
        //dd($old_questions);
        //validate
    	$validator = Validator::make($request->all(), [
            'time' => 'bail|required|numeric',
           'total_point' => 'bail|required|numeric',
           'total_questions' =>'bail|required|numeric'
            
       ]);
       
        if ($validator->fails()) {
           return redirect('admin/thread/edit/'.$id)
                       ->withErrors($validator)
                       ->withInput($request->input());
       }else{
        
        $threads = DB::table('threads')->where('id','=',$id)->update(['time'=>$time,'total_point'=>$total_point,'total_questions'=>$total_questions,'user_id'=>$user_id]);
        $questions =  Question::inRandomOrder()->limit($total_questions)->get(['id']);
        if ($threads == 1 && $total_questions != '') {
            ThreadDetail::where('threads_id','=',$id)->delete();
            $data = [];
            foreach ($questions as $question) {
                $data[] = [
                    'threads_id' => $id,
                    'questions_id' => $question->id,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
            ThreadDetail::insert($data);
        }
        
        return redirect(url('admin/thread'));
       }
    }

    //add
    public function add(Request $request)
    {

    	$data['arr'] = DB::table('users')->get();
    	return view('backend.addEditThread',$data);
    }

    //do_add
    public function doAdd(Request $request)
    {
    	$time = $request->get('time');
        $total_point = $request->get('total_point');
        $total_questions = $request->get('total_questions');
    	$user_id = $request->get('user_id');

    	//validate
    	$validator = Validator::make($request->all(), [
    	 	'time' => 'bail|required|numeric',
            'total_point' => 'bail|required|numeric',
            'total_questions' =>'bail|required|numeric'

        ]);

    	 if ($validator->fails()) {
            return redirect('admin/thread/add')
                        ->withErrors($validator)
                        ->withInput();
        }


    	//Thread::insert(array("thread"=>$thread,"time"=>$time,"total_point"=>$total_point,"user_id"=>$user_id));

        // $threadT = new Thread;
        // $threadT->time = $time;
        // $threadT->total_point = $total_point;
        // $threadT->total_questions = $total_questions;
        // $threadT->user_id = $user_id;
        // $threadT->created_at = now();
        // $threadT->updated_at = now();
        // $threadT->save();

        // su dung transaction luu du lieu cho 2 bang
        // neu bang 1 ko insert dc thi bang 2 cung ko insert
        try {
            DB::beginTransaction();
            $threadT = new Thread;
            $threadT->time = $time;
            $threadT->total_point = $total_point;
            $threadT->total_questions = $total_questions;
            $threadT->user_id = $user_id;
            $threadT->created_at = now();
            $threadT->updated_at = now();

            if($threadT->save()) {
                $threadId = $threadT->id;
                $threadQ = $threadT->total_questions;
                $questions = Question::inRandomOrder()->limit($threadQ)->get(['id']);
                $data = [];
                foreach ($questions as $question) {
                    $data[] = [
                        'threads_id' => $threadId,
                        'questions_id' => $question->id,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                }
                ThreadDetail::insert($data);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }

    	return redirect(url('admin/thread'));
    }
    //--------------------------------------------------------------
    //--------------------------------------------------------------

    //delete thread
    public function delete(Request $request, $id){
        DB::table('threads')->where('id','=',$id)->delete();
        ThreadDetail::where('threads_id','=',$id)->delete();
    	return redirect(url('admin/thread'));
    }
}
