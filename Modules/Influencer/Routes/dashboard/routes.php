<?php

use Illuminate\Support\Facades\Route;

Route::name('dashboard.')->group(function () {
    Route::get('tags/datatable', 'TagController@datatable')
        ->name('tags.datatable');

    Route::get('tags/select-options', 'TagController@selectToOptions')
        ->name('tags.show.options');

    Route::get('tags/deletes', 'TagController@deletes')
        ->name('tags.deletes');

    Route::resource('tags', 'TagController')->names('tags');
});


Route::name('dashboard.')->group(function () {
    Route::get('influencers/select-options', 'InfluencerController@selectToOptions')
        ->name('influencers.show.influencers_options');

    Route::get('influencers/datatable', 'InfluencerController@datatable')
    ->name('influencers.datatable');

    Route::get('influencers/deletes', 'InfluencerController@deletes')
        ->name('influencers.deletes');

    Route::resource('influencers', 'InfluencerController')->names('influencers');
});

//event
Route::name('dashboard.')->group(function () {
    Route::get('campaigns/datatable', 'CampaignController@datatable')
        ->name('campaigns.datatable');

    Route::get('campaigns/deletes', 'CampaignController@deletes')
        ->name('campaigns.deletes');

    Route::resource('campaigns', 'CampaignController')->names('campaigns');
});

Route::name('dashboard.')->group(function () {
    Route::get('events/datatable', 'EventController@datatable')
        ->name('events.datatable');

    Route::get('events/deletes', 'EventController@deletes')
        ->name('events.deletes');

    Route::get('events/statistics/{id}', 'EventController@refreshInvitationStatistics')
    ->name('events.invitation.statistics.show');

    Route::get('events/{id}/invitation/{invitationId}', 'EventController@changeInfluencerStatus')
        ->name('events.invitation.change.status');

    Route::post('events/{id}/influencers', 'EventController@addInfluencers')
        ->name('events.show.add_influencers');

    Route::resource('events', 'EventController')->only(["store","update","destroy"])->names('events');

    Route::get('campaigns/{campaign}/events', 'EventController@index')
         ->name('events.index');
    Route::get('campaigns/{campaign}/events/create', 'EventController@create')
    ->name('events.create');

    Route::get('campaigns/{campaign}/events/{id}/edit', 'EventController@edit')
    ->name('events.edit');
    Route::get('campaigns/{campaign}/events/{id}', 'EventController@show')
          ->name('events.show');
});


// invitations
Route::name('dashboard.')->group(function () {
    Route::get('invitations/datatable', 'InvitationController@datatable')
        ->name('events.show.invitations.datatable');

    Route::post('invitations/update_status', 'InvitationController@update_status')
        ->name('events.show.invitations.update_status');
    Route::post('invitations/upload_video', 'InvitationController@upload_video')
        ->name('events.show.invitations.upload_video');
    Route::post('invitations/update_invitation_status', 'InvitationController@update_invitation_status')
        ->name('events.show.invitations.update_invitation_status');
});


// instagram
Route::name('dashboard.')->group(function () {
    Route::get('instagram/datatable', 'InstagramController@datatable')
        ->name('instagram.datatable');

    Route::get('instagram/deletes', 'InstagramController@deletes')
        ->name('instagram.deletes');

    Route::resource('instagram', 'InstagramController')->names('instagram');

    Route::any('instagram/{id}/stat-update', 'InstagramController@updateStat')
    ->name('instagram.show.update_stat');
});

// youtube
Route::name('dashboard.')->group(function () {
    Route::get('youtube/datatable', 'YoutubeController@datatable')
        ->name('youtube.datatable');

    Route::get('youtube/deletes', 'YoutubeController@deletes')
        ->name('youtube.deletes');

    Route::resource('youtube', 'YoutubeController')->names('youtube');
    Route::any('youtube/{id}/stat-update', 'YoutubeController@updateStat')
    ->name('youtube.show.update_stat');
});

//tiktok
Route::name('dashboard.')->group(function () {
    Route::get('tiktok/datatable', 'TiktokController@datatable')
        ->name('tiktok.datatable');

    Route::get('tiktok/deletes', 'TiktokController@deletes')
        ->name('tiktok.deletes');

    Route::resource('tiktok', 'TiktokController')->names('tiktok');

    Route::any('tiktok/{id}/stat-update', 'TiktokController@updateStat')
    ->name('tiktok.show.update_stat');
});

//twitch
Route::name('dashboard.')->group(function () {
    Route::get('twitch/datatable', 'TwitchController@datatable')
        ->name('twitch.datatable');

    Route::get('twitch/deletes', 'TwitchController@deletes')
        ->name('twitch.deletes');

    Route::resource('twitch', 'TwitchController')->names('twitch');
});
