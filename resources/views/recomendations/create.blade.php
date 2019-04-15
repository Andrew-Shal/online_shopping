<?php 
/**
 * 
 * Recommendation Engine - Collaborative filtering based on user ratings
 * 
 * Not appropriate for large data sets
 * 
 * @matrix maps key value [user => [movie => movie rating]] for each user
 * 
 * 
 */

  //TEST STAGE

  $statement = $db->prepare("SELECT * from products");
  $statement->execute(); 
  $movies = $statement->fetchAll(PDO::FETCH_ASSOC);

  $matrix = array();


  foreach($movies as $movie){

    $statement = $db->prepare("SELECT first_name from tbl_user where id=?");
    $statement->execute(array($movie["user_id"]));
    $username = $statement->fetchAll(PDO::FETCH_ASSOC);

    $matrix[$username[0]['first_name']][$movie['item_name']] = $movie['_rating'];
    ?>
    <pre> <?php
    var_dump($matrix);  ?>
    </pre>
    <?php
  }


  //test for all users in user table
  $statement = $db->prepare("SELECT first_name from tbl_user");
  $statement->execute();
  $users = $statement->fetchAll(PDO::FETCH_ASSOC);

  //start of building recommendation table html

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

  //end of building recommendation table html

  //start of building ratings table html
  
  echo "<div class='container'><div class='row mt-4'><div class='col-md-6 offset-md-3'><h1>Ratings</h1></div></div><div class='row'><div class='col-md-6 offset-md-3'>";

  foreach($matrix as $cust=>$value){
    echo "<div class='row mt-4'><div class='col-md-4' style='border:1px solid black;'><h3>" . $cust ."</h3></div></div>";
    echo "<div class='row'><div class='col-md-6' style='border:1px solid black;'><h5>Movie Name</h5></div><div class='col-md-6' style='border:1px solid black;'><h5>Movie Rating</h5></div></div>";
    foreach($value as $movie=>$rating){
      echo(   "<div class='row' style='border:1px solid black;'>" .
              "<div class='col-md-6'>". $movie ."</li></div>" .
              "<div class='col-md-6'>". $rating ."</li></div>" .
              "</div>");
    }
  }
  echo "</div></div></div>";

  //end of building recommendation table html
  


  function similarity_distance($matrix, $person1, $person2){
      $similar = array();
      $sum = 0;
      if(!isset($matrix[$person1])){
        return;
      }
      foreach($matrix[$person1] as $key=>$value){
        if(array_key_exists($key,$matrix[$person2])){
          $similar[$key] = 1;
        }
      }
        if($similar == 0){
          return 0;
        }

        foreach($matrix[$person1] as $key=>$value){
          if(array_key_exists($key,$matrix[$person2])){
            $sum = $sum+pow($value-$matrix[$person2][$key], 2);
          }
        }

        return 1/(1+sqrt($sum));

  }

  function getRecommendation($matrix, $person){
    $total = array();
    $simsums = array();
    $ranks =array();

    foreach($matrix as $otherPerson=>$value){
      if($otherPerson != $person){
        $sim = similarity_distance($matrix, $person, $otherPerson);
        if(!isset($matrix[$person])){
          continue;
        }
        foreach($matrix[$otherPerson] as $key => $value){

          if(!array_key_exists($key,$matrix[$person])){
            if(!array_key_exists($key, $total)){
              $total[$key] = 0; 
            }

            $total[$key] += $matrix[$otherPerson][$key] * $sim;

            if(!array_key_exists($key, $simsums)){
              $simsums[$key] = 0;
            }

            $simsums[$key] += $sim;
          }
        } 
      }
    }

    foreach($total as $key=>$value){
      $ranks[$key] = $value/$simsums[$key];
    }
    array_multisort($ranks,SORT_DESC);
    return $ranks;
  }