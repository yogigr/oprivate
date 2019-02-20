<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('provinces', function(){
	return response()->json(App\Province::all());
});

Route::get('cities/{province}', function(App\Province $province){
	return response()->json($province->cities()->get());
});

Route::get('courses', function(){
	return response()->json(App\Course::all());
});

Route::get('teachers', function(){
	return response()->json(App\User::where('role_id', 2)->orderBy('created_at', 'desc')->get());
});