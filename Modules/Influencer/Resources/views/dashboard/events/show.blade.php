@extends('apps::dashboard.layouts.app')
@section('title', __('influencer::dashboard.events.routes.show'))
@section('css')
    <style>
        a.openModal{
            text-decoration: none;
            color: #000;
            cursor: pointer;
        }
        .mt-5{
            margin-top:15px;
        }
        .mt-10{
            margin-top:25px;
        }
        .switch {
          position: relative;
          display: inline-block;
          width: 40px;
          height: 34px;
        }

        .switch input {display:none;}

        .slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #ccc;
          -webkit-transition: .4s;
          transition: .4s;
        }

        .slider:before {
          position: absolute;
          content: "";
          height: 20px;
          width: 20px;
          left: -5px;
          bottom: -5px;
          background-color: #DDD;
          -webkit-transition: .4s;
          transition: .4s;
        }

        input:checked + .slider {
          background-color: #2196F3;
        }

        input:focus + .slider {
          box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
          -webkit-transform: translateX(26px);
          -ms-transform: translateX(26px);
          transform: translateX(26px);
          left: -10px;
        }

        /* Rounded sliders */
        .slider.round {
          border-radius: 34px;
        }

        .slider.round:before {
          border-radius: 50%;
        }
        @media print {

            html,
            body {
                height: auto;
            }

            .dt-print-table,
            .dt-print-table thead,
            .dt-print-table th,
            .dt-print-table tr {
                border: 0 none !important;
            }
        }
    </style>
