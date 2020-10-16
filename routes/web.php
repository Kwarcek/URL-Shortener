<?php

Route::get('u/{url}', 'UrlController@show');
Route::view('/', 'welcome');
Route::view('{url}', 'welcome');

Route::resource('/api/url', 'UrlController');

Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout');
Route::post('/password/send-email', 'Auth\ForgotPasswordController@sendResetLinkEmail');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
