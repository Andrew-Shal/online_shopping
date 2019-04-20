@extends('layouts.app')

@section('content')


<div class="page-wrapper chiller-theme toggled">
  @include('components.sidebar')
  
  <main class="page-content">
      @include('dynamic_pages.seller.components.navbar')
      <div class="container-fluid">
        <h2>Dashboard</h2>
        <hr>
      </div>
  
    </main>
    <!-- page-content" -->
  </div>  
@endsection

@section('scripts')
@endsection