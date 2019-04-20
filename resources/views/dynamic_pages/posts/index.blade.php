@extends('layouts.app')

@section('content')


<div class="page-wrapper chiller-theme toggled">
  @include('components.sidebar')
  
  <main class="page-content {{request()->segment(2)}} {{request()->segment(3)}} {{request()->segment(4)}}">
      @include('dynamic_pages.seller.components.navbar')
      <div class="container-fluid">
        <h2><span><i class="fab fa-blogger pr-3"></span></i>My Posts</h2>
        <hr>

        @include('inc.messages')
        <!--   -->
        @if(count($posts) > 0)
        @foreach($posts as $post)
        <div class="card mb-5">
            <div class="card-header">
              <h3><a href="posts/{{$post->id}}">{{$post->title}}</a></h3>
              <small>written on {{$post->created_at}} by {{$post->user->first_name}}</small>
            </div>
            <div class="card-body">
              <p><?php echo $post->body?></p>
              {!! Form::open(['action' => ['PostController@destroy', $post->id],'method' => 'POST', 'class' => 'float-right']) !!}
              @csrf
              {!! Form::hidden('_method', 'DELETE') !!}
              {!! Form::submit('delete', ['class' => 'btn btn-danger']) !!}
              {!! Form::close() !!}
              <a href="posts/{{$post->id}}/edit" class="btn btn-primary float-right mr-2">edit</a>
            </div>
        </div>          
        @endforeach
        {{$posts->links()}}
      @else
        <p>No Posts found</p>
      @endif
      </div>
  
    </main>
    <!-- page-content" -->
  </div>  
@endsection