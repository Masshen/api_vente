<?php

use Illuminate\Support\Facades\Route;

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
    $name="jacques TTT";
    $ages=5;
    $articles=array(
        array(
            "title"=>"fddffd",
            "description"=>"gfffdfdf jfdgjfkdjkfd",
            "icon"=>"thumb-up"
        ),
        array(
            "title"=>"",
            "description"=>"",
            "icon"=>"cup"
        ),
        array(
            "title"=>"",
            "description"=>"",
            "icon"=>"wallet"
        ),
        array(
            "title"=>"",
            "description"=>"",
            "icon"=>"dashboard"
        )
    );
    return view('home',compact('name','ages','articles'));
});