@endsection
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('dashboard.home')) }}">{{ __('apps::dashboard.index.title') }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ url(route('dashboard.campaigns.index')) }}">
                            {{ __('influencer::dashboard.campaigns.routes.index') }}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ url(route('dashboard.campaigns.show', $campaign->id)) }}">{{ $campaign->title }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ url(route('dashboard.events.index', $model->id)) }}">
                            {{ __('influencer::dashboard.events.routes.index') }}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{ __('influencer::dashboard.events.routes.show') }} -
                            {{ $model->title }}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">

                <div class="col-md-12">

                        {{-- RIGHT SIDE --}}
                        <div class="">
                            <ul class="nav nav-tabs">


                                <li
                                    class="nav-item {{ request()->tab == 'general' || !request()->tab ? 'active' : '' }}">
                                    <a href="#general" data-toggle="tab">
                                        {{ __('influencer::dashboard.events.form.tabs.general') }}
                                    </a>
                                </li>

                                <li class="nav-item {{ request()->tab == 'invitations' ? 'active' : '' }}">
                                    <a href="#invitations" data-toggle="tab">
                                        {{ __('influencer::dashboard.events.datatable.invitations') }}
                                    </a>
                                </li>

                                <li class="nav-item {{ request()->tab == 'influencers-instagram' ? 'active' : '' }}">
                                    <a href="#influencers-instagram" data-toggle="tab">
                                        {{ __('influencer::dashboard.events.datatable.influencers_instagram') }}
                                    </a>
                                </li>

                                <li class="nav-item {{ request()->tab == 'influencers-youtube' ? 'active' : '' }}">
                                    <a href="#influencers-youtube" data-toggle="tab">
                                        {{ __('influencer::dashboard.events.datatable.influencers_youtube') }}
                                    </a>
                                </li>

                                <li class="nav-item {{ request()->tab == 'influencers-tiktok' ? 'active' : '' }}">
                                    <a href="#influencers-tiktok" data-toggle="tab">
                                        {{ __('influencer::dashboard.events.datatable.influencers_tiktok') }}
                                    </a>
                                </li>


                            </ul>
                        </div>

                        {{-- PAGE CONTENT --}}

                        <div class="tab-content">

                            {{-- UPDATE FORM --}}
                            <div class="tab-pane  {{ request()->tab == 'general' || !request()->tab ? 'active' : '' }} fade in"
                                id="general">
                                <div class="col-md-12">

                                    <table class="table table-bordered table-striped">

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.events.datatable.title') }}
                                            </th>
                                            <td>
                                                {{ $model->title }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.events.datatable.description') }}
                                            </th>
                                            <td>
                                                {!! $model->description !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.events.datatable.campaign_id') }}
                                            </th>
                                            <td>
                                                {{ optional($model->campaign)->title }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.events.form.companions_count') }}
                                            </th>
                                            <td>
                                                {{ $model->companions_count }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.events.form.campaign_url') }}
                                            </th>
                                            <td>
                                                <div class="input-group  col-md-6">
                                                    <input type="text" class="form-control" id="campaign_url" readonly value="{{route('clients.getList',['campaign_id'=>hash_id($model->campaign->id),'event_id'=>hash_id($model->id)])}}">
                                                    <span class="input-group-btn">
                                                            <button class="btn white" type="button" onclick="copyLink()">Copy</button>
                                                        </span>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.events.form.location') }}
                                            </th>
                                            <td>
                                                @if ($model->location)
                                                    <a href="{{ $model->localtion }}"><i class="fa fa-map"></i></a>
                                                @else
                                                    ------
                                                @endif

                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.events.form.helper_links') }}
                                            </th>
                                            <td>
                                                @if ($model->helper_links)
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Key</th>
                                                                <th>link</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($model->helper_links as $link)
                                                                <tr>
                                                                    <td>
                                                                        {{ $link['key'] }}
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ $link['link'] }}">
                                                                            {{ $link['link'] }}</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                @else
                                                    ------
                                                @endif
                                            </td>
                                        </tr>


                                        <tr>
                                            <td class="invoice-title uppercase" style="width: 200px">
                                                {{ __('influencer::dashboard.events.datatable.start_at') }}
                                            </td>
                                            <td>

                                                {{ $model->start_at->format('d-m-Y h:i a') }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="invoice-title uppercase" style="width: 200px">
                                                {{ __('influencer::dashboard.events.datatable.start_at') }}
                                            </td>
                                            <td>

                                                {{ optional($model->start_at)->format('d-m-Y h:i a') ?? '---' }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="invoice-title uppercase" style="width: 200px">
                                                {{ __('influencer::dashboard.events.datatable.created_at') }}
                                            </td>
                                            <td>

                                                {{ $model->created_at->format('d-m-Y h:i a') }}
                                            </td>
                                        </tr>




                                    </table>


                                </div>
                            </div>


                            {{-- UPDATE FORM --}}
                            <div class="tab-pane  {{ request()->tab == 'invitations' ? 'active' : '' }} fade in"
                                id="invitations">
                                <div class="col-md-12">
                                    <div>
                                        <form id="formFilter" class="horizontal-form">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div id="invitation_statistics">
                                                        @include('influencer::dashboard.events.components.statistics')
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                {{ __('apps::dashboard.datatable.form.status') }}
                                                            </label>
                                                            <div class="">
                                                                <select id="status" name="status" class="form-control select2">
                                                                    <option value="">@lang('apps::dashboard.buttons.select_all')</option>
                                                                    @foreach (\Modules\Influencer\Enum\InvitationStatus::getConstList() as $item)
                                                                        <option value="{{ $item }}">
                                                                            {{__("influencer::dashboard.events.datatable.invitations_statuses.$item")}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
                                        <div class="form-actions">
                                            <button class="btn btn-sm green btn-outline filter-submit margin-bottom"
                                                id="filterInvatition">
                                                <i class="fa fa-search"></i>
                                                {{ __('apps::dashboard.datatable.search') }}
                                            </button>
                                            <button class="btn btn-sm red btn-outline filterInvatitionReset">
                                                <i class="fa fa-times"></i>
                                                {{ __('apps::dashboard.datatable.reset') }}
                                            </button>

                                            <div class="row mt-5">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">
                                                            {{ __('influencer::dashboard.events.form.status') }}
                                                        </label>
                                                        <div class="">
                                                            <select name="invitation_status" class="form-control select2">
                                                                <option value="">@lang('apps::dashboard.buttons.select_all')</option>
                                                                @foreach (\Modules\Influencer\Enum\InvitationStatus::getConstList() as $item)
                                                                    <option value="{{ $item }}">
                                                                        {{__("influencer::dashboard.events.datatable.invitations_statuses.$item")}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm yellow btn-outline update_status mt-10" id="update_status" data-target="#table-invitations">
                                                    <i class="fa fa-save"></i>
                                                    {{ __('influencer::dashboard.events.form.update_status') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table
                                            class="table dataTable table-striped table-bordered table-hover table-responsive "
                                            id="table-invitations" style="width: 100%">
                                            <thead>

                                                <th>
                                                    <a href="javascript:;" onclick="CheckAll('#invitations')">
                                                        {{ __('apps::dashboard.buttons.select_all') }}
                                                    </a>
                                                </th>
                                                <th>@lang('user::dashboard.admins.datatable.name')</th>
                                                <th>@lang('influencer::dashboard.influencers.datatable.mobile')</th>
                                                <th>{{ __('influencer::dashboard.influencers.datatable.instagram') }}</th>
                                                <th>{{ __('influencer::dashboard.influencers.datatable.youtube') }}</th>
                                                <th>{{ __('influencer::dashboard.influencers.datatable.tiktok') }}</th>
                                                <th>@lang('influencer::dashboard.events.form.video')</th>
                                                <th>@lang('influencer::dashboard.events.form.invitation_status')</th>
                                                <th>@lang('influencer::dashboard.events.form.status')</th>

                                            </thead>
                                            <tbody>

                                            </tbody>

                                        </table>
                                    </div>


                                </div>
                            </div>

                            {{-- influencers instagram --}}
                            <div class="tab-pane  {{ request()->tab == 'influencers-instagram' ? 'active' : '' }} fade in"
                                id="influencers-instagram">
                                <div class="col-md-12">
                                    <div>
                                        <form id="instagram-filter" class="horizontal-form">
                                            <div class="form-body">
                                                <div class="row no-gutters">

                                                    {{-- stat filter --}}
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            @foreach (["followers", "audience_credibility", "engagements", "avg_comments", "avg_views","avg_reels_plays" ] as $item)
                                                                <div class="col-md-4 ">
                                                                    <div class="form-group"  style="border: 2px solid #ddd ; padding: 10px ;  margin: 2px">

                                                                        <label class="control-label">
                                                                            @lang("influencer::dashboard.instagram.form.$item")
                                                                        </label>

                                                                        <div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <input class="form-control" placeholder="{{ __('influencer::dashboard.influencers.datatable.filters.start')}}" name="{{$item}}[start]">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <input class="form-control" placeholder="{{ __('influencer::dashboard.influencers.datatable.filters.end')}}" name="{{$item}}[end]">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    {{-- end  --}}
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                {{ __('influencer::dashboard.influencers.form.tabs.address') }}
                                                            </label>
                                                            <div>
                                                                @include('influencer::dashboard.influencers.address_filter')
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="form-actions" style="margin-top: 10px">
                                            <div>
                                                <button class="btn btn-sm green btn-outline filter-influencer margin-bottom"
                                                    id=""
                                                    data-type="instagram"
                                                    >
                                                    <i class="fa fa-search"></i>
                                                    {{ __('apps::dashboard.datatable.search') }}
                                                </button>
                                                <button class="btn btn-sm red btn-outline reset-influencer "  data-type="instagram">
                                                    <i class="fa fa-times"></i>
                                                    {{ __('apps::dashboard.datatable.reset') }}
                                                </button>
                                            </div>
                                            <hr />
                                            <button class="btn btn-sm yellow btn-outline add_influencer " id="add_influencer" data-target="#dataTable-instagram">
                                                <i class="fa fa-save"></i>
                                                {{ __('influencer::dashboard.events.form.add_influencers') }}
                                            </button>
                                        </div>
                                    </div>

                                    <div class="table-responsived" style="margin-top: 20px">

                                        <table class="table table-striped table-bordered table-hover" id="dataTable-instagram" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <a href="javascript:;" onclick="CheckAll('#influencers-instagram')">
                                                            {{ __('apps::dashboard.buttons.select_all') }}
                                                        </a>
                                                    </th>
                                                    <th>#</th>
                                                    <th>{{ __('influencer::dashboard.influencers.datatable.image') }}</th>
                                                    <th>{{ __('influencer::dashboard.influencers.datatable.name') }}</th>
                                                    <th>{{ __('influencer::dashboard.instagram.datatable.user_name') }}</th>
                                                    <th>{{ __('influencer::dashboard.instagram.form.followers') }}</th>
                                                    <th>{{ __('influencer::dashboard.instagram.form.engagement_rate') }}</th>
                                                    <th>{{ __('influencer::dashboard.instagram.form.quality_score') }}</th>
                                                    <th>{{ __('influencer::dashboard.instagram.form.posts_count') }}</th>
                                                    <th>{{ __('influencer::dashboard.instagram.form.audience_credibility') }}</th>
                                                    <th>{{ __('influencer::dashboard.influencers.form.address_desc') }}</th>
                                                    <th>{{ __('influencer::dashboard.influencers.form.city_id') }}</th>
                                                    <th>{{ __('influencer::dashboard.influencers.form.state_id') }}</th>
                                                    <th>{{ __('influencer::dashboard.influencers.datatable.mobile') }}</th>
                                                    <th data-priority="1">
                                                        {{ __('influencer::dashboard.influencers.datatable.options') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>

                                    </div>


                                </div>
                            </div>

                            {{-- influencers youtube --}}
                            <div class="tab-pane  {{ request()->tab == 'influencers-youtube' ? 'active' : '' }} fade in"
                                id="influencers-youtube">
                                <div class="col-md-12">
                                    <div>
                                        <form id="instagram-filter" class="horizontal-form">
                                            <div class="form-body">
                                                <div class="row no-gutters">

                                                    {{-- stat filter --}}
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            @foreach (["followers", "engagements", "avg_comments", "avg_views","avg_reels_plays" ] as $item)
                                                                <div class="col-md-4 ">
                                                                    <div class="form-group"  style="border: 2px solid #ddd ; padding: 10px ;  margin: 2px">

                                                                        <label class="control-label">
                                                                            @lang("influencer::dashboard.youtube.form.$item")
                                                                        </label>

                                                                        <div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <input class="form-control" placeholder="{{ __('influencer::dashboard.influencers.datatable.filters.start')}}" name="{{$item}}[start]">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <input class="form-control" placeholder="{{ __('influencer::dashboard.influencers.datatable.filters.end')}}" name="{{$item}}[end]">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    {{-- end  --}}
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                {{ __('influencer::dashboard.influencers.form.tabs.address') }}
                                                            </label>
                                                            <div>
                                                                @include('influencer::dashboard.influencers.address_filter')
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                        <div class="form-actions" style="margin-top: 10px">
                                            <div>
                                                <button class="btn btn-sm green btn-outline filter-influencer margin-bottom"
                                                    id=""
                                                    data-type="instagram"
                                                    >
                                                    <i class="fa fa-search"></i>
                                                    {{ __('apps::dashboard.datatable.search') }}
                                                </button>
                                                <button class="btn btn-sm red btn-outline reset-influencer "  data-type="youtube">
                                                    <i class="fa fa-times"></i>
                                                    {{ __('apps::dashboard.datatable.reset') }}
                                                </button>
                                            </div>
                                            <hr />
                                            <button class="btn btn-sm yellow btn-outline add_influencer " id="add_influencer" data-target="#dataTable-youtube">
                                                <i class="fa fa-save"></i>
                                                {{ __('influencer::dashboard.events.form.add_influencers') }}
                                            </button>
                                        </div>
                                    </div>

                                    <div class="table-responsived" style="margin-top: 20px">

                                        <table class="table table-striped table-bordered table-hover" id="dataTable-youtube" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <a href="javascript:;" onclick="CheckAll('#influencers-youtube')">
                                                            {{ __('apps::dashboard.buttons.select_all') }}
                                                        </a>
                                                    </th>
                                                    <th>#</th>
                                                    <th>{{ __('influencer::dashboard.influencers.datatable.image') }}</th>
                                                    <th>{{ __('influencer::dashboard.influencers.datatable.name') }}</th>
                                                    <th>{{ __('influencer::dashboard.youtube.form.followers') }}</th>
                                                    <th>{{ __('influencer::dashboard.youtube.form.engagement_rate') }}</th>
                                                    <th>{{ __('influencer::dashboard.youtube.form.posts_count') }}</th>
                                                    <th>{{ __('influencer::dashboard.influencers.form.address_desc') }}</th>
                                                    <th>{{ __('influencer::dashboard.influencers.form.city_id') }}</th>
                                                    <th>{{ __('influencer::dashboard.influencers.form.state_id') }}</th>
                                                    <th>{{ __('influencer::dashboard.influencers.datatable.mobile') }}</th>
                                                    <th data-priority="1">
                                                        {{ __('influencer::dashboard.influencers.datatable.options') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>

                                    </div>


                                </div>
                            </div>

                              {{-- influencers tiktok --}}
                              <div class="tab-pane  {{ request()->tab == 'influencers-tiktok' ? 'active' : '' }} fade in"
                                id="influencers-tiktok">
                                <div class="col-md-12">
                                    <div>
                                        <form id="instagram-filter" class="horizontal-form">
                                            <div class="form-body">
                                                <div class="row no-gutters">

                                                    {{-- stat filter --}}
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            @foreach (["followers", "engagements", "avg_comments", "avg_views","total_likes" ] as $item)
                                                                <div class="col-md-4 ">
                                                                    <div class="form-group"  style="border: 2px solid #ddd ; padding: 10px ;  margin: 2px">

                                                                        <label class="control-label">
                                                                            @lang("influencer::dashboard.tiktok.form.$item")
                                                                        </label>

                                                                        <div>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <input class="form-control" placeholder="{{ __('influencer::dashboard.influencers.datatable.filters.start')}}" name="{{$item}}[start]">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <input class="form-control" placeholder="{{ __('influencer::dashboard.influencers.datatable.filters.end')}}" name="{{$item}}[end]">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    {{-- end  --}}

                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">
                                                                {{ __('influencer::dashboard.influencers.form.tabs.address') }}
                                                            </label>
                                                            <div>
                                                                @include('influencer::dashboard.influencers.address_filter')
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                        <div class="form-actions" style="margin-top: 10px">
                                            <div>
                                                <button class="btn btn-sm green btn-outline filter-influencer margin-bottom"
                                                    id=""
                                                    data-type="instagram"
                                                    >
                                                    <i class="fa fa-search"></i>
                                                    {{ __('apps::dashboard.datatable.search') }}
                                                </button>
                                                <button class="btn btn-sm red btn-outline reset-influencer "  data-type="youtube">
                                                    <i class="fa fa-times"></i>
                                                    {{ __('apps::dashboard.datatable.reset') }}
                                                </button>
                                            </div>
                                            <hr />
                                            <button class="btn btn-sm yellow btn-outline add_influencer " id="add_influencer" data-target="#dataTable-tiktok">
                                                <i class="fa fa-save"></i>
                                                {{ __('influencer::dashboard.events.form.add_influencers') }}
                                            </button>
                                        </div>
                                    </div>

                                    <div class="table-responsived" style="margin-top: 20px">

                                        <table class="table table-striped table-bordered table-hover" id="dataTable-tiktok" style="width: 100%">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <a href="javascript:;" onclick="CheckAll('#influencers-tiktok')">
                                                            {{ __('apps::dashboard.buttons.select_all') }}
                                                        </a>
                                                    </th>
                                                    <th>#</th>
                                                    <th>{{ __('influencer::dashboard.influencers.datatable.image') }}</th>
                                                    <th>{{ __('influencer::dashboard.influencers.datatable.name') }}</th>
                                                    <th>{{ __('influencer::dashboard.tiktok.form.followers') }}</th>
                                                    <th>{{ __('influencer::dashboard.tiktok.form.engagement_rate') }}</th>
                                                    <th>{{ __('influencer::dashboard.tiktok.form.posts_count') }}</th>
                                                    <th>{{ __('influencer::dashboard.influencers.form.address_desc') }}</th>
                                                    <th>{{ __('influencer::dashboard.influencers.form.city_id') }}</th>
                                                    <th>{{ __('influencer::dashboard.influencers.form.state_id') }}</th>
                                                    <th>{{ __('influencer::dashboard.influencers.datatable.mobile') }}</th>
                                                    <th data-priority="1">
                                                        {{ __('influencer::dashboard.influencers.datatable.options') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>

                                    </div>


                                </div>
                            </div>


                        </div>


                        <div class="">
                            <div class="form-actions">

                                <div class="form-group">

                                    <a href="{{ url(route('dashboard.events.index', $model->id)) }}" class="btn btn-lg red">
                                        {{ __('apps::dashboard.buttons.back') }}
                                    </a>
                                </div>
                            </div>
                        </div>

                </div>

            </div>
        </div>
    </div>


    @include('influencer::dashboard.events.components.videoModal')

@stop


@push('start_scripts')
    <script>
        function changeStatus(selector,invitationId){
            var url = '{{route('dashboard.events.invitation.change.status', [$model->id, '::invitationId'])}}';
            url = url.replace('::invitationId', invitationId);
            $.ajax({
                type    : "get",
                url     : url,
                data    : {
                        status     : $(selector).val(),
                    },
                success: function(msg) {

                    refreshInvitationStatistics()
                },
            });

        }

        function refreshInvitationStatistics(){


            var url = '{{route('dashboard.events.invitation.statistics.show', $model->id)}}';
            $.ajax({
                type    : "get",
                url     : url,
                success: function(data) {

                    $('#invitation_statistics').html(data.html);
                },
            });

        }

        function copyLink(){
            var copyText = document.getElementById("campaign_url");
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            navigator.clipboard.writeText(copyText.value);
        }
        $(function() {
            var dataTableInfluencers = {};
            var datatableForInvitaions;
            $("#filterInvatition").click(function() {
                var data = {
                    "status": $("#status").val(),
                    'user_name': $('#formFilter input[name="user_name"]').val(),
                    'mobile': $('#formFilter input[name="mobile"]').val(),
                    'name': $('#formFilter input[name="name"]').val(),
                }
                $('#table-invitations').DataTable().destroy()
                generateDatatable(data)
            })
            $(".filterInvatitionReset").click(function() {
                document.getElementById("formFilter").reset()
                $('#table-invitations').DataTable().destroy()
                generateDatatable()
            })

            function generateDatatable(data = {}) {
             var exportButtons = []
             @can('export_influencers')
                 exportButtons =[
                    {
                            extend: "print",
                            className: "btn blue btn-outline",
                            text: "{{ __('apps::dashboard.datatable.print') }}",
                            title: '{{ __('company::dashboard.companies.show.tabs.subscriptions') . ' ' . $model->name . '#' . $model->id }}',
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible',
                                columns: [1,2,3,4,5,6]
                            }
                    },
                    {
                            extend: "excel",
                            className: "btn blue btn-outline ",
                            text: "{{ __('apps::dashboard.datatable.excel') }}",
                            title: '{{ $model->title . '#' . $model->id }}',
                            messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.',
                            exportOptions: {
                                // stripHtml: true,
                                columns: ':visible',
                                columns: [1,2,3,4,5,6]
                            }
                    },
                 ]
             @endcan

             datatableForInvitaions=
                $('#table-invitations').DataTable({

                    ajax: {
                        url: "{{ url(route('dashboard.events.show.invitations.datatable', ['event_id' => $model->id])) }}",
                        type: "GET",
                        data: data
                    },
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ ucfirst(LaravelLocalization::getCurrentLocaleName()) }}.json"
                    },

                    stateSave: true,
                    processing: true,
                    serverSide: true,
                    responsive: !0,
                    stateSave: true,
                    processing: true,
                    serverSide: true,
                    responsive: !0,
                    order: [
                        [1, "desc"]
                    ],
                    columns: [
                        {data: 'id' 		 	        , className: 'dt-center'},
                        {
                            data: 'influencer_id',
                            className: 'dt-center'
                        },
                        {
                            data: 'mobile',
                            className: 'dt-center',
                            orderable: false,
                            render: function(data, type, row){
                                return `<a href="https://wa.me/${data}">${data}</a>`

                            }
                        },
                        {data: 'instagram_info' 	 ,  orderable: false      , className: 'dt-center'},
                        {data: 'youtube_info' 	 ,  orderable: false      , className: 'dt-center'},
                        {data: 'youtube_info'    ,  orderable: false      , className: 'dt-center'},
                        {data: 'video' 	 ,  orderable: false      , className: 'dt-center'},
                        {data: 'invitation_status' 	 ,  orderable: false      , className: 'dt-center'},
                        {
                            data: 'status',
                            className: 'dt-center'
                        },

                    ],
                    columnDefs: [
                        {
                            targets: 0,
                            width: '30px',
                            className: 'dt-center',
                            orderable: false,
                            render: function(data, type, full, meta) {

                                return `<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" value="${full.id}" class="group-checkable" name="ids">
                                            <span></span>
                                            </label>
                                        `;
                            },
                        },
                        {

                            targets: -3,
                            width: '100px',
                            className: 'dt-center',
                            orderable: false,
                            render: function(data, type, full, meta) {
                                if(data){
                                    return '<a class="openModal" data-arr="'+data+'"> <i class="fa fa-file-video-o"></i> @lang('influencer::dashboard.events.form.show_video')</a>';
                                }
                                return '<input type="file" class="form-control uploadInvitationVideo" name="video" data-id="'+full.id+'" accept="video/*">';
                            },
                        },
                        {

                            targets: -2,
                            width: '50px',
                            className: 'dt-center',
                            orderable: false,
                            render: function(data, type, full, meta) {
                                return '<label class="switch">'+
                                          '<input type="checkbox" class="updateInvitationStatus" data-area="'+full.id+'" '+(full.ivt_status == 1 ? 'checked' : '')+'>'+
                                          '<span class="slider round"></span>'+
                                        '</label>';
                            },
                        }
                    ],
                    dom: 'Bfrtip',
                    lengthMenu: [
                        [10, 25, 50, 100, 500],
                        ['10', '25', '50', '100', '500']
                    ],
                    buttons: [
                        {
                            extend: "pageLength",
                            className: "btn blue btn-outline",
                            text: "{{ __('apps::dashboard.datatable.pageLength') }}",
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible'
                            }
                        },
                        ...exportButtons ,
                        {
                            extend: "colvis",
                            className: "btn blue btn-outline",
                            text: "{{ __('apps::dashboard.datatable.colvis') }}",
                            exportOptions: {
                                stripHtml: true,
                                columns: ':visible'
                            }
                        }
                    ]
                })

            }

            function generateInfluencerDatatable(type = "all", data={}){

                // instagram
                if(type == "all" || type == "instagram") {
                    // table for influencers
                    dataTableInfluencers["instagram"] =
                        $('#dataTable-instagram').DataTable({
                            "createdRow": function( row, data, dataIndex ) {

                            },
                            ajax : {
                                url   : "{{ url(route('dashboard.instagram.datatable', ['event_invitation_id'=> $model->id])) }}",
                                type  : "GET",
                                data  : {
                                    req : data,
                                },
                            },
                            language: {
                                url:"//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ucfirst(LaravelLocalization::getCurrentLocaleName())}}.json"
                            },
                            stateSave: true,
                            processing: true,
                            serverSide: true,
                            responsive: !0,
                            order     : [[ 1 , "desc" ]],
                            columns: [
                                {data: 'id' 		 	        , className: 'dt-center'},
                                {data: 'id' 		 	        , className: 'dt-center'},
                                { data: "influencer.image" ,orderable: false , width: "1%",
                                    render: function(data, type, row){
                                        return '<img src="'+data+'" width="50px"/>'
                                    }
                                },
                                {data: 'influencer.name'    ,orderable: false       , className: 'dt-center'},
                                {data: 'user_name' 	,orderable: false 		, className: 'dt-center'},
                                {data: 'followers' 	 ,  orderable: true      , className: 'dt-center'},
                                {data: 'engagements'         , className: 'dt-center'},
                                {data: 'quality_score' 	     , className: 'dt-center'},
                                {data: 'posts_count' 	       , className: 'dt-center'},
                                {data: 'audience_credibility' 	    , className: 'dt-center'},
                                {data: 'influencer.address_desc' 	 ,  orderable: false      , className: 'dt-center'},
                                {data: 'influencer.city_id' 	 ,  orderable: false      , className: 'dt-center'},
                                {data: 'influencer.state_id' 	 ,  orderable: false      , className: 'dt-center'},
                                {data: 'influencer.mobile' 		,orderable: false   , className: 'dt-center'},
                                {data: 'id'},
                            ],
                                columnDefs: [
                                {
                                        targets: 0,
                                        width: '30px',
                                        className: 'dt-center',
                                        orderable: false,
                                        render: function(data, type, full, meta) {

                                            return `<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" value="${full.influencer_fk}" class="group-checkable" name="ids">
                                            <span></span>
                                            </label>
                                        `;
                                        },
                                },

                                {
                                targets: -1,
                                width: '13%',
                                title: '{{__('influencer::dashboard.influencers.datatable.options')}}',
                                className: 'dt-center',
                                orderable: false,
                                render: function(data, type, full, meta) {


                                            var showUrl = '{{ route("dashboard.instagram.show", ":id") }}';
                                            showUrl = showUrl.replace(':id', data);

                                            return `
                                            @can('show_instagram')
                                                <a href="`+showUrl+`" class="btn btn-sm yellow" target="_blank" title="Show">
                                                <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan`;
                                },
                                },
                            ],
                            dom: 'Bfrtip',
                            lengthMenu: [
                                [ 10, 25, 50 , 100 , 500 ],
                                [ '10', '25', '50', '100' , '500']
                            ],
                            buttons:[
                                {
                                        extend: "pageLength",
                                        className: "btn blue btn-outline",
                                        text: "{{__('apps::dashboard.datatable.pageLength')}}",
                                        eexportOptions: {
                                            stripHtml : false,
                                            columns: ':visible',
                                            columns: [ 1 , 2 , 3 , 4, 5]
                                        }
                                }
                            ]

                        });
                }

                // youtoub
                if(type == "all" || type == "youtube") {
                    // table for influencers
                    dataTableInfluencers["youtube"] =
                        $('#dataTable-youtube').DataTable({
                            "createdRow": function( row, data, dataIndex ) {

                            },
                            ajax : {
                                url   : "{{ url(route('dashboard.youtube.datatable', ['event_invitation_id'=> $model->id])) }}",
                                type  : "GET",
                                data  : {
                                    req : data,
                                },
                            },
                            language: {
                                url:"//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ucfirst(LaravelLocalization::getCurrentLocaleName())}}.json"
                            },
                            stateSave: true,
                            processing: true,
                            serverSide: true,
                            responsive: !0,
                            order     : [[ 1 , "desc" ]],
                            columns: [
                                {data: 'id' 		 	        , className: 'dt-center'},
                                {data: 'id' 		 	        , className: 'dt-center'},
                                { data: "influencer.image" ,orderable: false , width: "1%",
                                    render: function(data, type, row){
                                        return '<img src="'+data+'" width="50px"/>'
                                    }
                                },
                                {data: 'influencer.name' 	,orderable: false 		, className: 'dt-center'},
                                {data: 'followers' 	 ,  orderable: true      , className: 'dt-center'},
                                {data: 'engagement_rate' 	     , className: 'dt-center'},
                                {data: 'posts_count' 	       , className: 'dt-center'},
                                {data: 'influencer.address_desc' 	 ,  orderable: false      , className: 'dt-center'},
                                {data: 'influencer.city_id' 	 ,  orderable: false      , className: 'dt-center'},
                                {data: 'influencer.state_id' 	 ,  orderable: false      , className: 'dt-center'},
                                {data: 'influencer.mobile' 		,orderable: false   , className: 'dt-center'},
                                {data: 'id'},
                                ],
                                columnDefs: [
                                {
                                        targets: 0,
                                        width: '30px',
                                        className: 'dt-center',
                                        orderable: false,
                                        render: function(data, type, full, meta) {

                                            return `<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" value="${full.influencer_fk}" class="group-checkable" name="ids">
                                            <span></span>
                                            </label>
                                        `;
                                        },
                                },

                                {
                                targets: -1,
                                width: '13%',
                                title: '{{__('influencer::dashboard.influencers.datatable.options')}}',
                                className: 'dt-center',
                                orderable: false,
                                render: function(data, type, full, meta) {


                                            var showUrl = '{{ route("dashboard.instagram.show", ":id") }}';
                                            showUrl = showUrl.replace(':id', data);

                                            return `
                                            @can('show_instagram')
                                                <a href="`+showUrl+`" class="btn btn-sm yellow" target="_blank" title="Show">
                                                <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan`;
                                },
                                },
                            ],
                            dom: 'Bfrtip',
                            lengthMenu: [
                                [ 10, 25, 50 , 100 , 500 ],
                                [ '10', '25', '50', '100' , '500']
                            ],
                            buttons:[
                                {
                                        extend: "pageLength",
                                        className: "btn blue btn-outline",
                                        text: "{{__('apps::dashboard.datatable.pageLength')}}",
                                        eexportOptions: {
                                            stripHtml : false,
                                            columns: ':visible',
                                            columns: [ 1 , 2 , 3 , 4, 5]
                                        }
                                }
                            ]

                        });
                }

                if(type == "all" || type == "tiktok") {
                    // table for influencers
                    dataTableInfluencers["tiktok"] =
                        $('#dataTable-tiktok').DataTable({
                            "createdRow": function( row, data, dataIndex ) {

                            },
                            ajax : {
                                url   : "{{ url(route('dashboard.tiktok.datatable', ['event_invitation_id'=> $model->id])) }}",
                                type  : "GET",
                                data  : {
                                    req : data,
                                },
                            },
                            language: {
                                url:"//cdn.datatables.net/plug-ins/1.10.16/i18n/{{ucfirst(LaravelLocalization::getCurrentLocaleName())}}.json"
                            },
                            stateSave: true,
                            processing: true,
                            serverSide: true,
                            responsive: !0,
                            order     : [[ 1 , "desc" ]],
                            columns: [
                                {data: 'id' 		 	        , className: 'dt-center'},
                                {data: 'id' 		 	        , className: 'dt-center'},
                                { data: "influencer.image" ,orderable: false , width: "1%",
                                    render: function(data, type, row){
                                        return '<img src="'+data+'" width="50px"/>'
                                    }
                                },
                                {data: 'influencer.name' 	,orderable: false 		, className: 'dt-center'},
                                {data: 'followers' 	 ,  orderable: true      , className: 'dt-center'},
                                {data: 'engagement_rate' 	     , className: 'dt-center'},
                                {data: 'posts_count' 	       , className: 'dt-center'},
                                {data: 'influencer.address_desc' 	 ,  orderable: false      , className: 'dt-center'},
                                {data: 'influencer.city_id' 	 ,  orderable: false      , className: 'dt-center'},
                                {data: 'influencer.state_id' 	 ,  orderable: false      , className: 'dt-center'},
                                {data: 'influencer.mobile' 		,orderable: false   , className: 'dt-center'},
                                {data: 'id'},
                                ],
                                columnDefs: [
                                {
                                        targets: 0,
                                        width: '30px',
                                        className: 'dt-center',
                                        orderable: false,
                                        render: function(data, type, full, meta) {

                                            return `<label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" value="${full.influencer_fk}" class="group-checkable" name="ids">
                                            <span></span>
                                            </label>
                                        `;
                                        },
                                },

                                {
                                targets: -1,
                                width: '13%',
                                title: '{{__('influencer::dashboard.influencers.datatable.options')}}',
                                className: 'dt-center',
                                orderable: false,
                                render: function(data, type, full, meta) {


                                            var showUrl = '{{ route("dashboard.instagram.show", ":id") }}';
                                            showUrl = showUrl.replace(':id', data);

                                            return `
                                            @can('show_instagram')
                                                <a href="`+showUrl+`" class="btn btn-sm yellow" target="_blank" title="Show">
                                                <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan`;
                                },
                                },
                            ],
                            dom: 'Bfrtip',
                            lengthMenu: [
                                [ 10, 25, 50 , 100 , 500 ],
                                [ '10', '25', '50', '100' , '500']
                            ],
                            buttons:[
                                {
                                        extend: "pageLength",
                                        className: "btn blue btn-outline",
                                        text: "{{__('apps::dashboard.datatable.pageLength')}}",
                                        eexportOptions: {
                                            stripHtml : false,
                                            columns: ':visible',
                                            columns: [ 1 , 2 , 3 , 4, 5]
                                        }
                                }
                            ]

                        });
                }
            }

            generateDatatable()
            generateInfluencerDatatable()

            // handle button add influencer
            var add_influencer = $(".add_influencer")
            add_influencer.click(function(event){
                event.preventDefault();
                var button = $(this)

                var  ids = []
                $(`${button.data('target')} input:checkbox`).each(function(){
                    var $this = $(this);

                    if($this.is(":checked")){
                        ids.push($this.attr("value"));
                    }
                });
                if(ids.length == 0 ){
                    toastr["error"]("Select 1 at least");
                    return
                }

                $.ajax({
                      type    : "POST",
                      url     : "{{route('dashboard.events.show.add_influencers', $model->id)}}",
                      data    : {
                              ids     : ids,
                          },
                      success: function(msg) {

                          if (msg[0] == true){
                              toastr["success"](msg[1]);
                              reloadInfluencersDatatable()
                              datatableForInvitaions.ajax.reload();
                          }
                          else{
                              toastr["error"](msg[1]);
                          }

                      },
                      error: function( msg ) {
                          toastr["error"](msg[1]);
                          reloadInfluencersDatatable();
                      }
                  });



            })

            var update_status = $(".update_status")
            update_status.click(function(event){
                event.preventDefault();
                var button = $(this)

                var  influencersIds = []
                $(`${button.data('target')} input:checkbox`).each(function(){
                    var $this = $(this);

                    if($this.is(":checked")){
                        influencersIds.push($this.attr("value"));
                    }
                });
                if(influencersIds.length == 0 ){
                    toastr["error"]("Select 1 at least");
                    return "";
                }

                $.ajax({
                    type : "POST",
                    url : "{{route('dashboard.events.show.invitations.update_status')}}",
                    data : {
                        ids : influencersIds,
                        status : $('select[name="invitation_status"] option:selected').val(),
                    },
                    success: function(msg) {
                        if (msg[0] == true){
                            toastr["success"](msg[1]);
                            $("#filterInvatition").click();
                            refreshInvitationStatistics()
                        }
                        else{
                            toastr["error"](msg[1]);
                        }
                    },
                    error: function( msg ) {
                        toastr["error"](msg[1]);
                        $("#filterInvatition").click()
                    }
                });

            });

            $(document).on('change','.updateInvitationStatus',function(){
                let id = $(this).data('area');
                let status = $(this).is(":checked") ? 1 : 0;

                $.ajax({
                    type : "POST",
                    url : "{{route('dashboard.events.show.invitations.update_invitation_status')}}",
                    data : {
                        id : id,
                        status : status,
                    },
                    success: function(msg) {
                        if (msg[0] == true){
                            toastr["success"](msg[1]);
                            $("#filterInvatition").click()
                            refreshInvitationStatistics()
                        }
                        else{
                            toastr["error"](msg[1]);
                        }
                    },
                    error: function( msg ) {
                        toastr["error"](msg[1]);
                        $("#filterInvatition").click()
                    }
                });
            });

            $(document).on('change','.uploadInvitationVideo',function (){
                let id = $(this).data('id');
                var formData = new FormData();

                formData.append('video', $(this)[0].files[0]);
                formData.append('id', id);
                formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    url : '{{route('dashboard.events.show.invitations.upload_video')}}',
                    type : 'POST',
                    data : formData,
                    processData: false,
                    contentType: false,
                    success: function(msg) {
                        if (msg[0] == true){
                            toastr["success"](msg[1]);
                            $("#filterInvatition").click()
                            refreshInvitationStatistics()
                        }
                        else{
                            toastr["error"](msg[1]);
                        }
                    },
                    error: function( msg ) {
                        toastr["error"](msg[1]);
                        $("#filterInvatition").click()
                    }
                });

            })

            $(document).on('click','.openModal',function (){
                let src = $(this).data('arr');
                $('#videoModal video').attr('src',src);
                $('#videoModal').modal('show');
            })

            // reload datatable influencers
            function reloadInfluencersDatatable(){
                for (const property in dataTableInfluencers) {
                    dataTableInfluencers[property].ajax.reload()
                }
            }


            // handle filter
            $("body").on("click", ".filter-influencer", function(event){
                event.preventDefault();
                var button = $(this);
                var type =  button.data('type');
                var $form = $(`#${type}-filter`);
                var data = getFormData($form);
                dataTableInfluencers[type].destroy()
                generateInfluencerDatatable(type, data)

            })

            //reset
            $("body").on("click", ".reset-influencer", function(event){
                event.preventDefault();
                var button = $(this);
                document.getElementById(`${button.data('type')}-filter`).reset();
                $(".select2").val(null).trigger("change");
                dataTableInfluencers[button.data('type')].destroy()
                generateInfluencerDatatable(button.data('type'))
            })


        })
    </script>
@endpush
