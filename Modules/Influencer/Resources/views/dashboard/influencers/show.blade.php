@extends('apps::dashboard.layouts.app')
@section('title', __('influencer::dashboard.influencers.routes.show'))
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
                        <a href="{{ url(route('dashboard.influencers.index')) }}">
                            {{ __('influencer::dashboard.influencers.routes.index') }}
                        </a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="#">{{ __('influencer::dashboard.influencers.routes.show') }} -
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
                                                    {{ __('influencer::dashboard.influencers.form.tabs.general') }}
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
                                                {{ __('influencer::dashboard.influencers.datatable.image') }}
                                            </th>
                                            <td>
                                                <img class="img-fluid img-thumbnail" src="{{ url($model->image) }}"
                                                    width="100" height="50" alt="" srcset="">
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.influencers.datatable.name') }}
                                            </th>
                                            <td>
                                                {{ $model->name }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.influencers.datatable.bio') }}
                                            </th>
                                            <td>
                                                {{ $model->bio }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.influencers.datatable.country_id') }}
                                            </th>
                                            <td>
                                                {{ optional($model->country)->title }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.influencers.form.age') }}
                                            </th>
                                            <td>
                                                {{ $model->age }}
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.influencers.form.birth_date') }}
                                            </th>
                                            <td>
                                                {{ $model->birth_date }}
                                            </td>
                                        </tr>



                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.influencers.form.website_url') }}
                                            </th>
                                            <td>
                                                <a target="_blank" href="{{ $model->website_url }}"><i
                                                        class="fa fa-eye"></i></a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.influencers.form.email') }}
                                            </th>
                                            <td>
                                                {!! $model->email !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.influencers.form.address_desc') }}
                                            </th>
                                            <td>
                                                {!! $model->address_desc !!}
                                            </td>
                                        </tr>


                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.influencers.form.mobile') }}
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
                                            <th>
                                                {{ __('influencer::dashboard.influencers.form.contacts') }}
                                            </th>
                                            <td>

                                                @if ($model->contacts)
                                                <ul class="list-group">
                                                    @foreach ($model->contacts as $contact)
                                                      <li class="list-group-item"> <i class="fa fa-phone"></i> {{ $contact }}</li>
                                                    @endforeach
                                                </ul>
                                                @else
                                                    -----
                                                @endif

                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.influencers.form.tags') }}
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
                                                {{ __('influencer::dashboard.influencers.form.socials') }}
                                            </th>
                                            <td>
                                                @if ($model->socials)
                                                    @foreach ($model->socials as $key => $social)
                                                        <a class="btn btn-info btn-link" target="_blank"
                                                            href="{{ $social }}">{{ $key }}</a>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>


                                        <tr>
                                            <td class="invoice-title uppercase" style="width: 200px">
                                                {{ __('influencer::dashboard.influencers.datatable.created_at') }}
                                            </td>
                                            <td>

                                                {{ $model->created_at->format('d-m-Y h:i a') }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="invoice-title uppercase" style="width: 200px">
                                                {{ __('influencer::dashboard.influencers.datatable.status') }}
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

                                <a href="{{ url(route('dashboard.influencers.index')) }}" class="btn btn-lg red">
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
