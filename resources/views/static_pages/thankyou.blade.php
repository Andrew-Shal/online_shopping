@extends('layouts.app')

@section('content')

   <div class="thank-you-section">
       <h1>Thank you for your Order!</h1>
       <p>An email was sent with your receipt</p>
       <div class="spacer"></div>
       <div>
           <a href="{{ url('/dashboard') }}" role="button" class="btn btn-primary">Home Page</a>
       </div>
   </div>

@endsection