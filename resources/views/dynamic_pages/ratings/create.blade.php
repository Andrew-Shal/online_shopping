@extends('layouts.app')

@section('content')
  <h1>Add Rating</h1>
  {!! Form::open(['action' => 'RatingController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
  @csrf
    <div class="form-group">
        {{Form::label('rating', 'Rate')}}
        {{Form::text('rating', '', ['class' => $errors->has("rating") ? "form-control is-invalid" : "form-control", 'placeholder'=>'Rating', 'value'=> old("rating") ])}}
    </div>
    <div class="form-group">
        {{Form::label('review', 'Review')}}
        {{Form::textarea('review', '', ['class' => 'form-control', 'placeholder'=>'Review'])}}
      </div>
      <input type="hidden" name="p_id" value="{{$pid}}">
      
      {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
  {!! Form::close() !!}
@endsection
