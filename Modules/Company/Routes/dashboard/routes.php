<?php

Route::name('dashboard.')->group(function () {
    Route::get('companies/datatable', 'CompanyController@datatable')
        ->name('companies.datatable');

    Route::get('companies/deletes', 'CompanyController@deletes')
        ->name('companies.deletes');

    Route::get('companies/select-options', 'CompanyController@selectToOptions')
    ->name('companies.show.select_options');
    Route::resource('companies', 'CompanyController')->names('companies');

    Route::get('companies/{id}/datatable-subscriptions', 'CompanyController@subscriptionsDatatable')
    ->name('companies.datatable.subscriptions');


    Route::post('companies/{id}/subscriptions', 'CompanyController@createSubscription')
    ->name('companies.store.subscription');

    Route::put('companies/{id}/edit/subscription/{subscription_id}', 'CompanyController@editSubscription')
    ->name('companies.edit.subscription');
});
