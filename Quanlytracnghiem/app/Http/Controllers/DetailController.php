<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Model\ThreadDetail;


class DetailController extends Controller
{
    public function listDetail(Request $request)
    {
        $data['details'] = DB::table('thread_details')->join('questions','thread_details.questions_id','=','questions.id')
                                                      ->select('questions.content','thread_details.threads_id','thread_details.id','questions.point')
                                                      ->orderBy('thread_details.id','desc')
                                                      ->paginate(10);
        return view("backend.listDetail",$data);
    }

    //delete details
    public function delete(Request $request, $id)
    {   
        ThreadDetail::where('id','=',$id)->delete();
        return redirect(url('admin/detail'));
    }
}
