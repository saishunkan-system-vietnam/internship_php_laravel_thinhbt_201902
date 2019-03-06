<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\MessageBag;

use DB;
use Auth;
use App\Model\Question;
use App\Model\Answer;
use App\Model\Result;
use App\Model\Thread;


class IndexController extends Controller
{
    //
    public function getSignin(Request $request)
    {
    	return view('frontend.signin');
    }

    public function postSignin(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    	 	'email' => 'bail|required|email',
    	 	'password' => 'bail|required'
        ]);

    	if ($validator->fails()) {
    		return redirect('index/signin')
    						->withErrors($validator)
    						->withInput();
    	}else{
            $email = $request->get('email');
            $password = $request->get("password");
            if (Auth::attempt(['email'=> $email,'password' => $password])) {
                    return redirect('index/exam');
            }else{
                    $errors = new MessageBag(['errorLogin' => 'Email or password incorrect!!!']);
                    return redirect()->back()->withInput()->withErrors($errors);
            }
    	}
    }
    

    public function listExam(Request $request)
    {
        $check = Auth::id();
       	$data['threads'] = DB::table('threads')->join('thread_details','threads.id','=','thread_details.threads_id')
                                               ->join('questions','thread_details.questions_id','=','questions.id')
                                               ->select('threads.id','thread_details.questions_id','threads.user_id','questions.content','questions.point','threads.time','threads.total_point')
                                               ->where('threads.user_id','=',$check)
                                               ->get()->toArray();
											   
        foreach ($data['threads'] as $key => $value) {
            
            $threads['answers'] = DB::table('answers')->where('questions_id','=',$value->questions_id)->get()->toArray();
            $data['threads'][$key] = array_merge((array) $data['threads'][$key], $threads);
            
            //dem so cau tra loi de su dung checkbox hoac radio
            $count = 0;
            foreach ($threads['answers'] as $answers) {
                if ($answers->type == 1) {
                        $count++;
                }
            }
            $data['threads'][$key]['count'] = $count;
        }
            
        return view('frontend.exam',$data);
    }
    
    
    
    public function getResult(Request $request)
    {	
        $answers = $request->all();
        $id = Auth::id();
        $threads = DB::table('threads')->where("user_id","=",$id)->get(['id'])->toArray();
        $check = DB::table('answers')->join('questions','answers.questions_id','=','questions.id')
                                     ->join('thread_details','questions.id','=','thread_details.questions_id')
                                     ->where('answers.type','=',1)
                                     ->where('thread_details.threads_id','=',$threads[0]->id)
                                     ->select('answers.id','answers.questions_id')
                                     ->get()->toArray();

        //list id cau tra loi dung
        $checkId = array();
        foreach ($check as $value) {
                $checkId[] = $value->id;
        }

        //tinh diem
        $total = 0;
        //kiem tra xem co 
        if (isset($answers['answer'])) {
            //cau tra loi cua user 
            foreach ($answers['answer'] as $key => $value) {
                //kiem tra cau tra loi co nhieu dap an hay ko
                if (is_array($value)) {
                    //dem so cau tra loi dung voi so cau tra loi cua user trong checkbox
                    if ($answers['count'][$key] == count($value)) {
                        $checkAns = 0;
                        foreach ($value as $ans) {
                            //kiem tra tung cau xem co bao nhieu cau dung
                            if (in_array($ans,$checkId)) {
                                    $checkAns++;
                            }else {
                                    $checkAns = 0;
                            }
                            //neu so cau tra loi dung cua user = so cau tra loi dung cua de thi cong diem, con lai thi ko cong
                            if ($checkAns == $answers['count'][$key]) {
                                    $total = $total + $answers['point'][$key];
                            }
                        }
                    }
                }else {
                    if (in_array($value,$checkId)) {
                            $total = $total + $answers['point'][$key];
                    }
                }
            }

            //luu cau tra loi
            $answers_id = "";
            foreach ($answers['answer'] as $value) {
                if (is_array($value)) {
                    $answers_id = $answers_id . implode(',',$value) . ',';
                    
                } else {
                    $answers_id = $answers_id . $value . ',';
                }
            }
            $finalAns = rtrim($answers_id,',');
        }else {
            $total = 0;
            $finalAns = 0;
        }

        
        
        
        
        //luu vao bang results
        $results = new Result;
        $results->users_id = $id;
        $results->answers_id = $finalAns;
        $results->threads_id = $threads[0]->id;
        $results->users_point = $total;
        $results->created_at = now();
        $results->updated_at = now();
        $results->save();
        
        $data["arr"] = DB::table('results')->join('threads','results.threads_id','=','threads.id')
                                            ->where('users_id','=',$id)
                                            ->select('results.users_id','results.threads_id','results.answers_id','results.users_point','threads.total_point')
                                            ->first();

        return view('frontend.results',$data);
        //return redirect(url('index/results'));
    }


    public function getLogout()
    {	
    	Auth::logout();
    	return redirect(url('index/signin'));
    }

}	
