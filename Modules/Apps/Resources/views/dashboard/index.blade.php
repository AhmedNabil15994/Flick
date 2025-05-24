@extends('apps::dashboard.layouts.app')
@section('title', __('apps::dashboard.index.title'))
@section('content')

    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ url(route('dashboard.home')) }}">
                            {{ __('apps::dashboard.index.title') }}
                        </a>
                    </li>
                </ul>
            </div>
            <h1 class="page-title"> {{ __('apps::dashboard.index.welcome') }} ,
                <small><b style="color:red">{{ Auth::user()->name }} </b></small>
            </h1>

            {{-- @can('show_statistics') --}}
                {{-- DATATABLE FILTER --}}
                {{-- <div class="portlet light bordered">
                    <div class="portlet-title tabbable-line">
                        <div class="caption">
                            <i class="icon-bubbles font-dark hide"></i>
                            <span class="caption-subject font-dark bold uppercase">
                                {{ __('apps::dashboard.datatable.form.date_range') }}
                            </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="filter_data_table">
                            <div class="panel-body">
                                <form class="horizontal-form">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <div id="reportrange" class="btn default form-control">
                                                        <i class="fa fa-calendar"></i> &nbsp;
                                                        <span> </span>
                                                        <b class="fa fa-angle-down"></b>
                                                        <input type="hidden" name="from">
                                                        <input type="hidden" name="to">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions col-md-3">

                                                <button class="btn btn-sm green btn-outline filter-submit margin-bottom"
                                                    type="submit">
                                                    <i class="fa fa-search"></i>
                                                    {{ __('apps::dashboard.datatable.search') }}
                                                </button>
                                                <a class="btn btn-sm red btn-outline filter-cancel"
                                                    href="{{ url(route('dashboard.home')) }}">
                                                    <i class="fa fa-times"></i>
                                                    {{ __('apps::dashboard.datatable.reset') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
                {{--  --}}{{-- END DATATABLE FILTER --}}

                <div class="row">
                    <div class="portlet light bordered col-lg-12">




                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 10px">
                            <a class="dashboard-stat dashboard-stat-v2 red"
                                href="{{ url(route('dashboard.influencers.index')) }}">

                                <div class="visual">
                                    <i class="fa fa-users  "></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{ $numberOfInfluencerInMonth }}">0</span>
                                    </div>
                                    <div class="desc">{{ __('apps::dashboard.index.statistics.influencer_in_month') }}</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 10px">
                            <a class="dashboard-stat dashboard-stat-v2 red-flamingo"
                                href="{{ url(route('dashboard.influencers.index')) }}">

                                <div class="visual">
                                    <i class="fa fa-users  "></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{ $countOfInfluencers }}">0</span>
                                    </div>
                                    <div class="desc">{{ __('apps::dashboard.index.statistics.influencer_count') }}</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 10px">
                            <a class="dashboard-stat dashboard-stat-v2 blue"
                                href="{{ url(route('dashboard.companies.index')) }}">

                                <div class="visual">
                                    <i class="fa fa-users  "></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{ $numberOfCompanyInMonth }}">0</span>
                                    </div>
                                    <div class="desc">{{ __('apps::dashboard.index.statistics.company_in_month') }}</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 10px">
                            <a class="dashboard-stat dashboard-stat-v2 blue-ebonyclay"
                                href="{{ url(route('dashboard.companies.index')) }}">

                                <div class="visual">
                                    <i class="fa fa-users  "></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{ $countOfCompanies }}">0</span>
                                    </div>
                                    <div class="desc">{{ __('apps::dashboard.index.statistics.company_count') }}</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 10px">
                            <a class="dashboard-stat dashboard-stat-v2 yellow"
                                href="{{ url(route('dashboard.campaigns.index')) }}">

                                <div class="visual">
                                    <i class="fa fa-users  "></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{ $numberOfCampaignInMonth }}">0</span>
                                    </div>
                                    <div class="desc">{{ __('apps::dashboard.index.statistics.campaign_in_month') }}</div>
                                </div>
                            </a>
                        </div>


                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 10px">
                            <a class="dashboard-stat dashboard-stat-v2 yellow-gold"
                                href="{{ url(route('dashboard.campaigns.index')) }}">

                                <div class="visual">
                                    <i class="fa fa-users  "></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{ $countOfCampaigns }}">0</span>
                                    </div>
                                    <div class="desc">{{ __('apps::dashboard.index.statistics.campaign_count') }}</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 10px">
                            <a class="dashboard-stat dashboard-stat-v2 green-haze" href="#">

                                <div class="visual">
                                    <i class="fa fa-users  "></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{ $numberOfSubscriptionInMonth }}">0</span>
                                    </div>
                                    <div class="desc">{{ __('apps::dashboard.index.statistics.subscriptions_in_month') }}
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin-bottom: 10px">
                            <a class="dashboard-stat dashboard-stat-v2 green" href="#">

                                <div class="visual">
                                    <i class="fa fa-users  "></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <span data-counter="counterup" data-value="{{ $numberOfSubscriptionInYear }}">0</span>
                                    </div>
                                    <div class="desc">{{ __('apps::dashboard.index.statistics.subscriptions_in_year') }}
                                    </div>
                                </div>
                            </a>
                        </div>




                    </div>



                </div>

                <hr />
                <div class="row">

                    <div class="col-md-6">
                        <b class="page-title">
                            {{ __('apps::dashboard.index.statistics.monthlyInfluencers') }}
                        </b>
                        <canvas id="monthlyInfluencers" width="540" height="270"></canvas>
                    </div>

                    <div class="col-md-6">
                        <b class="page-title">
                            {{ __('apps::dashboard.index.statistics.monthlyCompanies') }}
                        </b>
                        <canvas id="monthlyCompanies" width="540" height="270"></canvas>
                    </div>

                    <div class="col-md-6">
                        <b class="page-title">
                            {{ __('apps::dashboard.index.statistics.monthlyCampaigns') }}
                        </b>
                        <canvas id="monthlyCampaigns" width="540" height="270"></canvas>
                    </div>
 
                    <div class="col-md-6">
                        <b class="page-title">
                            {{ __('apps::dashboard.index.statistics.monthlySubscription') }}
                        </b>
                        <canvas id="monthlySubscription" width="540" height="270"></canvas>
                    </div>
                    
                </div>
            {{-- @endcan --}}
        </div>
    </div>

