<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\MessageBag;
use App\Model\User;
use Hash;

class UserController extends Controller
{   


    //list_user
    public function listUser(Request $request)
    {
    	//lay toan bo ban ghi
    	$data["arr"] = User::paginate(10);
    	return view("backend.listUser",$data);
    }

    //edit
    public function edit(Request $request, $id){
    	//lay 1 ban ghi
    	$data["record"] = User::where("id","=",$id)->first();
    	return view("backend.addEditUser",$data);
    }

    //do edit
    public function doEdit(Request $request, $id){
    	$name = $request->get("name");
    	$email = $request->get("email");
    	$phone = $request->get("phone");
    	$password = $request->get("password");

    	//validate
    	$validator = Validator::make($request->all(), [
    	 	'name' => 'bail|required|',
    	 	'email' => 'bail|required|email|unique:users,email',//regex:/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$
            'phone' => 'bail|required|regex:/(0)[0-9]{9,20}/|numeric',  
        ]);
    	
    	 if ($validator->fails()) {
            return redirect('admin/user/edit/'.$id)
                        ->withErrors($validator)
                        ->withInput($request->input());
        }else{
        	User::where("id","=",$id)->update(array("name"=>$name,"email"=>$email,"phone"=>$phone));
			if ($password != "") {
				$password = Hash::make($password);
				User::where("id","=",$id)->update(array("password"=>$password)); 
			}  	
		return redirect(url('admin/user'));
        }	
    }

    //add
    public function add(Request $request){
		
    	return view("backend.addEditUser");
    }

    //do add
    public function doAdd(Request $request){
    	$name = $request->get("name");
    	$email = $request->get("email");
    	$phone = $request->get("phone");
    	$password = $request->get("password");
    	$password = Hash::make($password);
        $type = 0;

    	//validate
    	$validator = Validator::make($request->all(), [
    	 	'name' => 'bail|required|',
    	 	'email' => 'bail|required|email|unique:users,email',//regex:/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$
            'phone' => 'bail|required|regex:/(0)[0-9]{9,20}/|numeric', 
            'password' =>'bail|required|'
        ]);

    	if ($validator->fails()) {
            return redirect('admin/user/add')
                        ->withErrors($validator)
                        ->withInput();
        }

		User::insert(array("name"=>$name,"email"=>$email,"phone"=>$phone,"password"=>$password,"type"=>$type));

    	return redirect(url('admin/user'));
    }

    //delete
    public function delete(Request $request, $id){
    	User::where("id","=",$id)->delete();
    	return redirect(url('admin/user'));
    }
}