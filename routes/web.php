<?php

Route::view('/', 'welcome');
Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

Route::apiResource('/url', 'UrlController');

Route::get('u/{url}', 'UrlController@show');
Route::any('{url}', function () {
    return view('welcome');
})->where('url', '.*');

Route::post('password/reset/{token}', function () {
    return '';
})->name('password.reset');
