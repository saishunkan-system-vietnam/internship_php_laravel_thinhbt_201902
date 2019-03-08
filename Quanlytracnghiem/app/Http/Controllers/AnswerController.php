<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    public function listAnswer(Request $request)
    {
        $data['answers'] = DB::table('answers')->join('questions','answers.questions_id','=','questions.id')
                                               ->select('answers.id','answers.questions_id','questions.content','answers.answers','answers.type')
                                               ->orderBy('answers.id','desc')
                                               ->paginate(10);
        return view('backend.listAnswer',$data);
    }

    public function answerEdit(Request $request, $id)
    {
        
        $data['answers'] = DB::table('answers')->where('id','=',$id)->first();
        return view('backend.addEditAnswer',$data);
    }

    public function answerDoEdit(Request $request, $id)
    {
        $answers = $request->get('answers');
        $type = $request->get('type');

        //validate
    	$validator = Validator::make($request->all(), [
            'answers' => 'bail|required'
            
       ]);
       
        if ($validator->fails()) {
           return redirect('admin/answer/answerEdit/'.$id)
                       ->withErrors($validator)
                       ->withInput($request->input());
       }else{

        DB::table('answers')->where('id','=',$id)->update(array('answers'=>$answers,'type'=>$type));

        return redirect(url('admin/answer'));
       }
    }
    
    public function delete(Request $request, $id)
    {
        DB::table('answers')->where('id','=',$id)->delete();
    	return redirect(url('admin/answer'));
    }
  
}
