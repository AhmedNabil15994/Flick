<?php

Route::group(['prefix' => 'user','middleware' => 'auth:sanctum'], function () {
    Route::get('profile', 'UserController@profile')->name('api.users.profile');
    Route::get('notifications', 'UserController@notifications')->name('api.users.notifications');
    Route::delete('notifications', 'UserController@deleteNotifications')->name('api.users.delete-notifications');
    Route::post('profile', 'UserController@updateProfile')->name('api.users.update-profile');
    Route::put('change-password', 'UserController@changePassword')->name('api.users.change.password');
});

