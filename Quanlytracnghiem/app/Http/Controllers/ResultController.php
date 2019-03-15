<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Model\Result;

class ResultController extends Controller
{
    //list
    public function listResult(Request $request)
    {
        
        $data["arr"] = DB::table('results')->leftjoin('users','results.users_id','=','users.id')
                                           ->select('users.name','results.threads_id','results.users_point','results.answers_id','results.id')
                                           ->paginate(10);
        return view("backend.listResult",$data);
        
    }

    //delete
    public function delete(Request $request, $id)
    {
    	Result::where('id','=',$id)->delete();
    	return redirect(url('admin/result'));
    }
}