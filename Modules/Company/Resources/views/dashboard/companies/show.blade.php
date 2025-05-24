@extends('apps::dashboard.layouts.app')
@section('title', __('company::dashboard.companies.routes.show'))
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

@inject('subscriptionModel', \Modules\Package\Entities\Subscription::class)
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
                        <a href="{{ url(route('dashboard.companies.index')) }}">
                            {{ __('company::dashboard.companies.routes.index') }}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{ __('company::dashboard.companies.routes.show') }} -
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
                                                    {{ __('company::dashboard.companies.form.tabs.general') }}
                                                </a>
                                            </li>

                                            <li class="{{ request()->tab == 'subscriptions' ? 'active' : '' }}">
                                                <a href="#subscriptions" data-toggle="tab">
                                                    {{ __('company::dashboard.companies.form.tabs.subscriptions') }}
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
                                <div class="col-md-12">

                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <th>
                                                {{ __('company::dashboard.companies.datatable.logo') }}
                                            </th>
                                            <td>
                                                <img class="img-fluid img-thumbnail" src="{{ url($model->logo) }}"
                                                    width="100" height="50" alt="" srcset="">
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>
                                                {{ __('company::dashboard.companies.datatable.name') }}
                                            </th>
                                            <td>
                                                {{ $model->name }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('company::dashboard.companies.datatable.description') }}
                                            </th>
                                            <td>
                                                {{ $model->description }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('company::dashboard.companies.datatable.manager_id') }}
                                            </th>
                                            <td>
                                                {{ optional($model->manager)->name }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('company::dashboard.companies.form.mobile') }}
                                            </th>
                                            <td>
                                                {{ $model->mobile }}
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>
                                                {{ __('company::dashboard.companies.form.email') }}
                                            </th>
                                            <td>
                                                {!! $model->email !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('company::dashboard.companies.form.tags') }}
                                            </th>
                                            <td>

                                                @if ($tags = $model->tags)
                                                    @foreach ($model->tags as $tag)
                                                        <span class="badge badge-info"> {{ $tag->title }}</span>
                                                    @endforeach
                                                @endif

                                            </td>
                                        </tr>



                                        <tr>
                                            <th>
                                                {{ __('company::dashboard.companies.form.workers') }}
                                            </th>
                                            <td>
                                                @if ($workers = $model->workers)
                                                    @foreach ($workers as $key => $worker)
                                                        <a class="btn btn-info btn-link" target="_blank"
                                                            href="{{ route('dashboard.companies.show', $worker->id) }}">
                                                            <span class="badge badge-info">{{ $worker->name }} </span>
                                                        </a>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>


                                        <tr>
                                            <td class="invoice-title uppercase" style="width: 200px">
                                                {{ __('company::dashboard.companies.datatable.created_at') }}
                                            </td>
                                            <td>

                                                {{ $model->created_at->format('d-m-Y h:i a') }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="invoice-title uppercase" style="width: 200px">
                                                {{ __('company::dashboard.companies.datatable.status') }}
                                            </td>
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
                            <div class="tab-pane  {{ request()->tab == 'subscriptions' ? 'active' : '' }} fade in"
                                id="subscriptions">
                                <div class="col-md-12">

                                    <div class="">
                                        <h3>@lang('company::dashboard.companies.show.subscriptions.current')</h3>

                                        @if ($currentSubscription = $model->currentSubscription)
                                            <div>
                                                {!! Form::model($currentSubscription, [
                                                    'url' => route('dashboard.companies.edit.subscription', [
                                                        'id' => $model->id,
                                                        'subscription_id' => $currentSubscription->id,
                                                    ]),
                                                    'role' => 'form',
                                                    'page' => 'form',
                                                    'method' => 'PUT',
                                                    'class' => 'form-horizontal form-row-seperated update-form',
                                                    'files' => true,
                                                    'autocomplete' => 'off',
                                                ]) !!}

                                                @include('company::dashboard.companies.form_subscription', [
                                                    'model' => $currentSubscription,
                                                    'is_update' => true,
                                                ])

                                                <div class="form-actions">
                                                    @include('apps::dashboard.layouts._ajax-msg')
                                                    <div class="form-group">
                                                        <button type="submit" id="submit" class="btn btn-lg green">
                                                            {{ __('apps::dashboard.buttons.edit') }}
                                                        </button>

                                                        <button type="button" class="btn btn-lg btn-primary"
                                                            data-toggle="modal" data-target="#add_subscriptions">
                                                            @lang('company::dashboard.companies.show.subscriptions.add')
                                                        </button>
                                                    </div>
                                                </div>

                                                {!! Form::close() !!}


                                            </div>
                                        @else
                                            <div>
                                                <button type="button" class="btn btn-lg btn-primary" data-toggle="modal"
                                                    data-target="#add_subscriptions">
                                                    @lang('company::dashboard.companies.show.subscriptions.add')
                                                </button>
                                            </div>
                                        @endif


                                        <hr>
                                        <div class="table-responsive">

                                            <table
                                                class="table dataTable table-striped table-bordered table-hover table-responsive"
                                                id="table-subscription" style="width: 100%">

                                                <thead>
                                                    <th>{{ __('company::dashboard.companies.show.subscriptions.package_id') }}
                                                    </th>
                                                    <th>{{ __('company::dashboard.companies.show.subscriptions.start_at') }}
                                                    </th>
                                                    <th>{{ __('company::dashboard.companies.show.subscriptions.end_at') }}
                                                    </th>
                                                    <th>{{ __('company::dashboard.companies.show.subscriptions.from_admin') }}
                                                    </th>
                                                    <th>{{ __('company::dashboard.companies.show.subscriptions.price') }}
                                                    </th>
                                                    <th>{{ __('company::dashboard.companies.show.subscriptions.number_of_influencers') }}</th>
                                                    <th>{{ __('company::dashboard.companies.show.subscriptions.using_count') }}</th>
                                                    <th>{{ __('company::dashboard.companies.show.subscriptions.comment') }}</th>

                                                    <th>{{ __('company::dashboard.companies.datatable.created_at') }}</th>
                                                </thead>
                                                <tbody>


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-actions">

                            <div class="form-group">

                                <a href="{{ url(route('dashboard.companies.index')) }}" class="btn btn-lg red">
                                    {{ __('apps::dashboard.buttons.back') }}
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    {{-- model for add subscriptions --}}
    <!-- Modal -->
    <div class="modal fade" id="add_subscriptions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">@lang('company::dashboard.companies.show.subscriptions.add')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::model($subscriptionModel, [
                    'url' => route('dashboard.companies.store.subscription', $model->id),
                    'role' => 'form',
                    'method' => 'POST',
                    'class' => 'form-horizontal form-row-seperated create-form',
                    'files' => true,
                    'autocomplete' => 'off',
                ]) !!}
                <div class="modal-body">
                    @include('company::dashboard.companies.form_subscription', [
                        'model' => $subscriptionModel,
                    ])
                </div>
                <div class="modal-footer">
                    @include('apps::dashboard.layouts._ajax-msg')
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('apps::dashboard.buttons.close')</button>
                    <button type="submit" id="submit" class="btn btn-primary">@lang('apps::dashboard.buttons.save')</button>
                </div>
                {!! Form::close() !!}


            </div>
        </div>
    </div>


