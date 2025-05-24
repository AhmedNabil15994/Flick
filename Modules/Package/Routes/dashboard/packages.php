<?php
use Illuminate\Support\Facades\Route;


Route::name('dashboard.')->group( function () {

    Route::get('packages/datatable'	,'PackageController@datatable')
        ->name('packages.datatable');

    Route::get('packages/deletes'	,'PackageController@deletes')
        ->name('packages.deletes');

    Route::resource('packages','PackageController')->names('packages');

});
