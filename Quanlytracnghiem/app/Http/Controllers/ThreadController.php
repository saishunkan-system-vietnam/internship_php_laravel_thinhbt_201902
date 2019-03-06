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
                                           ->select('threads.id','threads.time','threads.total_point','users.name')
                                           ->paginate(5);
        $data['details'] = DB::table('thread_details')->join('questions','thread_details.questions_id','=','questions.id')
                                                      ->select(DB::raw('group_concat(questions.content) as content'),'thread_details.threads_id')
                                                      ->groupBy('thread_details.threads_id')
                                                      ->paginate(5);
        return view('backend.listThread',$data);
   }

   //edit
    public function edit(Request $request, $id){
    	//lay 1 ban ghi
    	$data["record"] = DB::table('threads')->where("id","=",$id)->first();
    	$data["arr"] = DB::table('users')->get();
    	return view("backend.addEditThread",$data);
    }

    //do_edit
    public function doEdit(Request $request, $id){
    	$time = $request->get('time');
    	$total_point = $request->get('total_point');
    	$user_id = $request->get('user_id');

        //validate
    	$validator = Validator::make($request->all(), [
            'time' => 'bail|required|numeric',
           'total_point' => 'bail|required|numeric'
            
       ]);
       
        if ($validator->fails()) {
           return redirect('admin/thread/edit/'.$id)
                       ->withErrors($validator)
                       ->withInput($request->input());
       }else{

        DB::table('threads')->where('id','=',$id)->update(array('time'=>$time,'total_point'=>$total_point,'user_id'=>$user_id));

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
    	$user_id = $request->get('user_id');

    	//validate
    	$validator = Validator::make($request->all(), [
    	 	'time' => 'bail|required|numeric',
            'total_point' => 'bail|required|numeric',

        ]);

    	 if ($validator->fails()) {
            return redirect('admin/thread/add')
                        ->withErrors($validator)
                        ->withInput();
        }

    	//Thread::insert(array("thread"=>$thread,"time"=>$time,"total_point"=>$total_point,"user_id"=>$user_id));

        try {
            DB::beginTransaction();
            $threadT = new Thread;
            $threadT->time = $time;
            $threadT->total_point = $total_point;
            $threadT->user_id = $user_id;
            $threadT->created_at = now();
            $threadT->updated_at = now();

            if($threadT->save()) {
                $threadId = $threadT->id;
                $questions = Question::get(['id']);
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

    // detail add
    public function detailAdd(Request $request,$id)
    {
    	$data["arr"] = DB::table('threads')->where("id","=",$id)->first();
        $data['questions'] = DB::table('questions')->get();

    	$data['answers'] = DB::table('answers')->join('questions','answers.questions_id','=','questions.id')
                                               ->select(DB::raw('group_concat(answers.answers) as answers'),'questions.content','answers.type','questions.id','questions.point')
                                               ->groupBy('questions.id','answers.type')
                                               ->paginate(5);

    	return view('backend.addEditDetail',$data);
    }

    // detail do add
    public function detailDoAdd(Request $request,$id){
       $questions_id = $request->get('questions_id');
       
       DB::table('thread_details')->where('id','=',$id)->insert([
           'threads_id' => $request->route('id'),
           'questions_id'=>$questions_id,
           'created_at' => now(),
           'updated_at' => now()
       ]);

       return redirect(url('admin/thread'));
    }


    // detail edit
    public function detailEdit(Request $request,$id)
    {
    	$data["record"] = DB::table('threads')->where("id","=",$id)->first();
    	$data["arr"] = DB::table('threads')->where("id","=",$id)->first();
        $data['questions'] = DB::table('questions')->get();
        $data['answers'] = DB::table('answers')->join('questions','answers.questions_id','=','questions.id')
                                               ->select('questions.content','answers.answers','answers.type','questions.id','questions.point')
                                               ->get();
    	return view('backend.addEditDetail',$data);
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
