<header>
    <div class="container-mid">
        <div class="d-flex justify-content-between">
            <a class="site-logo" href="{{ route('frontend.home.index') }}"><img
                    src="{{ asset('frontend/images/logo.svg') }}" class="img-fluid" alt="" /></a>
            <nav class="user-header">
                @php
                    if (app()->isLocale('en')) {
                        $locale = 'ar';
                        $svg = 'kw';
                        $lang = 'AR';
                    } else {
                        $locale = 'en';
                        $svg = 'gb';
                        $lang = 'EN';
                    }
                @endphp
                <a class="lang-btn" href="{{ LaravelLocalization::getLocalizedURL($locale, null, [], true) }}"><img
                        class="img-fluid" src="{{ asset('frontend/images/' . $svg . '.svg') }}" alt="">
                    {{ $lang }}</a>                                     
                    @auth('frontend')
                    <a class="iflu-btn" href="{{route("clients.my_campaigns")}}"><ion-icon name="flag-outline"></ion-icon> <span>@lang("My campaigns")</span></a>
                    @endauth
                {{-- <a class="message-btn" href="index.php?page=messages">
                    <ion-icon name="mail-outline"></ion-icon> <span class="message-noti"></span>
                </a> --}}
                {{-- <a class="iflu-btn" href="{{ route('client.my_influencers', hash_id(auth()->id())) }}">
                    <ion-icon name="file-tray-full-outline"></ion-icon> <span>My influencers</span>
                </a> --}}

                <div class="dropdown">
                    @auth('frontend')
                        @php
                            $auth = auth()->user();
                        @endphp
                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <ion-icon name="person-outline"></ion-icon> <span>{{ $auth->name ?? '' }}</span>
                        </button>

                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            {{-- <li><a class="dropdown-item" href="/">
                                    <ion-icon name="settings-outline"></ion-icon> @lang('Account settings')
                                </a></li>
                            <li><a class="dropdown-item" href="/">
                                    <ion-icon name="people-outline"></ion-icon> @lang('Influencers')
                                </a>
                            </li>
                            <li><a class="dropdown-item" href="/">
                                    <ion-icon name="rocket-outline"></ion-icon> @lang('Plan')
                                </a></li> --}}
                            {{-- <li><a class="dropdown-item" href="index.php?page=invoices">
                                <ion-icon name="file-tray-full-outline"></ion-icon> Invoices
                            </a></li> --}}
                            <li>
                                <form method="POST" action="{{ route('frontend.logout') }}">
                                    @csrf

                                    <a class="dropdown-item" href="{{route('frontend.logout')}}">
                                        <ion-icon name="log-out-outline"></ion-icon> @lang('Logout')
                                    </a>
                                </form>

                            </li>
                        </ul>
                    @else
                        <a href="signin" class="btn btn-link" style="background-color: #fff"> <ion-icon style="zoom:2.0;" name="log-in-outline"></ion-icon></a>
                    @endauth
                </div>
            </nav>
        </div>
    </div>
</header>
