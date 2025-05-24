<?php

    Route::group(['middleware' => config('core.route-middleware.frontend.auth')],function(){


        Route::get(
            'Influencer/ajax-index',
            [\Modules\Influencer\Http\Controllers\Frontend\InfluencerController::class , 'ajaxIndex'])
            ->name('frontend.Influencer.ajax.index');
        Route::get(
            'clients/my-campaigns',
            [\Modules\Influencer\Http\Controllers\Frontend\ClientController::class , 'my_campaigns'])
            ->name('clients.my_campaigns');
        Route::get(
            'clients/my-campaigns/{campaign_id}/events',
            [\Modules\Influencer\Http\Controllers\Frontend\ClientController::class , 'my_events'])
            ->name('clients.my_events');
        //Route::get('clients/my-influencers', [\Modules\Influencer\Http\Controllers\Frontend\ClientController::class , 'my_influencers'])->name('clients.my_influencers');
        Route::get('clients/my-campaigns/{campaign_id}/events/{event_id}', [\Modules\Influencer\Http\Controllers\Frontend\ClientController::class , 'getList'])->name('clients.getList');
        //Route::post('clients/lists', [\Modules\Influencer\Http\Controllers\Frontend\ClientController::class , 'store_lists'])->name('clients.lists');

        Route::post(
            'updateInvitationStatus/{invitation_id}',
            [\Modules\Influencer\Http\Controllers\Frontend\ClientController::class , 'updateInvitationStatus'])
            ->name('clients.updateInvitationStatus');
        Route::post(
            'update-influencer-events/{influencerId}',
            [\Modules\Influencer\Http\Controllers\Frontend\InfluencerController::class , 'updateInfluencerEvents'])
            ->name('clients.updateInfluencerEvents');
    });