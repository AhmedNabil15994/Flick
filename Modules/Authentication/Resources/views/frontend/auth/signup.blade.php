@extends('apps::frontend.layouts.guest')
@section('content')
<div class="wrapper">
    <div class="container">
        <div class="login-page">
            <div class="row grey-bg align-items-center d-flex">
                <div class="col-md-6">
                    <div class="login-content">
                        <div class="section-title">
                            <h2>Join To {{ config('app.name') }}</h2>
                        </div>
                        <form action="{{ route('frontend.post.signup') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label"> {{ __('authentication::dashboard.login.form.name') }} <span
                                        class="required">*</span></label>
                                <input class="form-control" autocomplete="off" autofocus type="text" name="name" placeholder="{{ __('authentication::dashboard.login.form.name') }}" required
                                    autofocus>
                                    @error('name')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ __('authentication::dashboard.login.form.email') }} <span
                                        class="required">*</span></label>
                                <input class="form-control" autocomplete="off" type="email" name="email"  placeholder="{{ __('authentication::dashboard.login.form.email') }}" required />
                                @error('email')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label"></label>
                                <label class="form-label">{{ __('authentication::dashboard.login.form.mobile') }} <span
                                        class="required">*</span></label>
                                        {{-- pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" --}}
                                <input class="form-control" autocomplete="off"  type="number" name="mobile" placeholder="{{ __('authentication::dashboard.login.form.mobile') }}"
                                    required>
                                    @error('mobile')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ __('authentication::dashboard.login.form.password') }}
                                    <span class="required">*</span></label>
                                <input class="form-control" autocomplete="off" type="password" name="password" placeholder="{{ __('authentication::dashboard.login.form.password') }}"
                                    required />
                                    @error('password')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ __('authentication::dashboard.login.form.confirm_password')
                                    }} <span class="required">*</span></label>
                                <input class="form-control" autocomplete="off" type="password" name="confirm_password"
                                    placeholder="{{ __('authentication::dashboard.login.form.confirm_password')}}" required>
                                @error('confirm_password')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-check form-group">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault50">
                                <label class="form-check-label check-note" for="flexCheckDefault50">
                                    {{ __('authentication::dashboard.login.form.by_creating_this_account') }} <a href="#"> {{ __('authentication::dashboard.login.form.privacy_policy') }}</a>
                                </label>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-submit btn-block">{{ __('authentication::dashboard.login.form.create_account') }}</button>
                            </div>
                            <p class="login-note">{{ __('authentication::dashboard.login.form.have_account') }} <a href='{{ route('frontend.signin') }}'>
                                {{ __('authentication::dashboard.login.form.sign_in') }}</a>
                            </p>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 login-img">
                    <div class="img-box">
                        <img class="img-fluid img-animate" src="{{ asset('frontend/images/login.svg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop