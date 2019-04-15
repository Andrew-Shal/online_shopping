@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
        
                <div class="card-body">
                    <!--registration form-->
                    <form method="POST" action="{{ route('register') }}" novalidate>
                        @csrf
    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <!--first name-->
                                    <div class="form-group col-md-6">
                                        <label for="first_name" class="col-md-5 col-form-label text-md-left">{{ __('First Name') }}</label>

                                        <div class="col-md-12">
                                            <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                            @if ($errors->has('first_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--last name-->
                                    <div class="form-group col-md-6">
                                        <label for="last_name" class="col-md-5 col-form-label text-md-left">{{ __('Last Name') }}</label>

                                        <div class="col-md-12">
                                            <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                            @if ($errors->has('last_name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!--email address-->
                                    <div class="form-group col-md-6">
                                        <label for="email" class="col-md-5 col-form-label text-md-left">{{ __('Email Address') }}</label>

                                        <div class="col-md-12">
                                            <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--phone number-->
                                    <div class="form-group col-md-6">
                                        <label for="phone_number" class="col-md-5 col-form-label text-md-left">{{ __('Phone Number') }}</label>

                                        <div class="col-md-12">
                                            <input id="phone_number" type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{ old('phone_number') }}" required autofocus>

                                            @if ($errors->has('phone_number'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('phone_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <!--customer city-->
                                            <div class="form-group col-md-6">
                                                <label for="cust_city" class="col-md-4 col-form-label text-md-left">{{ __('City') }}</label>
                        
                                                <div class="col-md-12">
                                                    <input id="cust_city" type="text" class="form-control{{ $errors->has('cust_city') ? ' is-invalid' : '' }}" name="cust_city" value="{{ old('cust_city') }}" required autofocus>
                        
                                                    @if ($errors->has('cust_city'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('cust_city') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <!--customer country-->
                                            <div class="form-group col-md-6">
                                                <label for="cust_country" class="col-md-4 col-form-label text-md-left">{{ __('Country') }}</label>
                        
                                                <div class="col-md-12">
                                                    <input id="cust_country" type="text" class="form-control{{ $errors->has('cust_country') ? ' is-invalid' : '' }}" name="cust_country" value="{{ old('cust_country') }}" required autofocus>
                        
                                                    @if ($errors->has('cust_country'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('cust_country') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <!--customer street-->
                                            <div class="form-group col-md-6">
                                                <label for="cust_street" class="col-md-4 col-form-label text-md-left">{{ __('Street') }}</label>
                        
                                                <div class="col-md-12">
                                                    <input id="cust_street" type="text" class="form-control{{ $errors->has('cust_street') ? ' is-invalid' : '' }}" name="cust_street" value="{{ old('cust_street') }}" required autofocus>
                        
                                                    @if ($errors->has('cust_street'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('cust_street') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    
                                    <!--password-->
                                    <div class="form-group col-md-6">
                                        <label for="password" class="col-md-12 col-form-label text-md-left">{{ __('Password') }}</label>
            
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--password confirm-->
                                    <div class="form-group col-md-6">
                                        <label for="password-confirm" class="col-md-12 col-form-label text-md-left">{{ __('Confirm Password') }}</label>
            
                                        <div class="col-md-12">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>  
                                </div>
                                <!--sumbit button-->
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </div>  
                        </div>                   
                    </form>
                </div>
            </div>                
        </div>
    </div>
</div>
@endsection