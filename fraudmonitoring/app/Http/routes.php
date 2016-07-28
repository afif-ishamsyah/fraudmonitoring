<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//fungsi umum
Route::get('loginform','HomeController@loginform');
Route::post('login','HomeController@login');
Route::get('logout','HomeController@logout');
//anti-get di controller
Route::get('login','HomeController@login'); 

	//fungsi admin
Route::get('admin','HomeController@admin');
Route::get('userform','HomeController@userform');
Route::get('paramform','HomeController@paramform');
Route::get('edituserform','HomeController@edituserform');
Route::post('register','HomeController@register');
Route::post('edituser','HomeController@edituser');
Route::post('addcaseparam','HomeController@addcaseparam');
Route::post('addactparam','HomeController@addactparam');
Route::get('/','HomeController@home');
//anti-get di controller
Route::get('register','HomeController@register');
Route::get('edituser','HomeController@edituser');
Route::get('addcaseparam','HomeController@addcaseparam');
Route::get('addactparam','HomeController@addactparam');
//fungsi user
Route::get('user','HomeController@user');
Route::get('search','HomeController@search');
Route::get('searchnumber','HomeController@searchnumber');
Route::get('searchdate','HomeController@searchdate');
Route::get('searchinputdate','HomeController@searchinputdate');
Route::get('searcham','HomeController@searcham');
Route::get('searchcustomer','HomeController@searchcustomer');
Route::post('insert','HomeController@insertcase');
Route::get('caseform','HomeController@caseform');
Route::get('listprofile','HomeController@listprofile');
Route::get('editingprofile/{id1}','HomeController@editingprofile');
Route::post('editingprofileprocess','HomeController@editingprofileprocess');
Route::post('checkprofile','HomeController@checkprofile');
Route::post('addactivity','HomeController@addactivity');
Route::get('cases/{id1}',[
   'as' => 'closed',
   'uses' => 'HomeController@cases'
]);
Route::get('getact/{filename}','HomeController@getact');
Route::get('getcase/{filename}','HomeController@getcase');
//anti-get di controller
Route::get('checkprofile','HomeController@checkprofile');
Route::get('editingprofileprocess','HomeController@editingprofileprocess');
Route::get('addactivity','HomeController@addactivity');
Route::get('insert','HomeController@insertcase');

