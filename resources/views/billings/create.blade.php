@extends('layouts.app')

@section('content')

@if (session()->has('success_message'))
<div class="alert alert-success">
    {{ session()->get('success_message') }}
</div>
@endif

@if(count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

  <h1>Set Billing Info</h1>
  {!! Form::open(['action' => 'BillingController@store', 'method' => 'POST']) !!}
  @csrf
    <div class="form-group">
      {{Form::label('billing_name', 'Billing Name')}}
      {{Form::text('billing_name', '', ['class' => $errors->has("billing_name") ? "form-control is-invalid" : "form-control", 'placeholder'=>'billing name', 'value'=> old("billing_name") ])}}
      @if ($errors->has('billing_name'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('billing_name') }}</strong>
        </span>
      @endif
    </div>
    <div class="form-group">
        {{Form::label('billing_email', 'Email')}}
        {{Form::text('billing_email', '', ['class' => 'form-control', 'placeholder'=>'example@gmail.com'])}}
      </div>
      <div class="form-group">
        {{Form::label('billing_address', 'Address')}}
        {{Form::text('billing_address', '', ['class' => 'form-control', 'placeholder'=>'Address'])}}
      </div>
      <div class="form-group">
        {{Form::label('billing_city', 'City')}}
        {{Form::text('billing_city', '', ['class' => 'form-control', 'placeholder'=>'City'])}}
      </div>
      <div class="form-group">
        {{Form::label('billing_province', 'Province')}}
        {{Form::text('billing_province', '', ['class' => 'form-control', 'placeholder'=>'Province'])}}
      </div>
      <div class="form-group">
        {{Form::label('billing_phone', 'Phone')}}
        {{Form::text('billing_phone', '', ['class' => 'form-control', 'placeholder'=>'Phone'])}}
      </div>
    
      {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}
@endsection

@section('scripts')
<script>
$(document).ready(function() {

  $(".btn-success").click(function(){ 
      var html = $(".clone").html();
      $(".increment").after(html);
  });

  $("body").on("click",".btn-danger",function(){ 
      $(this).parents(".control-group").remove();
  });

});
</script>
@endsection