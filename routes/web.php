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
//welcome page
Route::get('/', function(){
	$teachers = App\User::where('role_id', 2)->orderBy('rated', 'desc')->take(8)->get();
	return view('welcome', compact('teachers', 'students'));
})->middleware('guest');


//socialite
Route::get('login/{provider}', 'Auth\LoginController@socialLogin')->where('provider', 'google|github');
Route::get('login/{provicer}/callback', 'Auth\LoginController@handleSocialCallback')->where('provider', 'google|github');

// Auth Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//search teacher
Route::get('search-teacher', 'SearchTeacherController@index')->name('search.teacher');
Route::post('rate/{teacher}', 'SearchTeacherController@rate');
//profile
Route::get('profile/{user}', 'ProfileController@index')->name('profile.index');
//schedule post
Route::post('schedule', 'ScheduleController@store')->name('schedule.store');
Route::prefix('admin')->namespace('Admin')->name('admin.')->group(function(){
	Route::middleware(['auth', 'adminOnly'])->group(function(){
		Route::get('/', 'PageController@index')->name('index');
		Route::resource('course', 'CourseController');
		Route::resource('level', 'LevelController');
		
		Route::resource('teacher', 'TeacherController')->except(['show']);
		Route::get('teacher/{teacher}/set-active', 'TeacherController@setActive');
		Route::get('teacher/{teacher}/set-nonactive', 'TeacherController@setNonactive');
		Route::post('teacher/{teacher}/educational', 'TeacherController@educational');
		Route::patch('teacher/{teacher}/educational/{educational}', 'TeacherController@updateEducational');
		Route::delete('educational/{educational}', 'TeacherController@deleteEducational');
		Route::post('teacher/{teacher}/achievement/', 'TeacherController@achievement');
		Route::patch('teacher/{teacher}/achievement/{achievement}', 'TeacherController@updateAchievement');
		Route::delete('achievement/{achievement}', 'TeacherController@deleteAchievement');

		Route::resource('student', 'StudentController')->except(['show']);

		Route::resource('schedule', 'ScheduleController')->only(['index', 'show']);

		Route::resource('administrator', 'AdministratorController')->except(['show']);

		Route::get('profile', 'ProfileController@edit');
		Route::patch('profile', 'ProfileController@update');
		Route::patch('change-password', 'ProfileController@changePassword');
	});
});

Route::prefix('teacher')->namespace('Teacher')->name('teacher.')->group(function(){
	Route::middleware(['auth', 'teacherOnly'])->group(function(){
		Route::get('/', 'PageController@index')->name('index');
		//profile
		Route::get('/profile', 'ProfileController@index')->name('profile.index');
		Route::patch('/profile/update-profile', 'ProfileController@updateProfile')->name('profile.update_profile');
		Route::patch('/profile/update-address', 'ProfileController@updateAddress')->name('profile.update_address');
		Route::patch('/profile/update-geolocation', 'ProfileController@updateGeolocation')->name('profile.update_geolocation');
		Route::patch('profile/update-contact', 'ProfileController@updateContact')->name('profile.update_contact');
		Route::patch('profile/change-password', 'ProfileController@changePassword')->name('profile.change_password');
		Route::post('profile/educational', 'ProfileController@educational')->name('profile.educational.add');
		Route::patch('profile/educational/{educational}', 'ProfileController@updateEducational')->name('profile.educational.update');
		Route::delete('educational/{educational}', 'ProfileController@deleteEducational')->name('profile.educational.delete');
		Route::post('profile/achievement', 'ProfileController@achievement')->name('profile.achievement.add');
		Route::patch('profile/achievement/{achievement}', 'ProfileController@updateAchievement')->name('profile.achievement.update');
		Route::delete('achievement/{achievement}', 'ProfileController@deleteAchievement')->name('profile.achievement.delete');
		
		//course
		Route::get('setting', 'SettingController@edit');
		Route::patch('setting', 'SettingController@update');

		//schedule
		Route::get('schedule', 'ScheduleController@index');
		Route::get('schedule/{schedule}', 'ScheduleController@show');
		Route::delete('schedule/{schedule}/confirm-finish', 'ScheduleController@confirmFinish');
		Route::patch('schedule/{schedule}/update-note', 'ScheduleController@updateNote');
		Route::get('pending-schedule', 'ScheduleController@pending');
		Route::patch('pending-schedule/{schedule}/confirm', 'ScheduleController@confirm');
	});
});

Route::prefix('student')->namespace('Student')->name('student.')->group(function(){
	Route::middleware(['auth', 'studentOnly'])->group(function(){
		Route::get('/', 'PageController@index')->name('index');

		//profile
		Route::get('/profile', 'ProfileController@index')->name('profile.index');
		Route::patch('/profile/update-profile', 'ProfileController@updateProfile')->name('profile.update_profile');
		Route::patch('/profile/update-address', 'ProfileController@updateAddress')->name('profile.update_address');
		Route::patch('/profile/update-geolocation', 'ProfileController@updateGeolocation')->name('profile.update_geolocation');
		Route::patch('profile/update-contact', 'ProfileController@updateContact')->name('profile.update_contact');
		Route::patch('profile/change-password', 'ProfileController@changePassword')->name('profile.change_password');

		//schedule
		Route::get('pending-schedule', 'ScheduleController@pending');
		Route::get('schedule', 'ScheduleController@index');
		Route::get('schedule/{schedule}', 'ScheduleController@show');
		Route::patch('schedule/{schedule}/request-finish', 'ScheduleController@requestFinish');
		Route::delete('pending-schedule/{schedule}/cancel', 'ScheduleController@cancel');

	});
});

