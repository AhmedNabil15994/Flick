@extends('apps::dashboard.layouts.app')
@section('title', __('influencer::dashboard.campaigns.routes.show'))
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
                        <a href="#">{{ __('influencer::dashboard.campaigns.routes.show') }} -
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
                                                    {{ __('influencer::dashboard.campaigns.form.tabs.general') }}
                                                </a>
                                            </li>

                                            <li class="{{ request()->tab == 'influencers' ? 'active' : '' }}">
                                                <a href="#influencers" data-toggle="tab">
                                                    {{ __('influencer::dashboard.campaigns.form.tabs.influencers') }}
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
                                                {{ __('influencer::dashboard.campaigns.datatable.cover') }}
                                            </th>
                                            <td>
                                                <img class="img-fluid img-thumbnail" src="{{ url($model->cover) }}"
                                                    width="100" height="50" alt="" srcset="">
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.campaigns.datatable.title') }}
                                            </th>
                                            <td>
                                                {{ $model->title }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.campaigns.datatable.description') }}
                                            </th>
                                            <td>
                                                {!! $model->description !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.campaigns.datatable.company_id') }}
                                            </th>
                                            <td>
                                                {{ optional($model->company)->name }}
                                            </td>
                                        </tr>



                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.campaigns.form.status') }}
                                            </th>
                                            <td>
                                                <span class="badge badge-success">
                                                    {{ $model->status }} </span>
                                            </td>
                                        </tr>

                       

                                        <tr>
                                            <td class="invoice-title uppercase" style="width: 200px">
                                                {{ __('influencer::dashboard.campaigns.datatable.created_at') }}
                                            </td>
                                            <td>

                                                {{ $model->created_at->format('d-m-Y h:i a') }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="invoice-title uppercase" style="width: 200px">
                                                {{ __('influencer::dashboard.campaigns.datatable.is_active') }}
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



                                    </table>


                                </div>
                            </div>


                            {{-- UPDATE FORM --}}
                            <div class="tab-pane  {{ request()->tab == 'influencers' ? 'active' : '' }} fade in"
                                id="influencers">
                                <div class="col-md-10">

                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <th>
                                                <td>#</td>
                                                <td>@lang("user::dashboard.admins.datatable.name")</td>
                                                <td>@lang("user::dashboard.admins.datatable.email")</td>
                                                <td>@lang("influencer::dashboard.campaigns.datatable.type")</td>
    
    
                                            </th>
                                        </thead>
                                        <tbody>
                                            @if($influencers = $model->influencers)
                                            @forelse ($influencers as $item)
                                                <tr>
                                                   <td> {{$item->id}}</td>
                                                   <td> {{$item->name}}</td>
                                                   <td> {{$item->email}}</td>
                                                   <td> {{$item->type}}</td>
                                                </tr>
                                            @empty
                                                
                                            @endforelse
                                            @endif
                                        </tbody>

                                    </table>


                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-actions">

                            <div class="form-group">

                                <a href="{{ url(route('dashboard.campaigns.index')) }}" class="btn btn-lg red">
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
