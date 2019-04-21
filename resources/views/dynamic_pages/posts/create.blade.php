@extends('layouts.app')

@section('content')


<div class="page-wrapper chiller-theme toggled">
  @include('components.sidebar')
  
  <main class="page-content {{request()->segment(2)}} {{request()->segment(3)}} {{request()->segment(4)}}">
      @include('dynamic_pages.seller.components.navbar')

      <div id="breadcrumb"> <a href="{{route('seller_home')}}" title="Go to Home"><i class="fa fa-home"></i> Home</a><a href="{{route('posts.index')}}">Posts</a><a href="{{route('posts.create')}}" class="current">create post</a></div>
      
      <div class="container-fluid">
        <h2><span><i class="fab fa-blogger pr-3"></span></i>Create Post</h2>
        <hr>
        <!--   -->
        <div class="row">
            {!! Form::open(['action' => 'PostController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
              {{Form::label('title', 'Title')}}
              {{Form::text('title', '', ['class' => 'form-control', 'placeholder'=>'Title'])}}
            </div>
            <div class="form-group">
                {{Form::label('body', 'Body')}}
                {{Form::textarea('body', '', ['id' => 'body-ckeditor','class' => 'form-control', 'placeholder'=>'Body text'])}}
              </div>
              <div class="form-group">
                {{Form::file('cover_image')}}
              </div>
              {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
          {!! Form::close() !!}
        </div>
      </div>
  
    </main>
    <!-- page-content" -->
  </div>  
@endsection

@section('scripts')
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('body-ckeditor');
</script>
@endsection