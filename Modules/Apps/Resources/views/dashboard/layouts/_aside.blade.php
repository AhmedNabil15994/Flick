<div class="page-sidebar-wrapper">

    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200" style="padding-top: 20px">

            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <li class="nav-item {{ active_menu('home') }}">
                <a href="{{ url(route('dashboard.home')) }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">{{ __('apps::dashboard.index.title') }}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="heading">
                <h3 class="uppercase">{{ __('apps::dashboard._layout.aside._tabs.control') }}</h3>
            </li>

            @can('show_roles')
                <li class="nav-item {{ active_menu('roles') }}">
                    <a href="{{ url(route('dashboard.roles.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-briefcase"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.roles') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan


            @can('show_admins')
                <li class="nav-item {{ active_menu('admins') }}">
                    <a href="{{ url(route('dashboard.admins.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-users"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.admins') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('show_packages')
                <li class="nav-item {{ active_menu('packages') }}">
                    <a href="{{ url(route('dashboard.packages.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-paper-clip"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.packages') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('show_tags')
                <li class="nav-item {{ active_menu('tags') }}">
                    <a href="{{ url(route('dashboard.tags.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-users"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.tags') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @canany(['show_users', 'show_influencers', 'show_companies', 'show_workers'])
                <li class="nav-item  {{ active_slide_menu(['users', 'influencers', 'workers', 'companies']) }} open">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-users"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside._tabs.users') }}</span>
                        <span
                            class="arrow {{ active_slide_menu(['users', 'influencers' . 'workers', 'companies']) }} open"></span>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu" style="display: block">

                        @can('show_workers')
                            <li class="nav-item {{ active_menu('workers') }}">
                                <a href="{{ url(route('dashboard.workers.index')) }}" class="nav-link nav-toggle">
                                    <i class="fa fa-user-md"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.workers') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan


                        {{-- @can('show_users')
                            <li class="nav-item {{ active_menu('users') }}">
                                <a href="{{ url(route('dashboard.users.index')) }}" class="nav-link nav-toggle">
                                    <i class="fa fa-user-md"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.users') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan --}}

                        @can('show_influencers')
                            <li class="nav-item {{ active_menu('influencers') }}">
                                <a href="{{ url(route('dashboard.influencers.index')) }}" class="nav-link nav-toggle">
                                    <i class="fa fa-user-md"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.influencers') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                        @can('show_companies')
                            <li class="nav-item {{ active_menu('companies') }}">
                                <a href="{{ url(route('dashboard.companies.index')) }}" class="nav-link nav-toggle">
                                    <i class="fa fa-user-md"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.companies') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcanAny



            @canany(['show_instagram', 'show_youtube', 'show_influencer_tiktok', 'show_influencer_twitch',
                'show_campaigns'])
                <li
                    class="nav-item  {{ active_slide_menu(['instagram', 'youtube', 'influencer_tiktok', 'influencer_twitch', 'campaigns']) }} open">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-users"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside._tabs.accounts') }}</span>
                        <span
                            class="arrow {{ active_slide_menu(['instagram', 'influencer_youtube', 'influencer_tiktok', 'influencer_twitch', 'campaigns']) }} open"></span>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu" style="display: block">

                        @can('show_instagram')
                            <li class="nav-item {{ active_menu('instagram') }}">
                                <a href="{{ url(route('dashboard.instagram.index')) }}" class="nav-link nav-toggle">
                                    <i class="fa fa-instagram"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.instagram') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                        @can('show_youtube')
                            <li class="nav-item {{ active_menu('youtube') }}">
                                <a href="{{ url(route('dashboard.youtube.index')) }}" class="nav-link nav-toggle">
                                    <i class="fa fa-youtube"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.youtube') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                        @can('show_tiktok')
                            <li class="nav-item {{ active_menu('tiktok') }}">
                                <a href="{{ url(route('dashboard.tiktok.index')) }}" class="nav-link nav-toggle">
                                    <i class="fa fa-video-camera"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.tiktok') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                        @can('show_twitch')
                            <li class="nav-item {{ active_menu('twitch') }}">
                                <a href="{{ url(route('dashboard.twitch.index')) }}" class="nav-link nav-toggle">
                                    <i class="fa fa-video-camera"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.twitch') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                        @can('show_campaigns')
                            <li class="nav-item {{ active_menu('campaigns') }} {{ active_menu('events') }}">
                                <a href="{{ url(route('dashboard.campaigns.index')) }}" class="nav-link nav-toggle">
                                    <i class="fa fa-adn"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.campaigns') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan




                    </ul>
                </li>
            @endcanAny


            @can('show_notifications')
                <li class="nav-item {{ active_menu('notifications') }}">
                    <a href="{{ url(route('dashboard.notifications.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-layers"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.notifications') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('show_contacts_us')
                <li class="nav-item {{ active_menu('contacts_us') }}">
                    <a href="{{ url(route('dashboard.contacts_us.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-layers"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.contacts_us') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            {{-- @can('show_categories')
                <li class="nav-item {{ active_menu('categories') }}">
                    <a href="{{ url(route('dashboard.categories.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-layers"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.categories') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan --}}

            @canany(['show_countries', 'show_areas', 'show_cities', 'show_states'])
                <li class="nav-item  {{ active_slide_menu(['countries', 'cities', 'states', 'areas']) }} open">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-pointer"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.countries') }}</span>
                        <span
                            class="arrow {{ active_slide_menu(['countries', 'governorates', 'cities', 'regions']) }} open"></span>
                        <span class="selected"></span>
                    </a>
                    <ul class="sub-menu" style="display: block">

                        @can('show_countries')
                            <li class="nav-item {{ active_menu('countries') }}">
                                <a href="{{ url(route('dashboard.countries.index')) }}" class="nav-link nav-toggle">
                                    <i class="fa fa-building"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.countries') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                        @can('show_cities')
                            <li class="nav-item {{ active_menu('cities') }}">
                                <a href="{{ url(route('dashboard.cities.index')) }}" class="nav-link nav-toggle">
                                    <i class="fa fa-building"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.cities') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan

                        @can('show_states')
                            <li class="nav-item {{ active_menu('states') }}">
                                <a href="{{ url(route('dashboard.states.index')) }}" class="nav-link nav-toggle">
                                    <i class="fa fa-building"></i>
                                    <span class="title">{{ __('apps::dashboard._layout.aside.state') }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanAny

            <li class="heading">
                <h3 class="uppercase">{{ __('apps::dashboard._layout.aside._tabs.other') }}</h3>
            </li>

            @can('show_pages')
                <li class="nav-item {{ active_menu('pages') }}">
                    <a href="{{ url(route('dashboard.pages.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-docs"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.pages') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('show_sliders')
                <li class="nav-item {{ active_menu('sliders') }}">
                    <a href="{{ url(route('dashboard.sliders.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-docs"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.sliders') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('edit_settings')
                <li class="nav-item {{ active_menu('setting') }}">
                    <a href="{{ url(route('dashboard.setting.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.setting') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('show_logs')
                <li class="nav-item {{ active_menu('logs') }}">
                    <a href="{{ url(route('dashboard.logs.index')) }}" class="nav-link nav-toggle">
                        <i class="icon-folder"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.logs') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan

            @can('show_logs')
                <li class="nav-item {{ active_menu('devices') }}">
                    <a href="{{ url(route('dashboard.devices.index')) }}" class="nav-link nav-toggle">
                        <i class="fa fa-mobile"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.devices') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan



            @can('show_telescope')
                <li class="nav-item {{ active_menu('telescope') }}">
                    <a href="{{ url(route('telescope')) }}" class="nav-link nav-toggle">
                        <i class="icon-settings"></i>
                        <span class="title">{{ __('apps::dashboard._layout.aside.telescope') }}</span>
                        <span class="selected"></span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>

</div>
