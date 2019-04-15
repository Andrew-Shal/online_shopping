@extends('layouts.app')

@section('content')

   <div class="thank-you-section">
       <h1>Thank you for <br> Your Order!</h1>
       <p>A confirmation email was sent</p>
       <div class="spacer"></div>
       <div>
           <a href="{{ url('/dashboard') }}" role="button" class="btn btn-primary">Home Page</a>
       </div>
   </div>

@endsection