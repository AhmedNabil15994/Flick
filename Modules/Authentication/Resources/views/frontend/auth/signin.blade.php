@extends('apps::frontend.layouts.guest')
@section('content')
<div class="wrapper">
    <div class="container">
        <div class="login-page">
            <div class="row grey-bg align-items-center d-flex">
                <div class="col-md-6">
                    <div class="login-content">
                        <div class="section-title">
                            <h2>Login To {{ config('app.name') }}</h2>
                        </div>
                        <form action="{{ route('frontend.post.signin') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="form-label">{{ __('authentication::dashboard.login.form.email') }} <span
                                        class="required">*</span></label>
                                <input class="form-control" type="email" name="email" placeholder="Email" required />
                                @error('email')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{ __('authentication::dashboard.login.form.password') }}
                                    <span class="required">*</span></label>
                                <input class="form-control" type="password" name="password" placeholder="Password"
                                    required />
                                    @error('password')<div class="alert alert-danger">{{ $message }}</div>@enderror
                            </div>
                          
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-submit btn-block">{{ __('Login') }}</button>
                            </div>
                            <p class="login-note">{{ __('authentication::dashboard.login.form.dont_have_acccount') }} 
                                <br><a href="{{ route('frontend.signup') }}">{{ __('authentication::dashboard.login.form.create_free_account') }}  </a></p>
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