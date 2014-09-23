<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::when('', 'auth');

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/login', function() {
    return View::make('user/login');
});

Route::post('/login', array('before' => 'csrf', function(){
    $inputs = Input::only(array('name', 'password'));

    if ( Auth::attempt($inputs) ) {
        return View::make("user/profile");
    } else {
        return Redirect::back()->withInput();
    }
}));

Route::get('/create-users-table', function() {
    Schema::create('users', function($table) {
        $table->increments('id');
        $table->string('name', 100);
        $table->string('password', 100);
        $table->timestamps();
    });

    $user = new User;
    $user->name = 'user';
    $user->password = Hash::make('password');
    $user->save();

    return 'テーブル作成';
});

Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('/');
});
