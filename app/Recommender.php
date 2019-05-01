<?php

namespace App;

use App\Rating;

class Recommender
{

  private $matrix = array();
  public $forUser;


  public function recommendationOnViewHistory()
  { }

  public function recommendationOnRatingsForUser($ratings, $user_id)
  {
    $this->forUser = $user_id;

    foreach ($ratings as $rating) {
      $rating_id = 'p' . (string)$rating->product->id;
      $this->matrix[$rating->user->id][$rating_id] = $rating->rating;
      $this->matrix[$rating->user->id][$rating->product->name] = $rating->rating;
    };




    return $this->getRecommendation($this->forUser);
  }

  public function getMatrix()
  {
    return $this->matrix;
  }

  /**
   * 
   * all protected for internal use only
   * 
   */
  protected function similarity_distance($person1, $person2)
  {
    $similar = array();
    $sum = 0;

    if (!isset($this->matrix[$person1])) {
      return;
    }
    foreach ($this->matrix[$person1] as $key => $value) {
      if (array_key_exists($key, $this->matrix[$person2])) {
        $similar[$key] = 1;
      }
    }
    if ($similar == 0) {
      return 0;
    }

    foreach ($this->matrix[$person1] as $key => $value) {
      if (array_key_exists($key, $this->matrix[$person2])) {
        $sum = $sum + pow($value - $this->matrix[$person2][$key], 2);
      }
    }

    return 1 / (1 + sqrt($sum));
  }

  protected function getRecommendation($person)
  {
    $total = array();
    $simsums = array();
    $ranks = array();

    foreach ($this->matrix as $otherPerson => $value) {
      if ($otherPerson != $person) {
        $sim = $this->similarity_distance($person, $otherPerson);
        if (!isset($this->matrix[$person])) {
          continue;
        }
        foreach ($this->matrix[$otherPerson] as $key => $value) {

          if (!array_key_exists($key, $this->matrix[$person])) {
            if (!array_key_exists($key, $total)) {
              $total[$key] = 0;
            }

            $total[$key] += $this->matrix[$otherPerson][$key] * $sim;

            if (!array_key_exists($key, $simsums)) {
              $simsums[$key] = 0;
            }

            $simsums[$key] += $sim;
          }
        }
      }
    }

    foreach ($total as $key => $value) {
      $ranks[$key] = $value / $simsums[$key];
    }
    array_multisort($ranks, SORT_DESC);
    //return $ranks;
    return array_slice($ranks, 0, 30);
  }
}
