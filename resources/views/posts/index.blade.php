@extends('layouts.app')

@section('content')
  <h1>Posts</h1>
  @if(count($posts) > 0)
    @foreach($posts as $post)
    <div class="card mb-5">
        <div class="card-header">
          <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
          <small>written on {{$post->created_at}} by {{$post->user->first_name}}</small>
        </div>
        <div class="card-body">
        </div>
    </div>          
    @endforeach
    {{$posts->links()}}
  @else
    <p>No Posts found</p>
  @endif
@endsection