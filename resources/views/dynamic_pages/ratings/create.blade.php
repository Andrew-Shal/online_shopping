  
   <h5>Submit a rating/review</h5>
   <hr>
   {!! Form::open(['action' => 'RatingController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'review-form']) !!}
    @csrf
      <!--rating-->
      <div class="input-rating">
          <small><b>Add Rating: </b></small>
          <div class="stars">
            <input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
            <input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
            <input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
            <input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
            <input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
          </div>
      </div>    

      <!--review-->
      <div class="form-group">
          <small><b>Add a review: </b></small>
          {{Form::textarea('review', '', ['class' => 'form-control input', 'placeholder'=>'Add a Review', 'rows' => '2'])}}
      </div>

      <!--product id-->
      <input type="hidden" name="p_id" value="{{$product->id}}">
        
        {{Form::submit('Submit',['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}