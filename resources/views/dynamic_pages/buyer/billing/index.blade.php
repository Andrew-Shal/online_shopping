@extends('layouts.app')

@section('content')
<div class ='container-fluid'>
  <div class="row justify-content-center">
      @include('inc.messages')
      <div class="col-md-10">
        <h2><span><i class="fas fa-user pr-3"></i></span>My Profile</h2>
        <hr>              
        @if($billingInfo != null)
            @include('dynamic_pages.billings.index')
        @else
            <p> you don't have any billing information yet. <a href="/dashboard#billing"> add here</a></p>
        @endif
      </div>
  </div>
</div>
@endsection