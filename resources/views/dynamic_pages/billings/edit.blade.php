{!! Form::open(['route' => $formAction, 'method' => 'POST']) !!}
            @csrf
              <div class="form-group">
                {{Form::label('billing_name', 'Billing Name')}}
                {{Form::text('billing_name', $billingInfo->billing_name, ['class' => $errors->has("billing_name") ? "form-control is-invalid" : "form-control", 'placeholder'=>'billing name', 'value'=> old("billing_name") ])}}
                @if ($errors->has('billing_name'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('billing_name') }}</strong>
                  </span>
                @endif
              </div>
              <div class="form-group">
                  {{Form::label('billing_email', 'Email')}}
                  {{Form::text('billing_email', $billingInfo->billing_email, ['class' => 'form-control', 'placeholder'=>'example@gmail.com'])}}
                </div>
                <div class="form-group">
                  {{Form::label('billing_address', 'Address')}}
                  {{Form::text('billing_address', $billingInfo->billing_address, ['class' => 'form-control', 'placeholder'=>'Address'])}}
                </div>
                <div class="form-group">
                  {{Form::label('billing_city', 'City')}}
                  {{Form::text('billing_city', $billingInfo->billing_city, ['class' => 'form-control', 'placeholder'=>'City'])}}
                </div>
                <div class="form-group">
                  {{Form::label('billing_province', 'Province')}}
                  {{Form::text('billing_province', $billingInfo->billing_province , ['class' => 'form-control', 'placeholder'=>'Province'])}}
                </div>
                <div class="form-group">
                  {{Form::label('billing_phone', 'Phone')}}
                  {{Form::text('billing_phone', $billingInfo->billing_phone, ['class' => 'form-control', 'placeholder'=>'Phone'])}}
                </div>
              
                {{Form::hidden('_method','PUT')}}
                {{Form::submit('Update',['class' => 'btn btn-primary'])}}
{!! Form::close() !!}