@php
$locale = locale();
@endphp
<html lang="{{ $locale }}" dir="{{ is_rtl() }}">

@include('apps::frontend.layouts.head')

<body>

    @include('apps::frontend.layouts.header')

    <div class="banner-upgrade">
        {!! setting('general_msg', $locale) !!}
    </div>

    @yield('content')
    <div class="modal fade" id="modal-upgrade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class='d-flex justify-content-end'>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h2 class='modal-title'>Flexible pricing for every business</h2>
                    <div class="plans row">
                        <div class="col-md-4">
                            <div class="plan">
                                <div class="plan-head text-center">
                                    <h3>Starter </h3>
                                    <p>For small campaigns</p>
                                    <h4>KWD 90<span>/Month</span></h4>
                                    <a class="btn btn-submit btn-block" href="index.php?page=subscription">Subscribe</a>
                                </div>
                                <div class="features">
                                    <h4>Included features:</h4>
                                    <ul>
                                        <li> Database of 11M influencers <span class="help"
                                                title="Database 11 million influencers on Instagram, Youtube, TikTok and Twitch."
                                                data-bs-toggle="tooltip" data-bs-placement="right"><i
                                                    class='ti-help-alt'></i></span></li>
                                        <li>5,000 search results <span class="help"
                                                title="Database 11 million influencers on Instagram, Youtube, TikTok and Twitch."
                                                data-bs-toggle="tooltip" data-bs-placement="right"><i
                                                    class='ti-help-alt'></i></span> </li>
                                        <li>Access to 500 influencers <span class="help"
                                                title="Database 11 million influencers on Instagram, Youtube, TikTok and Twitch."
                                                data-bs-toggle="tooltip" data-bs-placement="right"><i
                                                    class='ti-help-alt'></i></span></li>
                                        <li>List</li>
                                        <li>Basic Search</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="plan featured">
                                <div class="plan-head text-center">
                                    <span id='planrecommended'>The most popular</span>
                                    <h3>Business </h3>
                                    <p>For advanced needs</p>
                                    <h4>KWD 160<span>/Month</span></h4>
                                    <a class="btn btn-submit btn-block" href="index.php?page=subscription">Subscribe</a>
                                </div>
                                <div class="features">
                                    <h4>Included features:</h4>
                                    <ul>
                                        <li> Access to 1,000 influencers <span class="help"
                                                title="Database 11 million influencers on Instagram, Youtube, TikTok and Twitch."
                                                data-bs-toggle="tooltip" data-bs-placement="right"><i
                                                    class='ti-help-alt'></i></span></li>
                                        <li> Database of 11M influencers <span class="help"
                                                title="Database 11 million influencers on Instagram, Youtube, TikTok and Twitch."
                                                data-bs-toggle="tooltip" data-bs-placement="right"><i
                                                    class='ti-help-alt'></i></span> </li>
                                        <li>20,000 search results <span class="help"
                                                title="Database 11 million influencers on Instagram, Youtube, TikTok and Twitch."
                                                data-bs-toggle="tooltip" data-bs-placement="right"><i
                                                    class='ti-help-alt'></i></span></li>
                                        <li>Access to 2,000 influencers</li>
                                        <li>List</li>
                                        <li>Engagement search <span class="help"
                                                title="Database 11 million influencers on Instagram, Youtube, TikTok and Twitch."
                                                data-bs-toggle="tooltip" data-bs-placement="right"><i
                                                    class='ti-help-alt'></i></span></li>
                                        <li>Contact </li>
                                        <li>Exports </li>
                                        <li>Premium support </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="plan">
                                <div class="plan-head text-center">
                                    <h3>Gold </h3>
                                    <p>For large campaigns</p>
                                    <h4>KWD 220<span>/Month</span></h4>
                                    <a class="btn btn-submit btn-block" href="index.php?page=subscription">Subscribe</a>
                                </div>
                                <div class="features">
                                    <h4>Included features:</h4>
                                    <ul>
                                        <li>Database of 11M influencers <span class="help"
                                                title="Database 11 million influencers on Instagram, Youtube, TikTok and Twitch."
                                                data-bs-toggle="tooltip" data-bs-placement="right"><i
                                                    class='ti-help-alt'></i></span></li>
                                        <li> 40,000 search results <span class="help"
                                                title="Database 11 million influencers on Instagram, Youtube, TikTok and Twitch."
                                                data-bs-toggle="tooltip" data-bs-placement="right"><i
                                                    class='ti-help-alt'></i></span></li>
                                        <li> Access to 5,000 influencers <span class="help"
                                                title="Database 11 million influencers on Instagram, Youtube, TikTok and Twitch."
                                                data-bs-toggle="tooltip" data-bs-placement="right"><i
                                                    class='ti-help-alt'></i></span></li>
                                        <li> Lists </li>
                                        <li>Basic search</li>
                                        <li>Engagement search</li>
                                        <li>Contact </li>
                                        <li>Exports <span class="help"
                                                title="Database 11 million influencers on Instagram, Youtube, TikTok and Twitch."
                                                data-bs-toggle="tooltip" data-bs-placement="right"><i
                                                    class='ti-help-alt'></i></span></li>
                                        <li>Premium support </li>
                                        <li>Promotional activity <span class="help"
                                                title="Database 11 million influencers on Instagram, Youtube, TikTok and Twitch."
                                                data-bs-toggle="tooltip" data-bs-placement="right"><i
                                                    class='ti-help-alt'></i></span></li>
                                        <li>Audience data</li>
                                        <li>Authenticity audits </li>
                                        <li>Multiple devices <span class="help"
                                                title="Database 11 million influencers on Instagram, Youtube, TikTok and Twitch."
                                                data-bs-toggle="tooltip" data-bs-placement="right"><i
                                                    class='ti-help-alt'></i></span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('apps::frontend.layouts.footer')


    @include('apps::frontend.layouts._js')

</body>

</html>
