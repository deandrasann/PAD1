<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
});
Route::get('/forgot-password', function(){
    return view('forgot-password');
});
Route::get('/password-verification', function(){
    return view('new-pass-verification');
});
