<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
//  });

Auth::routes();

Route::get("admin", function(){
	return redirect(url('login'));
});

Route::get("home", function(){
    return redirect(url('admin/user'));
});

//log out 
Route::get("logout",function(){
	Auth::logout();
	return redirect(url("login"));	
});

//Group admin
Route::group(array("prefix"=>"admin","middleware"=>"auth"), function(){

	//list user
	Route::get("user","UserController@listUser");

	//edit user
	Route::get("user/edit/{id}","UserController@edit");

	//do edit user
	Route::post("user/edit/{id}","UserController@doEdit");

	//add user
	Route::get("user/add","UserController@add");

	//do add user
	Route::post("user/add","UserController@doAdd");

	//delete user
	Route::get("user/delete/{id}","UserController@delete");
	
	//--------------------------------------------------------------------
	//--------------------------------------------------------------------
	//list result
	Route::get("result","ResultController@listResult");

	//delete result
	Route::get("result/delete/{id}","ResultController@delete");

	//--------------------------------------------------------------------
	//--------------------------------------------------------------------
	//list thread
	Route::get("thread","ThreadController@listThread");

	//edit thread
	Route::get("thread/edit/{id}","ThreadController@edit");

	//do edit thread
	Route::post("thread/edit/{id}","ThreadController@doEdit");

	//add thread
	Route::get("thread/add","ThreadController@add");

	//do add
	Route::post("thread/add","ThreadController@doAdd");

	//delete
	Route::get("thread/delete/{id}","ThreadController@delete");


	//--------------------------------------------------------------------
	//--------------------------------------------------------------------
	//add detail
	Route::get("thread/detailAdd/{id}","ThreadController@detailAdd");

	//do add detail
	Route::post("thread/detailAdd/{id}","ThreadController@detailDoAdd");

	//edit detail
	Route::get("thread/detailEdit/{id}","ThreadController@detailEdit");

	//do edit detail
	Route::post("thread/detailEdit/{id}","ThreadController@detailDoEdit");



	//--------------------------------------------------------------------
	//--------------------------------------------------------------------
    //list question
    Route::get("question","QuestionController@listQuestion");

	//add question
	Route::get("question/add","QuestionController@add");

	//do add question
	Route::post("question/add","QuestionController@doAdd");

	//edit question
	Route::get("question/edit/{id}","QuestionController@edit");

	//do edit question
	Route::post("question/edit/{id}","QuestionController@doEdit");

	//delete
	Route::get("question/delete/{id}","QuestionController@delete");

	//--------------------------------------------------------------------

	//--------------------
	//answer
	//add answer
	Route::get("question/answerAdd/{id}","QuestionController@answerAdd");

	//do add answer
	Route::post("question/answerAdd/{id}","QuestionController@answerDoAdd");

	//add answer
	Route::get("question/answerEdit/{id}","QuestionController@answerEdit");

	//do add answer
	Route::post("question/answerEdit/{id}","QuestionController@answerDoEdit");
	//--------------------
	
});

//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
//--------------------------------------------------------------------------
//front end
Route::get("index", function(){
    return redirect(url("index/signin"));
});

Route::group(['prefix'=>'index'],function(){

	//sign in
	Route::get("signin","IndexController@getSignin");

	//sign in
	Route::post("signin","IndexController@postSignin");

	//exam
	Route::get("exam","IndexController@listExam");

	//results
	Route::get("results","IndexController@getResult");

            
	//logout
	Route::get("signout","IndexController@getLogout");
});