@extends('apps::dashboard.layouts.app')
@section('title', __('influencer::dashboard.youtube.routes.update'))
@php
    $model->loadMissing(["workers", "influencer"])
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
                        <a href="{{ url(route('dashboard.youtube.index')) }}">
                            {{ __('influencer::dashboard.youtube.routes.index') }}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{ __('influencer::dashboard.youtube.routes.update') }}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">
                {!! Form::model($model, [
                    'url' => route('dashboard.youtube.update', $model->id),
                    'id' => 'updateForm',
                    'role' => 'form',
                    'page' => 'form',
                    'class' => 'form-horizontal form-row-seperated',
                    'method' => 'PUT',
                    'files' => true,
                ]) !!}

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
                                            <li class="active">
                                                <a href="#global_setting" data-toggle="tab">
                                                    {{ __('influencer::dashboard.youtube.form.tabs.general') }}
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="#statistic" data-toggle="tab">
                                                    {{ __('influencer::dashboard.youtube.form.tabs.statistic') }}
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
                            <div class="tab-pane active fade in" id="global_setting">
                                <div class="col-md-10">

                                    @include('influencer::dashboard.youtube.form')

                                </div>
                            </div>

                            {{-- CREATE FORM --}}
                            <div class="tab-pane  fade in" id="statistic">
                                <div class="col-md-10">

                                    @include('influencer::dashboard.youtube.statistic')

                                </div>
                            </div>


                            {{-- PAGE ACTION --}}
                            <div class="col-md-12">
                                <div class="form-actions">
                                    @include('apps::dashboard.layouts._ajax-msg')
                                    <div class="form-group">
                                        <button type="submit" id="submit" class="btn btn-lg green">
                                            {{ __('apps::dashboard.buttons.edit') }}
                                        </button>
                                        <a href="{{ url(route('dashboard.youtube.index')) }}"
                                            class="btn btn-lg red">
                                            {{ __('apps::dashboard.buttons.back') }}
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop
