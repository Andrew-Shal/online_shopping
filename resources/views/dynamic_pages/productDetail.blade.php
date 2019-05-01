@extends('layouts.app')

@section('content')
  
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">

				@include('inc.messages')

				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							

							<div class="product-preview">
								<img src="{{$featured_photo_link}}" alt="">
							</div>

             
              @if(count($product_photos)> 0)
                      <?php $number = 1; ?>
                      @foreach ($product_photos as $photo)

                        <div class="product-preview">
                          <img src="/storage/users/{{$product->user->id}}/product_images/{{$photo->photo}}" alt="">
                        </div>
                      
                        <?php $number++ ?> 
                      @endforeach
              @endif

						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">

							<div class="product-preview">
								<img src="{{$featured_photo_link}}" alt="">
              </div>
              
              @if(count($product_photos)> 0)
                      <?php $number = 1; ?>
                      @foreach ($product_photos as $photo)

                        <div class="product-preview">
                          <img src="/storage/users/{{$product->user->id}}/product_images/{{$photo->photo}}" alt="">
                        </div>
                      
                        <?php $number++ ?> 
                      @endforeach
              @endif

							
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name"><?php echo $product->name; ?></h2>
	
							<div>
								<h3 class="product-price">Price: $<?php echo $product->current_price; ?> </h3> <br>
								<p class="product-name">Amount In Stock: <?php echo $product->qty; ?>  </p>
							</div>
							<p><h3>Description: </h3>
								<?php echo $product->description; ?>
							</p>

							<div class="product-options">
								<label>
									<?php echo $product->total_views; ?> total views 
								</label>
				
							</div>

							<div class="add-to-cart">
                  <form id="addToCart" action="{{ route('cart.store') }}" method="POST">
                      {{ csrf_field() }}
                      <input type="hidden" name="id" value="{{$product->id}}">
                      <!--<a href="/rating/{{$product->id}}"><i class="fa fa-plus-square"></i>Rate</a>-->
                  </form>
                  
                  <a href="{{ route('cart.store') }}" class="btn btn-danger" onclick="event.preventDefault();$(this).parent().children('form#addToCart').submit();"><i class="fa fa-shopping-cart"></i> add to cart</a>
    
							</div>

						</div>
          </div>
					
					
					<!-- /Product details -->
					<!-- Product tab -->
					<div class="col-md-12">
							<div id="product-tab">
								<!-- product tab nav -->
								<ul class="nav nav-tabs" role="tablist" style="display:block;">
									<li><a data-toggle="tab" href="#tab1">Description</a></li>
									<li><a data-toggle="tab" href="#tab2">Condition</a></li>
									<li><a data-toggle="tab" href="#tab3">Return Policy</a></li>
									<li><a data-toggle="tab" href="#tab4">Reviews</a></li>
								</ul>
								<!-- /product tab nav -->
	
								<!-- tab1 -->
								<div class="tab-content">
									<!-- tab1  -->
									<div id="tab1"  class="tab-pane fade" role="tabpanel" class="tab-pane fade active">
										<div class="row">
											<div class="col-md-12">
													<p><?php 
													
														$nocontentmsg = 'It seem like theres no product description, you may contact the seller at the address <a style="text-decoration:underline;color:blue;" href="mailto:'.$product->user->email.'">'.$product->user->email.'</a> for more information.';
	
														echo strlen(trim($product->description," ")) > 0 ? $product->description : $nocontentmsg;
															 
													?></p>
											</div>
										</div>
									</div>
									<!-- /tab1  -->
	
									<!-- tab2  -->
									<div id="tab2" class="tab-pane fade in">
										<div class="row">
											<div class="col-md-12">
													<p><?php 
													
														$nocontentmsg = 'It seem like theres no product condition, you may contact the seller at the address <a style="text-decoration:underline;color:blue;" href="mailto:'.$product->user->email.'">'.$product->user->email.'</a> for more information.';
	
														echo strlen(trim($product->condition," ")) > 0 ? $product->condition : $nocontentmsg;
															 
													?></p>
											</div>
										</div>
									</div>
									<!-- /tab2  -->

									<!-- tab3  -->
									<div id="tab3" class="tab-pane fade in">
										<div class="row">
											<div class="col-md-12">
												<p><?php 
													
													$nocontentmsg = 'It seem like theres no return policy, you may contact the seller at the address <a style="text-decoration:underline;color:blue;" href="mailto:'.$product->user->email.'">'.$product->user->email.'</a> for more information.';

													echo strlen(trim($product->return_policy," ")) > 0 ? $product->return_policy : $nocontentmsg;
														 
												?></p>
											</div>
										</div>
									</div>
									<!-- /tab3  -->
	
									<!-- tab3  -->
									<div id="tab4" class="tab-pane fade in">
										<div class="row">
											<!-- Rating -->
											<div class="col-md-3">
												<div id="rating">
														<h5>Average Rating</h5>
														<hr>
														<small>out of ({{count($product->ratings()->get())}}) rating(s)</small>
														<div class="rating-avg">
															<span>{{$avg_rating}}</span>
															<div class="rating-stars">
															@for($i=0; $i < round($avg_rating,0);$i++)
																<i class="fa fa-star"></i>
															@endfor
														</div>
													</div>
													
												</div>
											</div>
											<!-- /Rating -->
	
											<!-- Reviews -->
											<div class="col-md-5">
												<div id="reviews">
													<h5>Recent Reviews</h5>
													<hr>
													<ul class="reviews">
														<li>
															<div class="review-body">
																@if(count($product->ratings) > 0)
																@foreach($product->ratings()->get() as $rating)

																<div class="card mb-4">
																	<div class="card-header">
																		<h6>{{$rating->user->first_name. ' ' . $rating->user->last_name}}
																				<div class="rating-avg" style="display:inline;font-size:10px;">
																						<div class="rating-stars">
																						@for($i=0; $i < $rating->rating;$i++)
																							<i class="fa fa-star"></i>
																						@endfor
																					</div>
																				</div>
																			
																				<small style="float:right;">{{$rating->created_at}}</small>
																		<h6>
																	</div>
																	<div class="card-body">
																		<p class="card-text">{{$rating->review }}</p>
																	</div>
																</div>
																@endforeach
																@else
																		<p>There are no reviews for this product</p>
																@endif																
																</p>
															</div>
														</li>
													</ul>
												</div>
											</div>
											<!-- /Reviews -->
	
											<!-- Review Form -->
											<div class="col-md-4">
												<div id="review-form">
														@include('dynamic_pages.ratings.create')
												</div>
											</div>
											<!-- /Review Form -->
										</div>
									</div>
									<!-- /tab3  -->
								</div>
								<!-- /product tab content  -->
							</div>
						</div>
						<!-- /product tab -->

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

@endsection

@section('scripts')

  <link type="text/css" rel="stylesheet" href="{{ asset('storage/assets/css/slick.css') }}"/> 
  <link type="text/css" rel="stylesheet" href="{{ asset('storage/assets/css/slick-theme.css') }}"/>
  <link type="text/css" rel="stylesheet" href="{{ asset('storage/assets/css/nouislider.min.css') }}"/>
  <link type="text/css" rel="stylesheet" href="{{ asset('storage/assets/css/style.css') }}"/>

  <script src="{{asset('storage/assets/js/slick.min.js')}}"></script>
  <script src="{{asset('storage/assets/js/nouislider.min.js')}}"></script>
  <script src="{{asset('storage/assets/js/jquery.zoom.min.js')}}"></script>
  <script src="{{asset('storage/assets/js/main.js')}}"></script>


	<script>
	// Select ratings tabs to be opened when page loads
	var $desc = $('.nav-tabs a:last')
	$desc.parent().addClass('active');
	$desc.tab('show');

	//remove class active from tab navs when another tab is selected 
	$('.nav-tabs a').click(function(){
		$currentElem = $(this);
		$('.nav-tabs a').each(function(){
			$(this) != $currentElem ? $(this).parent().removeClass('active') : $(this).parent('li').addClass('active');
		});
	});
</script>

@endsection