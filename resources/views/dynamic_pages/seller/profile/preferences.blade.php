@extends('layouts.app')

@section('content')


<div class="page-wrapper chiller-theme toggled">
  @include('components.sidebar')
  
  <main class="page-content {{request()->segment(2)}} {{request()->segment(3)}} {{request()->segment(4)}}">
      @include('dynamic_pages.seller.components.navbar')
      <div class="container-fluid">
        <h2><span><i class="fas fa-sliders-h pr-3"></i></span>My Preferences</h2>
        <hr>
        <!--   -->
        <div class="row">
            {!! Form::open(['action' => 'PreferencesController@update', 'method' => 'POST']) !!}
            <div class="form-group">
              {{Form::label('theme', 'Theme:')}}
              {{Form::radio('theme', 'dark', ['title'=> 'dark theme'])}}
              {{Form::radio('theme', 'light', ['title'=> 'light theme'])}}
            </div>
              {{Form::hidden('method','PUT')}}
              {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
          {!! Form::close() !!}
        </div>
      </div>
  
    </main>
    <!-- page-content" -->
  </div>  
@endsection