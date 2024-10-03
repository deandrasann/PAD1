<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index']);

Route::get('/forgot-password', function(){
    return view('forgot-password');
});
Route::get('/password-verification', function(){
    return view('new-pass-verification');
});
