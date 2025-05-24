<?php

use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group(function () {
    Route::get('devices/datatable', 'DeviceTokenController@datatable')
        ->name('devices.datatable');

    Route::get('devices/deletes', 'DeviceTokenController@deletes')
        ->name('devices.deletes');

    Route::resource('devices', 'DeviceTokenController')->names('devices');
});


Route::group(['prefix' => 'notifications'], function () {
    Route::get('/', 'NotificationController@index')
           ->name('dashboard.notifications.index')
         
           ;

    Route::post('/', 'NotificationController@send')
            ->name('dashboard.notifications.send')
            ;
});
