  <!--update profile form-->
  <form method="POST" action="{{route($formAction)}}" novalidate>
    @csrf
    <div class="row account-edit-form">
        <div class="col-md-12">
            <h6>General</h6>
            <hr>
            <div class="row"><!--first name-->
                <div class="form-group col-md-6">
                    <label for="first_name" class="col-md-5 col-form-label text-md-left">{{ __('First Name') }}</label>

                    <div class="col-md-12">
                        <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" value="{{$user->first_name}}" required autofocus>

                        @if ($errors->has('first_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group col-md-6">   <!--last name-->
                    <label for="last_name" class="col-md-5 col-form-label text-md-left">{{ __('Last Name') }}</label>

                    <div class="col-md-12">
                        <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name" value="{{$user->last_name}}" required autofocus>

                        @if ($errors->has('last_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div><!--last name-->
            </div><!--first name-->
            <div class="row"><!--email address-->
               
                <div class="form-group col-md-6">
                    <label for="email" class="col-md-5 col-form-label text-md-left">{{ __('Email Address') }}</label>

                    <div class="col-md-12">
                        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$user->email}}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <label for="confirm_email" class="col-md-12 col-form-label text-md-left">{{ __('Confirm Email Address') }}</label>

                    <div class="col-md-12">
                        <input id="confirm_email" type="text" class="form-control{{ $errors->has('confirm_email') ? ' is-invalid' : '' }}" name="confirm_email" value="" required autofocus>

                        @if ($errors->has('confirm_email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('confirm_email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!--phone number-->
                <div class="form-group col-md-6">
                    <label for="phone_number" class="col-md-5 col-form-label text-md-left">{{ __('Phone Number') }}</label>

                    <div class="col-md-12">
                        <input id="phone_number" type="text" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}" name="phone_number" value="{{$user->phone_number}}" required autofocus>

                        @if ($errors->has('phone_number'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone_number') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div><!--email address-->
            <h6>Location</h6>
            <hr>
            <div class="row"><!--location-->
                <div class="col-md-12">
                    <div class="row">
                        <!--customer city-->
                        <div class="form-group col-md-6">
                            <label for="cust_city" class="col-md-4 col-form-label text-md-left">{{ __('City') }}</label>
    
                            <div class="col-md-12">
                                <input id="cust_city" type="text" class="form-control{{ $errors->has('cust_city') ? ' is-invalid' : '' }}" name="cust_city" value="{{$user->cust_city}}" required autofocus>
    
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
                                <input id="cust_country" type="text" class="form-control{{ $errors->has('cust_country') ? ' is-invalid' : '' }}" name="cust_country" value="{{$user->cust_country}}" required autofocus>
    
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
                                <input id="cust_street" type="text" class="form-control{{ $errors->has('cust_street') ? ' is-invalid' : '' }}" name="cust_street" value="{{$user->cust_street}}" required autofocus>
    
                                @if ($errors->has('cust_street'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cust_street') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div><!--location-->
            <h6>Authentication</h6>
            <hr>
            <div class="row"><!--credentials-->
                
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
            </div><!--credentials-->
            <div class="row"><!--credentials-->           
                <!--current password-->
                <div class="form-group col-md-6">
                    <label for="current_password" class="col-md-12 col-form-label text-md-left">{{ __('Current Password') }}</label>

                    <div class="col-md-12">
                        <input id="current_password" type="password" class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}" name="current_password" required>

                        @if ($errors->has('current_password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('current_password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div><!--credentials-->
            <!--sumbit button-->
            <div class="form-group row mb-0">
                <div class="col-md-6 pl-4">
                    <input name="_method" type="hidden" value="PUT">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Save Changes') }}
                    </button>
                </div>
            </div>
        </div>  
    </div>                   
</form>

<style>
    .account-edit-form:not(:first-child) h6{
        margin-top:40px;
    }
</style>