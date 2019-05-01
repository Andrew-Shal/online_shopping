@extends('layouts.app')
@section('content')
<div class ='container-fluid'>
  <div class="row justify-content-center">
    <div class="col-md-5">
        @include('dynamic_pages.billings.edit',['formAction' => 'buyer.billing.update']) 
    </div>
  </div>
</div>
@endsection