@stop

@push('start_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    <script>
        $(function() {

            // influencers
            var labelsInflunecersMonthly = {!! $monthlyInfluencers['date'] !!};
            Chart.defaults.global.legend.display = false;

            new Chart(document.getElementById("monthlyInfluencers"), {
                type: 'bar',
                data: {
                    labels: labelsInflunecersMonthly,
                    datasets: [{
                        data: {!! $monthlyInfluencers['countDate'] !!},
                        backgroundColor: generateColorArray(labelsInflunecersMonthly.length),

                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },

                    legend: {
                        display: false
                    }
                }
            });

            // companies
            var labelsCompaniesMonthly = {!! $monthlyCompanies['date'] !!};
            Chart.defaults.global.legend.display = false;

            new Chart(document.getElementById("monthlyCompanies"), {
                type: 'bar',
                data: {
                    labels: labelsCompaniesMonthly,
                    datasets: [{
                        data: {!! $monthlyCompanies['countDate'] !!},
                        backgroundColor: generateColorArray(labelsCompaniesMonthly.length),

                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },

                    legend: {
                        display: false
                    }
                }
            });

            // companies
            var labelsCampaignsMonthly = {!! $monthlyCampaigns['date'] !!};
            Chart.defaults.global.legend.display = false;

            new Chart(document.getElementById("monthlyCampaigns"), {
                type: 'bar',
                data: {
                    labels: labelsCampaignsMonthly,
                    datasets: [{
                        data: {!! $monthlyCompanies['countDate'] !!},
                        backgroundColor: generateColorArray(labelsCampaignsMonthly.length),

                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },

                    legend: {
                        display: false
                    }
                }
            });

             // subscriptions
             var labelsSubscriptionsMonthly = {!! $monthlySubscription['date'] !!};
            Chart.defaults.global.legend.display = false;

            new Chart(document.getElementById("monthlySubscription"), {
                type: 'bar',
                data: {
                    labels: labelsSubscriptionsMonthly,
                    datasets: [{
                        data: {!! $monthlySubscription['countDate'] !!},
                        backgroundColor: generateColorArray(labelsSubscriptionsMonthly.length),

                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },

                    legend: {
                        display: false
                    }
                }
            });


        })
    </script>
@endpush()
