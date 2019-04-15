@extends('layouts.app')

@section('content')
<div class="container">
        <div class="auth-pages">
            <div class="auth-left">

                <h2>{{ __('Returning Customer') }}</h2>
                <div class="spacer"></div>
    
                <form action="{{ route('login') }}" method="POST" novalidate>
                    @csrf
    
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
    
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>   
                </form>
            </div>
    
            <div class="auth-right">
                <h2>New Customer</h2>
                <div class="spacer"></div>
                <p><strong>Save time now.</strong></p>
                <p>You don't need an account to checkout.</p>
                <div class="spacer"></div>
                <a class="btn btn-primary" role="btn" href="{{ route('guestCheckout.index') }}" class="auth-button-hollow">Continue as Guest</a>
                <div class="spacer"></div>
                &nbsp;
                <div class="spacer"></div>
                <p><strong>Save time later.</strong></p>
                <p>Create an account for fast checkout and easy access to order history.</p>
                <div class="spacer"></div>
                <a class="btn btn-primary" role="btn" href="{{ route('register') }}" class="auth-button-hollow">Create Account</a>
    
            </div>
        </div>
    </div>
@endsection
