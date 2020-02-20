@extends('auth.login_partials.master')
@section('page_title', 'Login | Inner Beauty')

@section('content')

<div class="col-12 d-flex align-items-center justify-content-center">
    <div class="col-md-4 col-10 box-shadow-2 p-0">
        <div class="card border-grey border-lighten-3 m-0">
            <div class="card-header border-0">
                <div class="card-title text-center">
                    <div class="p-1">
                        <img src="{{ asset('modern_admin_assets/images/logo/logo.png')}}" alt="Logo">
                    </div>
                </div>
                <h6 class="card-subtitle line-on-side text-muted text-center font-small-4 pt-2">
                    <span><strong> {{ isset($url) ? ucwords($url) : ""}} {{ __('Login') }} </strong></span>
                </h6>
            </div>
            <div class="card-content">
                <div class="card-body">
                    @isset($url)
                        <form class="form-horizontal form-simple" method="POST" action='{{ url("$url/login") }}' aria-label="{{ __('Login') }}">
                    @else
                        <form class="form-horizontal form-simple" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @endisset

                        {{ csrf_field() }}

                        <fieldset class="form-group position-relative has-icon-left mb-1">
                            <input type="email" class="form-control form-control-lg input-lg" name="email" id="email" value="{{ old('email') }}" placeholder="Enter E-Mail Address" autofocus required>
                            <div class="form-control-position">
                                <i class="ft-user"></i>
                            </div>
                        </fieldset>

                        <fieldset class="form-group position-relative has-icon-left">
                            <input type="password" class="form-control form-control-lg input-lg" name="password" id="password" value="{{ old('password') }}" placeholder="Enter Password" required>
                            <div class="form-control-position">
                                <i class="la la-key"></i>
                            </div>
                        </fieldset>

                        <div class="form-group row">
                            <div class="col-md-6 col-12 text-center text-md-left">
                                <fieldset>
                                    <input type="checkbox" name="remember" class="chk-remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember"> Remember Me?</label>
                                </fieldset>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-lg btn-block">
                            <i class="ft-unlock"></i> Login
                        </button>
                    </form>
                </div>
            </div>
            <!-- <div class="card-footer">
                <div class="">
                    <p class="float-sm-left text-center m-0">Don't have an account? &nbsp;
                        <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#social_auth_modal">
                            Sign Up Now
                        </button>
                    </p>
                </div>
            </div> -->
        </div>
    </div>
</div>

@endsection