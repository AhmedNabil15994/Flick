@extends('apps::frontend.layouts.app')

@section('css')
    <style>
        #overlay {
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }

        .is-hide {
            display: none;
        }
    </style>
@stop

@section('content')

<div class="wrapper">
    <div class="container-mid">
        <div class="social-tabs">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach ($socials as $social)
                    
                    <li class="nav-item" role="presentation">
                        <button onclick="switchSocial('{{$social}}')" class="nav-link {{$loop->first ? 'active' : ''}}" id="{{$social}}-tab" data-bs-toggle="tab" data-bs-target="#{{$social}}" type="button" role="tab" aria-controls="{{$social}}" aria-selected="true">
                            <ion-icon name="logo-{{$social}}"></ion-icon>
                            <span>@lang(ucfirst($social))</span>
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="home-search">
            <form id="searchForm">
                <input type="hidden" name="social" id="social" value="instagram">
                <input type="hidden" name="page" id="page" value="1">
                <div class="search-box d-flex">
                    <div class="search-input-group d-flex">
                        <ion-icon name="search-outline"></ion-icon>
                        <input class="form-control" type="text" name="search" placeholder="@lang("Search for Influencer name")" />
                    </div>
                    <select class="form-control select2" name="country_id">
                        <option value="">@lang("Choose Country")</option>
                        @foreach ($countries as $id => $country)
                            
                            <option value="{{$id}}">{{$country}}</option>

                        @endforeach
                    </select>
                    <button class="btn btn-submit flex-1" type="button" onclick="filter()">@lang("Search")</button>
                </div>
                <div class="search-filter d-flex">
                    <div class="dropdown">
                        <button class="btn filter-btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            @lang("Followers")
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <div class="filter-drop">
                                <h6>Followers Range</h6>
                                    <div class="form-group">
                                        <div class="filter-price">
                                            <div class="filter-options-content">
                                                <div class="price_slider_wrapper">
                                                    <input type="hidden" name="followers_min" class="minval">
                                                    <input type="hidden" name="followers_max" class="maxval">
                                                    <div data-label-reasult="" data-min="0" data-max="20000000" data-unit="" class="slider-range-price " data-value-min="0" data-value-max="10000000">
                                                    </div>
                                                    <div class="price_slider_amount">
                                                        <div style="" class="price_label">
                                                            <span class="from">0 </span><span class="to">20M</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button class="btn resrt-btn">Clear</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn filter-btn dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            Views
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                            <div class="filter-drop">
                                <h6>Views</h6>
                                <div class="form-group">
                                    <div class="filter-price">
                                        <div class="filter-options-content">
                                            <div class="price_slider_wrapper">
                                                <input type="hidden" name="views_min" class="minval">
                                                <input type="hidden" name="views_max" class="maxval">
                                                <div data-label-reasult="" data-min="0" data-max="20000000" data-unit="" class="slider-range-price " data-value-min="0" data-value-max="10000000">
                                                </div>
                                                <div class="price_slider_amount">
                                                    <div style="" class="price_label">
                                                        <span class="from">0 </span><span class="to">20M</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h6>average views per videos</h6>
                                <div class="form-group">
                                    <div class="filter-price">
                                        <div class="filter-options-content">
                                            <div class="price_slider_wrapper">

                                                <input type="hidden" name="average_views_min" class="minval">
                                                <input type="hidden" name="average_views_max" class="maxval">
                                                <div data-label-reasult="" data-min="0" data-max="20000000" data-unit="" class="slider-range-price " data-value-min="0" data-value-max="10000000">
                                                </div>
                                                <div class="price_slider_amount">
                                                    <div style="" class="price_label">
                                                        <span class="from">0 </span><span class="to">20M</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <button class="btn resrt-btn">Clear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="dropdown">
                        <button class="btn filter-btn dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                            Videos
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                            <div class="filter-drop">
                                    <h6>Videos</h6>
                                    <div class="form-group">
                                        <div class="filter-price">
                                            <div class="filter-options-content">
                                                <div class="price_slider_wrapper">
                                                    <div data-label-reasult="" data-min="0" data-max="100" data-unit="M" class="slider-range-price " data-value-min="5" data-value-max="80">
                                                    </div>
                                                    <div class="price_slider_amount">
                                                        <div style="" class="price_label">
                                                            <span class="from">5M </span><span class="to">100M</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>average Videos per month</h6>
                                    <div class="form-group">
                                        <div class="filter-price">
                                            <div class="filter-options-content">
                                                <div class="price_slider_wrapper">
                                                    <div data-label-reasult="" data-min="0" data-max="100" data-unit="M" class="slider-range-price " data-value-min="5" data-value-max="80">
                                                    </div>
                                                    <div class="price_slider_amount">
                                                        <div style="" class="price_label">
                                                            <span class="from">5M </span><span class="to">100M</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6>average Videos per Year</h6>
                                    <div class="form-group">
                                        <div class="filter-price">
                                            <div class="filter-options-content">
                                                <div class="price_slider_wrapper">
                                                    <div data-label-reasult="" data-min="0" data-max="100" data-unit="M" class="slider-range-price " data-value-min="5" data-value-max="80">
                                                    </div>
                                                    <div class="price_slider_amount">
                                                        <div style="" class="price_label">
                                                            <span class="from">5M </span><span class="to">100M</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button class="btn resrt-btn">Clear</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn filter-btn dropdown-toggle" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-expanded="false">
                            Influencers Type
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                            <div class="filter-drop">
                                    <h6>Brand/Influencer</h6>
                                    <div class="form-check form-group">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault60">
                                        <label class="form-check-label" for="flexCheckDefault60">
                                            My list 1
                                        </label>
                                    </div>
                                    <h6>Verified</h6>
                                    <div class="form-check form-group">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault50">
                                        <label class="form-check-label" for="flexCheckDefault50">
                                            My list 1
                                        </label>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button class="btn resrt-btn">Clear</button>
                                    </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="dropdown">
                        <button class="btn filter-btn dropdown-toggle" type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-expanded="false">
                            Contact
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                            <div class="filter-drop">
                                    <h6>Public contact</h6>
                                    <div class="form-group">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="has_mail" type="checkbox" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Show only accounts with email</label>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <button class="btn resrt-btn">Clear</button>
                                    </div>
                            </div>
                        </div>
                    </div> --}}
                   
                  
                </div>
            </form>
        </div>
    </div>
    <div class="influncers bg-light">
        <div class="overlay"></div>
        <div class="container-mid">
            <div class="items-block">
                <div class="tab-content" id="myTabContent">
                    @foreach ($socials as $social)
                        <div class="tab-pane fade {{$loop->first ? 'show active' : ''}}" id="{{$social}}" role="tabpanel" aria-labelledby="{{$social}}-tab">
                            @if ($loop->first)
                                {!! $influencersHtml !!}
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@push("frontend_scripts")
    <script>
        
        function switchSocial(social){

            $("#social").val(social);
            getInfluencers();
        }
        
        function getPaginate(page = 1){

            $("#page").val(page);
            getInfluencers();
        }

        function filter(){
            getPaginate();
            getInfluencers();
            
        }

        function getInfluencers(){
            
            let content = $("#social").val();
            let page = $("#page").val();
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
            
            $.ajax({

                url: `{{route('frontend.Influencer.ajax.index')}}`,
                type: "GET",
                data: getFormData(),
                success: function (data) {
                    $(`#${content}`).text("").append(data.html); 
                }
            });
        }

        function getFormData(){
            // get all the inputs into an array.
            var $inputs = $('#searchForm :input');

            // not sure if you wanted this, but I thought I'd add it.
            // get an associative array of just the values.
            var values = {};
            $inputs.each(function() {
                values[this.name] = $(this).val();
            });

            return values;
        }


        function resetFilterForm() {
        // Clear Inputs
            $('#searchForm :input').each(function () {
                $(this).val("");
            });
            // Clear Select2
            $('#searchForm').find("select.select2:not(.ignore-reset)").select2();
            filter();
        }
    </script>
@endpush