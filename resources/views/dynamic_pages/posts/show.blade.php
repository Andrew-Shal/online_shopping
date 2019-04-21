@extends('layouts.app')

@section('content')


<div class="page-wrapper chiller-theme toggled">
  @include('components.sidebar')
  
  <main class="page-content {{request()->segment(2)}}">
      @include('dynamic_pages.seller.components.navbar')

      <div id="breadcrumb"> <a href="{{route('seller_home')}}" title="Go to Home"><i class="fa fa-home"></i> Home</a><a href="{{route('posts.index')}}">Posts</a><a href="{{route('posts.show',$post->id)}}" class="current">{{$post->title}}</a></div>

      <div class="container-fluid">
        <h2><span><i class="fa fa-tachometer-alt pr-3"></i></span>{{$post->title}}</h2>
        <hr>
        <div class="row">
            <div class="col-md-8">
              <div class="row">
                <img style="width:100%;max-height: 200px;overflow: hidden;" src="/storage/cover_images/{{$post->cover_image}}" alt="">
              </div>
              <div class="row">
                <div class="col-md-12">
                    <h1>{{$post->title}}</h1>
                    <div>
                      {!! $post->body !!}
                    </div>
                    @if(!Auth::guest())
                      @if(Auth::user()->id == $post->user_id)
                        <a href="{{$post->id}}/edit" class="btn btn-primary">Edit</a>
                        {!! Form::open(['action' => ['PostController@destroy', $post->id],'method' => 'POST', 'class' => 'float-right']) !!}
                        @csrf
                        {!! Form::hidden('_method', 'DELETE') !!}
                        {!! Form::submit('delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                      @endif
                    @endif        
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <hr>
                  <small>Written on {{$post->created_at}} by {{$post->user->first_name}}</small>  
                </div>
              </div>
            </div>
          </div>
      </div>
  
    </main>
    <!-- page-content" -->
  </div>  
@endsection