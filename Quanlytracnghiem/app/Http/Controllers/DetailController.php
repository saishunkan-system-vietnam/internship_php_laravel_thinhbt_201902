<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Model\ThreadDetail;


class DetailController extends Controller
{
    //list
    public function listDetail(Request $request)
    {
        $data['details'] = DB::table('thread_details')->join('questions','thread_details.questions_id','=','questions.id')
                                                      ->select('questions.content','thread_details.threads_id','thread_details.id','questions.point')
                                                      ->orderBy('thread_details.id','desc')
                                                      ->paginate(10);
        return view("backend.listDetail",$data);
    }

    //add
    public function add(Request $request, $id)
    {
        $data['arr'] = DB::table('threads')->where("id","=",$id)->first();
        $data['questions'] = DB::table('questions')->get();
        return view("backend.addEditDetail",$data);
    }

    //do add
    public function doAdd(Request $request, $id)
    {
        $questions_id = $request->get('questions_id');
        $total_questions = DB::table('threads')->where("id","=",$id)->get()->toArray();
        
        DB::table('thread_details')->where('id','=',$id)->insert([
            'threads_id' => $request->route('id'),
            'questions_id'=>$questions_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        DB::table('threads')->where("id","=",$id)->update(['total_questions'=>$total_questions[0]->total_questions + 1]);
        return redirect(url('admin/thread'));
    }

    //delete details
    public function delete(Request $request, $id)
    {   
        ThreadDetail::where('id','=',$id)->delete();
        return redirect(url('admin/detail'));
    }
}
