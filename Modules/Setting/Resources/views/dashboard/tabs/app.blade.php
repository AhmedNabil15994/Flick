<div class="tab-pane fade" id="app">
    <h3 class="page-title">{{ __('setting::dashboard.settings.form.tabs.app') }}</h3>
    <div class="col-md-10">

        {{-- tab for lang --}}
        <ul class="nav nav-tabs">
            @foreach (config('translatable.locales') as $code)
                <li class="@if ($loop->first) active @endif"><a data-toggle="tab"
                        href="#app_{{ $code }}">{{ $code }}</a></li>
            @endforeach
        </ul>
        {{-- tab for content --}}
        <div class="tab-content">
            @foreach (config('translatable.locales') as $code)
                <div id="app_{{ $code }}"
                    class="tab-pane fade @if ($loop->first) in active @endif">
                    <div class="form-group">
                        <label class="col-md-2">
                            {{ __('setting::dashboard.settings.form.app_name') }} - {{ $code }}
                        </label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="app_name[{{ $code }}]"
                                value="{{ setting('app_name', $code) }}" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2">
                            {{ __('setting::dashboard.settings.form.general_msg') }} - {{ $code }}
                        </label>
                        <div class="col-md-9">
                            <textarea type="text" rows="8" cols="80" class="form-control {{is_rtl($code)}}Editor" name="general_msg[{{$code}}]"/>{{ setting('general_msg',$code) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2">
                            {{ __('setting::dashboard.settings.form.description') }} - {{ $code }}
                        </label>
                        <div class="col-md-9">
                            <textarea type="text" rows="8" cols="80" class="form-control"
                                name="description[{{ $code }}]" />{{ setting('description', $code) }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2">
                            {{ __('setting::dashboard.settings.form.keywords') }} - {{ $code }}
                        </label>
                        <div class="col-md-9">
                            <textarea type="text" rows="8" cols="80" class="form-control"
                                name="keywords[{{ $code }}]" />{{ setting('keywords', $code) }}</textarea>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

            <div class="form-group">
                <label class="col-md-2">
                    {{ __('setting::dashboard.settings.form.contacts_email') }}
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="contact_us[email]"
                        value="{{ setting('contact_us', 'email') }}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    {{ __('setting::dashboard.settings.form.contacts_whatsapp') }}
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="contact_us[whatsapp]"
                        value="{{ setting('contact_us', 'whatsapp') }}" />
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">
                    {{ __('setting::dashboard.settings.form.contacts_call_number') }}
                </label>
                <div class="col-md-9">
                    <input type="text" class="form-control" name="contact_us[call_number]"
                        value="{{ setting('contact_us', 'call_number') }}" />
                </div>
            </div>
        </div>
    </div>
