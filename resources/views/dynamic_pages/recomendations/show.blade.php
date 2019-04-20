@extends('layouts.app')
@section('content')
  <?php

  echo "<div class='container'><div class='row'><div class='col-md-6 offset-md-3'><h1>Recommendations</h1></div></div><div class='row'><div class='col-md-6 offset-md-3'>";

  foreach($users as $user){

  $recommendations = getRecommendation($matrix,$user['first_name']);
  echo "<div class='row mt-4'><div class='col-md-4' style='border:1px solid black;'><b>" . $user['first_name'] ."</b></div></div>";

    foreach($recommendations as $key=>$value){
      echo(   "<div class='row' style='border:1px solid black;'>" .
              "<div class='col-md-6'>". $key ."</li></div>" .
              "<div class='col-md-6'>". $value ."</li></div>" .
              "</div>");
    }
  }
  echo "</div></div></div>";
  echo "<br><br><br>";
  
  ?>
  
  @endsection
  
  


