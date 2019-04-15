@extends('layouts.app')

@section('content')
  <div class="row mt-5">
    <div class="col-md-12">
      <a href='/posts' class="btn btn-primary" role="button">Go Back</a>
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
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a>
                    {!! Form::open(['action' => ['PostController@destroy', $post->id],'method' => 'POST', 'class' => 'float-right']) !!}
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
  </div>
@endsection