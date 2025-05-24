@extends('apps::dashboard.layouts.app')
@section('title', __('influencer::dashboard.youtube.routes.show'))
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
    $model->loadMissing(['influencer', 'workers']);
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
                        <a href="#">{{ __('influencer::dashboard.youtube.routes.show') }} -
                            {{ $model->user_name }}</a>
                    </li>
                </ul>
            </div>

            <h1 class="page-title"></h1>

            <div class="row">

                <div class>

                    @include('apps::dashboard.layouts._msg')
                    {{-- RIGHT SIDE --}}
                    {{-- <div class="col-md-3">
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
                                                    {{ __('influencer::dashboard.youtube.form.tabs.general') }}
                                                </a>
                                            </li>

                                            <li class="{{ request()->tab == 'statistic' ? 'active' : '' }}">
                                                <a href="#statistic" data-toggle="tab">
                                                    {{ __('influencer::dashboard.youtube.form.tabs.statistic') }}
                                                </a>
                                            </li>


                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    {{-- PAGE CONTENT --}}
                    <div>
                        <div class="tab-content">

                            {{-- UPDATE FORM --}}
                            <div 
                                id="general">
                                <div class="col-md-12">

                                    <table class="table table-bordered table-striped">


                                        @if ($influencer = $model->influencer)
                                            <tr>
                                                <th>
                                                    {{ __('influencer::dashboard.influencers.datatable.image') }}
                                                </th>
                                                <td>
                                                    <img class="img-fluid img-thumbnail"
                                                        src="{{ url($influencer->image) }}" width="100" height="50"
                                                        alt="" srcset="">
                                                </td>
                                                
                                            </tr>

                                            <tr>
                                                <th>
                                                    {{ __('influencer::dashboard.youtube.form.influencer_id') }}
                                                </th>
                                                <td>
                                                    <a href="{{ route('dashboard.influencers.show', $influencer->id) }}">
                                                        {{ $influencer->name }} </a>
                                                </td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.youtube.datatable.user_name') }}
                                            </th>
                                            <td>
                                                {{ $model->user_name }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.youtube.datatable.account_id') }}
                                            </th>
                                            <td>
                                                {{ $model->account_id }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.youtube.form.workers') }}
                                            </th>
                                            <td>

                                                @if ($workers = $model->workers)
                                                    @foreach ($model->workers as $worker)
                                                        <a href="{{ route('dashboard.workers.show', $worker->id) }}"><span
                                                                class="badge badge-info"> {{ $worker->name }}</span></a>
                                                    @endforeach
                                                @endif

                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="invoice-title uppercase" style="width: 200px">
                                                {{ __('influencer::dashboard.youtube.datatable.created_at') }}
                                            </th>
                                            <td>

                                                {{ $model->created_at->format('d-m-Y h:i a') }}
                                            </td>
                                        </tr>


                                        <tr>
                                            <th class="invoice-title uppercase" style="width: 200px">
                                                {{ __('influencer::dashboard.youtube.datatable.latest_calling_at') }}
                                            </th>
                                            <td>

                                                {{ optional($model->latest_calling_at)->format('d-m-Y h:i a') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="invoice-title uppercase" style="width: 200px">
                                                {{ __('influencer::dashboard.youtube.datatable.status') }}
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

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.youtube.form.is_verified') }}
                                            </th>
                                            <td>

                                                @if ($model->is_verified == 1)
                                                    <span class="badge badge-success">
                                                        {{ __('apps::dashboard.datatable.form.yes') }} </span>
                                                @else
                                                    <span class="badge badge-danger">
                                                        {{ __('apps::dashboard.datatable.form.no') }} </span>
                                                @endif

                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.youtube.form.is_business') }}
                                            </th>
                                            <td>

                                                @if ($model->is_business == 1)
                                                    <span class="badge badge-success">
                                                        {{ __('apps::dashboard.datatable.form.yes') }} </span>
                                                @else
                                                    <span class="badge badge-danger">
                                                        {{ __('apps::dashboard.datatable.form.no') }} </span>
                                                @endif

                                            </td>
                                        </tr>

                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.youtube.form.is_hidden') }}
                                            </th>
                                            <td>

                                                @if ($model->is_hidden == 1)
                                                    <span class="badge badge-success">
                                                        {{ __('apps::dashboard.datatable.form.yes') }} </span>
                                                @else
                                                    <span class="badge badge-danger">
                                                        {{ __('apps::dashboard.datatable.form.no') }} </span>
                                                @endif

                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <th>
                                                {{ __('influencer::dashboard.youtube.form.api_info') }}
                                            </th>
                                            <td>
                                                @if ($model->api_info)
                                                    <div>
                                                        <table class="table">
                                                            @foreach ($model->api_info as $key => $item)
                                                                <tr>
                                                                    <td>
                                                                        {{ $key }}
                                                                    </td>
                                                                    <td>
                                                                        @if (in_array($key, ['profile_updated', 'created']))
                                                                            {{ \Carbon\Carbon::parse($item)->format('d-m-Y h:i a') }}
                                                                        @else
                                                                            {{ $item }}
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>
                                                    </div>
                                                @endif
                                                <hr/>
                                                <div>
                                                    <form method="POST"
                                                        action="{{ route('dashboard.youtube.show.update_stat', $model->id) }}">
                                                        @csrf
                                                        <select name="type" class="">
                                                            <option value="api">API</option>
                                                            <option value="file" selected>FILE</option>
                                                        </select>
                                                        <button type="submit" class="btn btn-info">
                                                            {{ __('apps::dashboard.buttons.update') }}</button>
                                                    </form>
                                                </div>



                                            </td>
                                        </tr>



                                    </table>


                                </div>
                            </div>


                            {{-- UPDATE FORM --}}
                            <div 
                                id="statistic">
                                <div class="col-md-12">

            

                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">

                                            <div class="visual">
                                                <i class="fa fa-heart  "></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup"
                                                        data-value="{{ $model->avg_likes ?? 0 }}">0</span>
                                                </div>
                                                <div class="desc">
                                                    {{ __('influencer::dashboard.youtube.form.avg_likes') }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">

                                            <div class="visual">
                                                <i class="fa fa-comment  "></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup"
                                                        data-value="{{ $model->avg_comments ?? 0 }}">0</span>
                                                </div>
                                                <div class="desc">
                                                    {{ __('influencer::dashboard.youtube.form.avg_comments') }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>


                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat dashboard-stat-v2 yellow-casablanca" href="#">

                                            <div class="visual">
                                                <i class="fa fa-book  "></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup"
                                                        data-value="{{ $model->posts_count ?? 0 }}">0</span>
                                                </div>
                                                <div class="desc">
                                                    {{ __('influencer::dashboard.youtube.form.posts_count') }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>


                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat dashboard-stat-v2 red-flamingo" href="#">

                                            <div class="visual">
                                                <i class="fa fa-mars-stroke  "></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup"
                                                        data-value="{{ $model->engagements ?? 0 }}">0</span>
                                                </div>
                                                <div class="desc">
                                                    {{ __('influencer::dashboard.youtube.form.engagements') }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat dashboard-stat-v2 red-haze" href="#">

                                            <div class="visual">
                                                <i class="fa fa-adn  "></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup"
                                                        data-value="{{ $model->engagement_rate ?? 0 }}">0</span>
                                                </div>
                                                <div class="desc">
                                                    {{ __('influencer::dashboard.youtube.form.engagement_rate') }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat dashboard-stat-v2 green-haze" href="#">

                                            <div class="visual">
                                                <i class="fa fa-users  "></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup"
                                                        data-value="{{ $model->followers ?? 0 }}">0</span>
                                                </div>
                                                <div class="desc">
                                                    {{ __('influencer::dashboard.youtube.form.followers') }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat dashboard-stat-v2 green-meadow" href="#">

                                            <div class="visual">
                                                <i class="fa fa-eye  "></i>
                                            </div>
                                            <div class="details">
                                                <div class="number">
                                                    <span data-counter="counterup"
                                                        data-value="{{ $model->followers ?? 0 }}">0</span>
                                                </div>
                                                <div class="desc">
                                                    {{ __('influencer::dashboard.youtube.form.avg_views') }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
  


                                </div>
                                <hr />

                                {{-- table statistic --}}
                             
                                {{-- chart --}}
                                <div class="col-md-12">

                                    <div class="col-md-4 col-lg-4">
                                        <b class="page-title">
                                            {{ __('influencer::dashboard.youtube.form.audience_genders') }}
                                        </b>
                                        <canvas id="audience_genders" height="300" class="mb-3"></canvas>
                                    </div>

                                    <div class="col-md-4 col-lg-4">
                                        <b class="page-title">
                                            {{ __('influencer::dashboard.youtube.form.audience_ages') }}
                                        </b>
                                        <canvas id="audience_ages" height="300" class="mb-3"></canvas>
                                    </div>


                                    <div class="col-md-4 col-lg-4">
                                        <b class="page-title">
                                            {{ __('influencer::dashboard.youtube.form.audience_genders_per_age') }}
                                        </b>
                                        <canvas id="audience_genders_per_age" height="300" class="mb-3"></canvas>
                                    </div>

                                    <div class="col-md-4">
                                        <b class="page-title">
                                            {{ __('influencer::dashboard.youtube.form.stat_history') }}
                                        </b>
                                        <canvas id="stat_history" height="300" class="mb-3"></canvas>
                                    </div>

                                    <div class="col-md-4">
                                        <b class="page-title">
                                            {{ __('influencer::dashboard.youtube.form.audience_genders_commenter') }}
                                        </b>
                                        <canvas id="audience_genders_commenter" height="300" class="mb-3"></canvas>
                                    </div>

                                    <div class="col-md-4">
                                        <b class="page-title">
                                            {{ __('influencer::dashboard.youtube.form.audience_genders_per_age_commenter') }}
                                        </b>
                                        <canvas id="audience_genders_per_age_commenter" height="300" class="mb-3"></canvas>
                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-actions">

                            <div class="form-group">

                                <a href="{{ url(route('dashboard.youtube.index')) }}" class="btn btn-lg red">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

    <script>
        $(function() {

            //audience gender
            var auidenceGenderData = {
                datasets: [{
                    data: @json(Arr::pluck($model->audience_genders ?? [], 'weight')),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ]
                }],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: @json(Arr::pluck($model->audience_genders ?? [], 'code'))
            }
            new Chart(document.getElementById("audience_genders"), {
                type: 'doughnut',
                data: auidenceGenderData,
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });

            // audience age 
            var audienceAgesDataArray = @json(Arr::pluck($model->audience_ages ?? [], 'weight'));

            var audienceAgesData = {
                datasets: [{
                    data: audienceAgesDataArray,
                    backgroundColor: generateColorArray(audienceAgesDataArray.length)
                }],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: @json(Arr::pluck($model->audience_ages ?? [], 'code'))
            }
            new Chart(document.getElementById("audience_ages"), {
                type: 'pie',
                data: audienceAgesData,
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });

            // audience age per age 
            var audienceAgesDataAgeArray = @json(Arr::pluck($model->audience_genders_per_age ?? [], 'code'));

            var audienceAgesData = {
                datasets: [{
                        label: "Male",
                        data: @json(Arr::pluck($model->audience_genders_per_age ?? [], 'male')),
                        backgroundColor: generateRandomColor()

                    },
                    {
                        label: "Female",
                        data: @json(Arr::pluck($model->audience_genders_per_age ?? [], 'female')),
                        backgroundColor: generateRandomColor()
                    }
                ],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: audienceAgesDataAgeArray
            }
            new Chart(document.getElementById("audience_genders_per_age"), {
                type: 'bar',
                data: audienceAgesData,
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });


            // stat_history
            var statHistoryDataLabel = @json(Arr::pluck($model->stat_history ?? [], 'month'));

            var statHistoryData = {
                datasets: [{
                        label: "Avg Like",
                        data: @json(Arr::pluck($model->stat_history ?? [], 'avg_likes')),
                        backgroundColor: generateRandomColor()

                    },
                    {
                        label: "Followers",
                        data: @json(Arr::pluck($model->stat_history ?? [], 'followers')),
                        backgroundColor: generateRandomColor()
                    },
                    {
                        label: "Avg Views",
                        data: @json(Arr::pluck($model->stat_history ?? [], 'avg_views')),
                        backgroundColor: generateRandomColor()
                    },
                    // {
                    //     label: "Total Views",
                    //     data: @json(Arr::pluck($model->stat_history ?? [], 'total_views')),
                    //     backgroundColor: generateRandomColor()
                    // },
                    {
                        label: "Avg Comments",
                        data: @json(Arr::pluck($model->stat_history ?? [], 'avg_comments')),
                        backgroundColor: generateRandomColor()
                    },
                    {
                        label: "Avg Dislike",
                        data: @json(Arr::pluck($model->stat_history ?? [], 'avg_dislikes')),
                        backgroundColor: generateRandomColor()
                    }
                ],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: statHistoryDataLabel
            }
            new Chart(document.getElementById("stat_history"), {
                type: 'bar',
                data: statHistoryData,
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });



            //audience gender commeter
            var auidenceGenderDataCommenter = {
                datasets: [{
                    data: @json(Arr::pluck($model->audience_genders_commenter ?? [], 'weight')),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ]
                }],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: @json(Arr::pluck($model->audience_genders_commenter ?? [], 'code'))
            }
            new Chart(document.getElementById("audience_genders_commenter"), {
                type: 'doughnut',
                data: auidenceGenderDataCommenter,
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });

            // audience age per age 
            var audienceAgesDataAgeCommenterArray = @json(Arr::pluck($model->audience_genders_per_age_commenter ?? [], 'code'));

            var audienceAgesDataCommenter = {
                datasets: [{
                        label: "Male",
                        data: @json(Arr::pluck($model->audience_genders_per_age_commenter ?? [], 'male')),
                        backgroundColor: generateRandomColor()

                    },
                    {
                        label: "Female",
                        data: @json(Arr::pluck($model->audience_genders_per_age_commenter ?? [], 'female')),
                        backgroundColor: generateRandomColor()
                    }
                ],

                // These labels appear in the legend and in the tooltips when hovering different arcs
                labels: audienceAgesDataAgeCommenterArray
            }
            new Chart(document.getElementById("audience_genders_per_age_commenter"), {
                type: 'bar',
                data: audienceAgesDataCommenter,
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });

        });
    </script>
@endpush
