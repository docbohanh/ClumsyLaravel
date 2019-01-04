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

Route::get('/', function () {
    return view('welcome');
});

// Query Builder

Route::get('qb/get', function() {
    $data = DB::table('users')->get();
    foreach ($data as $row) {
        foreach($row as $key=>$value) {
            echo $key.": ".$value."<br>";            
        }
        echo "<hr>";
    }
});

// select * from users where id=2
Route::get('qb/where', function() {
    $data = DB::table('users')->where('id', '=', 2)->get();
    foreach ($data as $row) {
        foreach($row as $key=>$value) {
            echo $key.": ".$value."<br>";            
        }
        echo "<hr>";
    }
});

// select id, name, email from users ...
Route::get('qb/select', function() {

    $data = DB::table('users')->select(['id', 'name', 'email'])->where('id', 2)->get();

    foreach ($data as $row) {
        foreach($row as $key=>$value) {
            echo $key.": ".$value."<br>";            
        }
        echo "<hr>";
    }
});

Route::get('qb/raw', function() {

    $data = DB::table('users')
        ->select(DB::raw('id, name as hoten, email'))
        ->where('id', 2)
        ->get();

    foreach ($data as $row) {
        foreach($row as $key=>$value) {
            echo $key.": ".$value."<br>";            
        }
        echo "<hr>";
    }
});

Route::get('qb/orderBy', function() {

    $data = DB::table('users')
    ->select(DB::raw('id, name as hoten, email'))
    ->where('id', '>', 1)
    ->orderBy('id', 'desc')
    // ->skip(1)
    ->take(2)
    ->get();

    // echo $data->count();

    foreach ($data as $row) {
        foreach($row as $key=>$value) {
            echo $key.": ".$value."<br>";            
        }
        echo "<hr>";
    }
});

Route::get('qb/update', function() {
    DB::table('users')
    ->where('id', 1)
    ->update(['name' => 'Website']);
    echo "Updated";
});

Route::get('qb/delete', function() {
    DB::table('users')
    ->where('id', 1)
    ->delete();
    echo "Deleted";
});

Route::get('qb/deleteAll', function() {
    DB::table('users')
    ->truncate();
    echo "Deleted All";
});

// TODO APP

// Home Page
Route::get('/', 'AuthController@home');

// Login and Logout
Route::get('/login', ['middleware' => 'guest', 'uses' => 'AuthController@getLogin']);
Route::post('/login', ['middleware' => 'guest', 'uses' => 'AuthController@postLogin']);
Route::get('/logout', ['middleware' => 'auth', 'uses' => 'AuthController@logout']);

// Registration and User Profile
Route::resource('user', 'UserController', ['except' => ['index', 'show', 'destroy']]);

// Todo Resources
Route::resource('todo', 'TodoController', ['middleware' => 'auth']);