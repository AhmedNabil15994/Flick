@extends('apps::dashboard.layouts.app')
@section('title', __('influencer::dashboard.twitch.routes.show'))
@section('css')
    <style>
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
@php
    $model->loadMissing(["influencer", "workers"])
@endphp
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
                        <a href="{{ url(route('dashboard.twitch.index')) }}">
                            {{ __('influencer::dashboard.twitch.routes.index') }}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{ __('influencer::dashboard.twitch.routes.show') }} -
                            {{ $model->name }}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">

                <div class="col-md-12">

                    {{-- RIGHT SIDE --}}
                    <div class="col-md-3">
                        <div class="panel-group accordion scrollable" id="accordion2">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="accordion-toggle"></a></h4>
                                </div>
                                <div id="collapse_2_1" class="panel-collapse in">
                                    <div class="panel-body">
                                        <ul class="nav nav-pills nav-stacked">


                                            <li
                                                class="{{ request()->tab == 'general' || !request()->tab ? 'active' : '' }}">
                                                <a href="#general" data-toggle="tab">
                                                    {{ __('influencer::dashboard.twitch.form.tabs.general') }}
                                                </a>
                                            </li>

                                            <li class="{{ request()->tab == 'statistic' ? 'active' : '' }}">
                                                <a href="#statistic" data-toggle="tab">
                                                    {{ __('influencer::dashboard.twitch.form.tabs.statistic') }}
                                                </a>
                                            </li>


                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- PAGE CONTENT --}}
                    <div class="col-md-9">
                        <div class="tab-content">

                            {{-- UPDATE FORM --}}
                            <div class="tab-pane  {{ request()->tab == 'general' || !request()->tab ? 'active' : '' }} fade in"
                                id="general">
                                <div class="col-md-10">

                                    <table class="table table-bordered table-striped">
                                        

                                        @if($influencer = $model->influencer)
                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.influencers.datatable.image') }}
                                            </th>
                                            <td>
                                                <img class="img-fluid img-thumbnail" src="{{ url($influencer->image) }}"
                                                    width="100" height="50" alt="" srcset="">
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.twitch.form.influencer_id') }}
                                            </th>
                                            <td>
                                                <a href="{{route('dashboard.influencers.show', $influencer->id)}}"> {{$influencer->name}} </a>
                                            </td>
                                        </tr>

                                        @endif

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.twitch.datatable.user_name') }}
                                            </th>
                                            <td>
                                                {{ $model->user_name }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.twitch.datatable.account_id') }}
                                            </th>
                                            <td>
                                                {{ $model->accoubt_id }}
                                            </td>
                                        </tr>



                                       

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.twitch.form.workers') }}
                                            </th>
                                            <td>

                                                @if ($workers = $model->workers)
                                                    @foreach ($model->workers as $worker)
                                                        <a href="{{route('dashboard.workers.show', $worker->id)}}"><span class="badge badge-info"> {{ $worker->name }}</span></a>
                                                    @endforeach
                                                @endif

                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="invoice-title uppercase" style="width: 200px">
                                                {{ __('influencer::dashboard.twitch.datatable.created_at') }}
                                            </th>
                                            <td>

                                                {{ $model->created_at->format('d-m-Y h:i a') }}
                                            </td>
                                        </tr>


                                        <tr>
                                            <th class="invoice-title uppercase" style="width: 200px">
                                                {{ __('influencer::dashboard.twitch.datatable.latest_calling_at') }}
                                            </th>
                                            <td>

                                                {{ optional($model->latest_calling_at)->format('d-m-Y h:i a') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="invoice-title uppercase" style="width: 200px">
                                                {{ __('influencer::dashboard.twitch.datatable.status') }}
                                            </th>
                                            <td>

                                                @if ($model->status == 1)
                                                    <span class="badge badge-success">
                                                        {{ __('apps::dashboard.datatable.active') }} </span>
                                                @else
                                                    <span class="badge badge-danger">
                                                        {{ __('apps::dashboard.datatable.unactive') }} </span>
                                                @endif

                                            </td>
                                        </tr>



                                    </table>


                                </div>
                            </div>


                            {{-- UPDATE FORM --}}
                            <div class="tab-pane  {{ request()->tab == 'statistic' ? 'active' : '' }} fade in"
                                id="statistic">
                                <div class="col-md-10">

                                    <table class="table table-bordered table-striped">


                                    </table>


                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-actions">

                            <div class="form-group">

                                <a href="{{ url(route('dashboard.twitch.index')) }}" class="btn btn-lg red">
                                    {{ __('apps::dashboard.buttons.back') }}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>



@stop


@push('start_scripts')
@endpush
