<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Model\Question;
use App\Model\Answer;

class QuestionController extends Controller
{
    //list question
    public function listQuestion(Request $request)
    {
    	$data['questions'] = DB::table('questions')->orderBy('questions.id','desc')
                                                   ->paginate(10);
    	return view('backend.listQuestion',$data);
    }

    //question edit
    public function edit(Request $request,$id)
    {	
    	$data['record'] = DB::table('questions')->where('questions.id','=',$id)
                                              ->first();
    	return view('backend.addEditQuestion',$data);
    }

    //question do edit
    public function doEdit(Request $request, $id)
    {
    	$content = $request->get('content');
        $point = $request->get('point');
        
    	//validate
    	$validator = Validator::make($request->all(), [
    	 	'content' => 'bail|required|unique:questions,content',
            'point' => 'bail|required|numeric|max:5'
    	 	
        ]);
    	
    	 if ($validator->fails()) {
            return redirect('admin/question/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput($request->input());
        }else{

        DB::table('questions')->where('id','=',$id)->update(['content'=>$content,'point'=>$point]);

    	return redirect(url('admin/question'));
    	}
	}

    // question add
    public function add(Request $request)
    {
    	return view('backend.addEditQuestion');
    }

    // question do add
    public function doAdd(Request $request)
    {
    	$content = $request->get('content');
        $point = $request->get('point');

    	//validate
    	$validator = Validator::make($request->all(), [
    	 	'content' => 'bail|required|unique:questions,content',
            'point' => 'bail|required|numeric|max:5'

        ]);
        

    	 if ($validator->fails()) {
            return redirect('admin/question/add')
                        ->withErrors($validator)
                        ->withInput();
        }


        //them cau hoi dong thoi co dap an
        $question = new Question;
        $question->content = $content;
        $question->point = $point;
        $question->created_at = now();
        $question->updated_at = now();
        $question->save();

        // try {
		// 	DB::beginTransaction();
		// 	$question = new Question;
		// 	$question->content = $content;
        //     $question->point = $point;
		// 	$question->created_at = now();
		// 	$question->updated_at = now();

		// 	if($question->save()) {
		// 	 	$answer = new Answer();
		// 	 	$questionID = $question->id;
		// 		$answer->questions_id = $questionID;
        //         $answer->answers = $answers;
        //         $answer->type = $type;
		// 		$answer->created_at = now();
		// 		$answer->updated_at = now();
		// 		$answer->save();
		// 		}
		// 	DB::commit();
		// } catch (Exception $e) {
		// 	DB::rollBack();
		// 	return $e;
		// }
        return redirect(url('admin/question'));
    }


    //answer add
    public function answerAdd(Request $request, $id)
    {   
        $data['arr'] = DB::table('questions')->where('id','=',$id)->first();
        $data['answers'] = DB::table('answers')->get();
        return view('backend.addEditAnswer',$data);
    }

    //answer do add
    public function answerDoAdd(Request $request, $id)
    {
        $answers = $request->get('answers');
        $type = $request->get('type') ? 1:0 ;

        //validate
        $validator = Validator::make($request->all(), [
            'answers' => 'bail|required'
        ]);

         if ($validator->fails()) {
            return redirect('admin/question/answerAdd')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        DB::table('answers')->insertGetId([
            'questions_id' => $request->route('id'),
            'answers' => $answers,
            'type' => $type,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        return redirect(url('admin/question'));
    }

    //delete
    public function delete(Request $request, $id){
    	DB::table('questions')->where('id','=',$id)->delete();
    	DB::table('answers')->where('questions_id','=',$id)->delete();
    	return redirect(url('admin/question'));
    }
}