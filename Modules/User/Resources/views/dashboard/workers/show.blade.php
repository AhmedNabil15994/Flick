@extends('apps::dashboard.layouts.app')
@section('title', __('user::dashboard.workers.show.title'))
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
    $model->loadMissing("roles")
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
                        <a href="{{ url(route('dashboard.workers.index')) }}">
                            {{ __('user::dashboard.workers.index.title') }}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{ __('user::dashboard.workers.show.title') }} - {{ $model->name }}</a>
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
                                                    {{ __('user::dashboard.workers.show.tabs.general') }}
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
                                        <tr>
                                            <th>
                                                {{ __('user::dashboard.workers.datatable.image') }}
                                            </th>
                                            <td>
                                                <img class="img-fluid img-thumbnail" src="{{ url($model->image) }}"
                                                    width="100" height="50" alt="" srcset="">
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>
                                                {{ __('user::dashboard.workers.datatable.name') }}
                                            </th>
                                            <td>
                                                {{ $model->name }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('user::dashboard.workers.form.email') }}
                                            </th>
                                            <td>
                                                {!! $model->email !!}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                {{ __('user::dashboard.workers.form.mobile') }}
                                            </th>
                                            <td>

                                                @if (locale() != 'ar')
                                                    {{ '+' . $model->phone_code . $model->mobile }}
                                                @else
                                                    {{ $model->phone_code . $model->mobile . '+' }}
                                                @endif

                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="invoice-title uppercase" style="width: 200px">
                                                {{ __('user::dashboard.workers.form.roles') }}
                                            </td>
                                            <td>
                                                @if($model->roles)
                                                    @foreach ($model->roles as $role)
                                                        <span class="badge badge-info">{{$role->dispaly_name}}</span>
                                                    @endforeach
                                                @else
                                                    -----------
                                                @endif

                                            </td>
                                        </tr>


                                        <tr>
                                            <td class="invoice-title uppercase" style="width: 200px">
                                                {{ __('user::dashboard.workers.datatable.created_at') }}
                                            </td>
                                            <td>

                                                {{ $model->created_at->format('d-m-Y h:i a') }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="invoice-title uppercase" style="width: 200px">
                                                {{ __('user::dashboard.workers.datatable.status') }}
                                            </td>
                                            <td>

                                                @if ($model->is_active == 1)
                                                    <span class="badge badge-success">
                                                        {{ __('apps::dashboard.datatable.active') }} </span>
                                                @else
                                                    <span class="badge badge-danger">
                                                        {{ __('apps::dashboard.datatable.unactive') }} </span>
                                                @endif

                                            </td>
                                        </tr>


                                        <tr>
                                            <th>
                                                {{ __('user::dashboard.workers.datatable.admin_approved') }}
                                            </th>
                                            <td>
                                                @if ($model->is_active == 1)
                                                    <span class="badge badge-success">
                                                        {{ __('apps::dashboard.datatable.form.yes') }} </span>
                                                @else
                                                    <span class="badge badge-danger">
                                                        {{ __('apps::dashboard.datatable.form.no') }} </span>
                                                @endif

                                            </td>
                                        </tr>


                                    </table>


                                </div>
                            </div>

                    



                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-actions">

                            <div class="form-group">

                                <a href="{{ url(route('dashboard.workers.index')) }}" class="btn btn-lg red">
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
