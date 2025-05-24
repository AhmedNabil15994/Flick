<?php

// signup
Route::group(['prefix' => 'signup'], function () {
    Route::get('/', 'SignController@showsignup')->name('frontend.signup');
    Route::post('/', 'SignController@signup')->name('frontend.post.signup');
});

// signin
Route::group(['prefix' => 'signin'], function () {
    Route::get('/', 'SignController@showsignin')->name('login');
    Route::post('/', 'SignController@signin')->name('frontend.post.signin');
});

// logout
Route::group(['prefix' => 'signout','middleware' => config('core.route-middleware.frontend.auth')], function () {
    Route::any('/', 'SignController@signout')->name('frontend.logout');
});


// Route::group(['prefix' => 'reset'], function () {

//     // Show Forget Password Form
//     Route::get('{token}', 'ResetPasswordController@resetPassword')
//     ->name('frontend.password.reset')
//     ->middleware('guest');

//     // Send Forget Password Via Mail
//     Route::post('/', 'ResetPasswordController@updatePassword')
//     ->name('frontend.password.update');

// });
