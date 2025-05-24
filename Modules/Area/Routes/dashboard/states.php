<?php
use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group( function () {

    Route::get('states/select-options', 'StateController@selectToOptions')
    ->name('states.show.options');
    Route::get('states/datatable'	,'StateController@datatable')
        ->name('states.datatable');

    Route::get('states/deletes'	,'StateController@deletes')
        ->name('states.deletes');

    Route::resource('states','StateController')->names('states');
});