@stop


@push('start_scripts')
    <script>
        $(function() {
            $('#table-subscription').DataTable({
                ajax: {
                    url: "{{ url(route('dashboard.companies.datatable.subscriptions', $model->id)) }}",
                    type: "GET",
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
                    [5, "desc"]
                ],
                columns: [{
                        data: 'package_id',
                        className: 'dt-center'
                    },
                    {
                        data: 'start_at',
                        className: 'dt-center'
                    },
                    {
                        data: 'end_at',
                        className: 'dt-center'
                    },
                    {
                        data: "from_admin",
                        orderable: true,
                        render: function(data, type, row) {
                            if (data)
                                return '<div class="text-center"><i class="fa fa-check"></i></div>'
                            else return '<div class="text-center"> <i class="fa fa-close"></i> </div>'

                        }
                    },
                    {
                        data: 'price',
                        className: 'dt-center'
                    },
                    {
                        data: 'number_of_influencers',
                        className: 'dt-center'
                    },
                    {
                        data: 'using_count',
                        className: 'dt-center'
                    },
                    {
                        data: 'comment',
                        className: 'dt-center'
                    },

                    {
                        data: 'created_at',
                        className: 'dt-center'
                    },

                ],
                dom: 'Bfrtip',
                lengthMenu: [
                    [10, 25, 50, 100, 500],
                    ['10', '25', '50', '100', '500']
                ],
                buttons: [{
                        extend: "pageLength",
                        className: "btn blue btn-outline",
                        text: "{{ __('apps::dashboard.datatable.pageLength') }}",
                        exportOptions: {
                            stripHtml: true,
                            columns: ':visible'
                        }
                    },
                    {
                        extend: "print",
                        className: "btn blue btn-outline",
                        text: "{{ __('apps::dashboard.datatable.print') }}",
                        title: '{{ __('company::dashboard.companies.show.tabs.subscriptions') . ' ' . $model->name . '#' . $model->id }}',
                        exportOptions: {
                            stripHtml: true,
                            columns: ':visible',
                            columns: [0, 1, 2, 4, 5]
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
                            columns: [0, 1, 2, 4, 5]
                        }
                    },
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
        })
    </script>
@endpush
