@extends('frontend.layouts.master')
@section('content')
<script>
var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1)

 var y = 0;
 function passvalue(index){
	 // alert(index);
	 y = index;
 }
</script>
<style>
	.discount {
		text-align: left;
	}
  .show-city .nice-select .list {
    max-height: 300px;
  }
	.room-no {
		float: left;
    width: 100%;
    border: 1px solid #eee;
    padding: 12px 32px 12px 33px;
    border-radius: 6px;
    background: #F7F9FB;
    height: 42px;
    line-height: 42px;
	}
	.rating-star {
		margin-bottom: 20px;
	}
	.calc-div {
		text-align: left;
	}
	.calc-div h4{
	 color: #46A5DC;
	}
	.calc-div h4 span{
		color: #696363;
 		float: right;
	}
	.text-muted {
		color: #acacac;
	}
  .calc-div .pricing{
    color:#494747;
    text-align:right;
    padding-bottom: 0px;
    padding-right: 10px;
    font-weight: 700;
  }

  /* Track */
  /* width */
  ::-webkit-scrollbar {
    width: 8px;
  }

  /* Track */
  ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px grey;
    border-radius: 10px;
  }

  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #3aaced;
    border-radius: 10px;
  }

  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #3aaced;
  }

</style>
<!--  wrapper  -->
<div id="wrapper">
<?php
$parms=explode('?',Request::fullUrl());
// print_r($city); die;
// print_r(count($parms)); die;
?>
	<!-- content-->
	<div class="content">
		<!--  section  -->
		<section class="parallax-section single-par" data-scrollax-parent="true">
			<div class="bg par-elem "  data-bg="http://easybook.kwst.net/images/bg/26.jpg" data-scrollax="properties: { translateY: '30%' }"></div>
			<div class="overlay"></div>
			<div class="container">
				<div class="section-title center-align big-title">
					<div class="section-title-separator"><span></span></div>
					<h2><span>@if($city){{$city}} @else All @endif Hotels</span></h2>

					<span class="section-separator"></span>
					<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet fermentum sem.</h4>
				</div>
			</div>
			<div class="header-sec-link">
				<div class="container"><a href="#sec1" class="custom-scroll-link color-bg"><i class="fal fa-angle-double-down"></i></a></div>
			</div>
		</section>
		<!--  section  end-->
		<div class="breadcrumbs-fs fl-wrap">
			<div class="container">
				<div class="breadcrumbs fl-wrap"><a href="#">Home</a><a href="#">Listing </a><span>{{$city}}</span></div>
			</div>
		</div>
		<!--  section-->
		<section class="grey-blue-bg small-padding" id="sec1">
			<div class="container">
				<div class="row">
					<!--filter sidebar -->
					<div class="col-md-4">
						<div class="mobile-list-controls fl-wrap">
							<div class="mlc show-list-wrap-search fl-wrap"><i class="fal fa-filter"></i> Filter</div>
						</div>
						<div class="fl-wrap filter-sidebar_item fixed-bar">
							<form class="" action="{{url('/listing')}}" method="get">
								{{csrf_field()}}

							<div class="filter-sidebar fl-wrap lws_mobile">
								<!--col-list-search-input-item -->
								<div class="col-list-search-input-item in-loc-dec fl-wrap not-vis-arrow">
									<label>City/Category</label>
									<?php
									$citys =$city;
									 //print_r(Booking::getcities()[76]->name.' '.$city); die;
									?>
									<div class="listsearch-input-item show-city">
										<select data-placeholder="Your City" name="city" id="city" class="chosen-select" >
											<option value="">All Cities</option>
											@foreach(Booking::getcities() as $cities)
											<option value="{{trim($cities->name)}}" {{ trim($cities->name) == trim($city) ? 'selected="selected"' : '' }}>{{$cities->name}}</option>
											@endforeach
										</select>
									</div>
								</div>

								<!--col-list-search-input-item end-->
								<!--col-list-search-input-item -->
								<div class="col-list-search-input-item fl-wrap location autocomplete-container">
									<label>Number Of Beds</label>
									<!-- <input type="text" placeholder="Destination or Hotel Name" class="autocomplete-input" id="autocompleteid3" value=""/>
									<a href="#"><i class="fal fa-dot-circle"></i></a> -->
									<div class="quantity-item" style="width: 100%;">
										<div class="quantity" style="width: 100%;">
												<input type="number" name="bed" min="1" max="5" step="1" @if($bed !="") value="{{$bed}}" @else value="1" @endif>
										</div>
									</div>
								</div>
								<!--col-list-search-input-item end-->
								<!--col-list-search-input-item -->
								<div class="col-list-search-input-item in-loc-dec date-container  fl-wrap">
									<label>Date In-Out </label>
									<span class="header-search-input-item-icon"><i class="fal fa-calendar-check"></i></span>
									<input type="text"   placeholder="When" name="dates"   value="{{$date}}"/>
									<!-- <input type="text" placeholder="When" name="header-search"   value=""/> -->
								</div>
								<!--col-list-search-input-item end-->
								<!--col-list-search-input-item -->

								<div class="col-list-search-input-item fl-wrap">
									<div class="quantity-item">
										<label>Rooms</label>
										<div class="quantity">
											<input type="number" name="room" min="1" max="5" step="1" @if($totalroom !="") value="{{$totalroom}}" @else value="1" @endif>
										</div>
									</div>

									<div class="quantity-item">
										<label>Adults</label>
										<div class="quantity">
											<input type="number" name="adult" min="1" max="5" step="1" @if($adult !="") value="{{$adult}}" @else value="1" @endif>
										</div>
									</div>
									<div class="quantity-item">
										<label>Children</label>
										<div class="quantity sidebar-children">
											<input type="number" name="child" min="0" max="5" step="1"  @if($child !="") value="{{$child}}" @else value="1" @endif id="total-child">
										</div>
									</div>

									<!-- Children Age -->
									<div class="field_wrapper_sidebar" id="field_wrapper_sidebar">
										@if($age !=null)
										@foreach($age as $key => $ages)
										<!-- <?php $key=$key+1; ?> -->
										<div class="quantity-item age-items child-{{$key}}">'
											<div class="quantity">
												<select name="age[]">
													<option value="">0 years</option>
													<option value="1" {{1 == $ages ? 'selected="selected"':''}}>1 years</option>
													<option value="2" {{2 == $ages ? 'selected="selected"':''}}>2 years</option>
													<option value="3" {{3 == $ages ? 'selected="selected"':''}}>3 years</option>
													<option value="4" {{4 == $ages ? 'selected="selected"':''}}>4 years</option>
													<option value="5" {{5 == $ages ? 'selected="selected"':''}}>5 years</option>
													<option value="6" {{6 == $ages ? 'selected="selected"':''}}>6 years</option>
													<option value="7" {{7 == $ages ? 'selected="selected"':''}}>7 years</option>
													<option value="8" {{8 == $ages ? 'selected="selected"':''}}>8 years</option>
													<option value="9" {{9 == $ages ? 'selected="selected"':''}}>9 years</option>
													<option value="10" {{10 == $ages ? 'selected="selected"':''}}>10 years</option>
													<option value="11" {{11 == $ages ? 'selected="selected"':''}}>11 years</option>
													<option value="12" {{12 == $ages ? 'selected="selected"':''}}>12 years</option>
													<option value="13" {{13 == $ages ? 'selected="selected"':''}}>13 years</option>
													<option value="14" {{14 == $ages ? 'selected="selected"':''}}>14 years</option>
													<option value="15" {{15 == $ages ? 'selected="selected"':''}}>15 years</option>
												</select>
											</div>
										</div>
										<script>passvalue('{{$key}}');</script>
										@endforeach
										@endif
									</div>
									<!-- Children Age -->
								</div>
								<!--col-list-search-input-item end-->
								<!--col-list-search-input-item -->
								<div class="col-list-search-input-item in-loc-dec fl-wrap not-vis-arrow">
									<label>Room Type</label>
									<div class="listsearch-input-item show-city">
										<select data-placeholder="City" name="room_type" class="chosen-select" >
											<option value="">All Rooms</option>
											@foreach(Booking::getRoomType() as $room)
											<option value="{{trim($room->unit_type_en)}}" {{ trim($room->unit_type_en) == trim($room_type) ? 'selected="selected"' : '' }}>{{$room->unit_type_en}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<!--col-list-search-input-item end-->
								<!--col-list-search-input-item -->
								<div class="col-list-search-input-item fl-wrap">
									<div class="range-slider-title">Price range</div>
									<div class="range-slider-wrap fl-wrap">
										<input class="range-slider" name="price" data-from="50" data-to="400" data-step="30" data-min="30" data-max="1000" data-prefix="$">
									</div>
								</div>
								<!--col-list-search-input-item end-->
								<!--col-list-search-input-item -->
								<div class="col-list-search-input-item fl-wrap">
									<label>Star Rating</label>
									<?php
									// print_r($rating); die;
									 ?>
									<div class="search-opt-container fl-wrap">
										<!-- Checkboxes -->
										<ul class="fl-wrap filter-tags">
											<li class="five-star-rating">
												<input id="check-aa2" type="checkbox" name="rating[]" value="5*" @if($rating !=null) @foreach($rating as $rate) {{ '5*' == $rate ? 'checked="checked"' : ''  }} @endforeach @endif>
												<label for="check-aa2"><span class="listing-rating card-popup-rainingvis" data-starrating2="5"><span>5 Stars</span></span></label>
											</li>
											<li class="four-star-rating">
												<input id="check-aa3" type="checkbox" name="rating[]" value="4*" @if($rating !=null) @foreach($rating as $rate) {{ '4*' == $rate ? 'checked="checked"' : ''  }} @endforeach @endif>
												<label for="check-aa3"><span class="listing-rating card-popup-rainingvis" data-starrating2="5"><span>4 Star</span></span></label>
											</li>
											<li class="three-star-rating">
												<input id="check-aa4" type="checkbox" name="rating[]" value="3*" @if($rating !=null) @foreach($rating as $rate) {{ '3*' == $rate ? 'checked="checked"' : ''  }} @endforeach @endif>
												<label for="check-aa4"><span class="listing-rating card-popup-rainingvis" data-starrating2="5"><span>3 Star</span></span></label>
											</li>
										</ul>
										<!-- Checkboxes end -->
									</div>
								</div>
								<!--col-list-search-input-item end-->
								<!--col-list-search-input-item -->

								<!-- Amenities -->
								<!-- <div class="col-list-search-input-item fl-wrap">
									<label>Facility</label>
									<div class="search-opt-container fl-wrap">
										<ul class="fl-wrap filter-tags half-tags">
											<li>
												<input id="check-aaa5" type="checkbox" name="check" checked>
												<label for="check-aaa5">Free WiFi</label>
											</li>
											<li>
												<input id="check-bb5" type="checkbox" name="check">
												<label for="check-bb5">Parking</label>
											</li>
											<li>
												<input id="check-dd5" type="checkbox" name="check">
												<label for="check-dd5">Fitness Center</label>
											</li>
										</ul>
										<ul class="fl-wrap filter-tags half-tags">
											<li>
												<input id="check-ff5" type="checkbox" name="check">
												<label for="check-ff5">Airport Shuttle</label>
											</li>
											<li>
												<input id="check-cc5" type="checkbox" name="check" checked>
												<label for="check-cc5">Non-smoking Rooms</label>
											</li>
											<li>
												<input id="check-c4" type="checkbox" name="check" checked>
												<label for="check-c4">Air Conditioning</label>
											</li>
										</ul>
									</div>
								</div> -->
								<!-- Amenities End -->

								<!--col-list-search-input-item end-->
								<!--col-list-search-input-item  -->
								<div class="col-list-search-input-item fl-wrap">
									<button class="header-search-button" type="submit" >Search <i class="far fa-search"></i></button>
								</div>
								<!--col-list-search-input-item end-->
							</div>
						</form>
						</div>
					</div>
					<!--filter sidebar end-->
					<!--listing -->
					<div class="col-md-8">
						<!--col-list-wrap -->
						<div class="col-list-wrap fw-col-list-wrap post-container">
							<!-- list-main-wrap-->
							<div class="list-main-wrap fl-wrap card-listing">
								<!-- list-main-wrap-opt-->
								<div class="list-main-wrap-opt fl-wrap">
									<div class="list-main-wrap-title fl-wrap col-title">
										<h2>All Hotels</h2>
									</div>
									<!-- price-opt-->
									<!-- <div class="price-opt">
										<span class="price-opt-title">Sort results by:</span>
										<div class="listsearch-input-item">
											<select data-placeholder="Popularity" class="chosen-select no-search-select" >
												<option>Popularity</option>
												<option>Average rating</option>
												<option>Price: low to high</option>
												<option>Price: high to low</option>
											</select>
										</div>
									</div> -->
									<!-- price-opt end-->
									<!-- price-opt-->
									<div class="grid-opt">
										<ul>
											<li><span class="two-col-grid act-grid-opt"><i class="fas fa-th-large"></i></span></li>
											<li><span class="one-col-grid"><i class="fas fa-bars"></i></span></li>
										</ul>
									</div>
									<!-- price-opt end-->
								</div>
								<!-- list-main-wrap-opt end-->
								<!-- listing-item-container -->
									<div class="listing-item-container init-grid-items fl-wrap" id="show-hotel">
										<!-- listing-item  -->
										@foreach($hotels as $hotel)
										<?php
										$image = $hotel->photo_1;
										$image = substr($image,37);
										$hotel_image = url('http://tour2thailand.com/images/hotels'.$image);
										$decription='';
										if ($hotel->decription_en !='') {
											$decription =$hotel->decription_en->description;
										}
										// print_r($hotel_image); die;
										?>
										<div class="listing-item">
											<article class="geodir-category-listing fl-wrap">
												<div class="geodir-category-img">
													@if(count($parms) >1)
													<a href="{{url('hotel-detail/'.$hotel->hid.'?'.$parms[1])}}">
                            @if($image !="")
														<img src="{{url($hotel_image)}}" alt="" style="height:270px; overflow:hidden;">
														@else
														<img src="{{asset('frontend-assets/no-image.jpeg')}}" alt=""style="height:270px;">
														@endif
													</a>
                          @else
													<a href="{{url('hotel-detail/'.$hotel->hid)}}">
                            @if($image !="")
                            <img src="{{url($hotel_image)}}" alt="" style="height:270px; overflow:hidden;">
                            @else
                            <img src="{{asset('frontend-assets/no-image.jpeg')}}" alt=""style="height:270px;">
                            @endif
                          </a>
													@endif
													<div class="listing-avatar"><a href="author-single.html"><img src="images/avatar/1.jpg" alt=""></a>
														<span class="avatar-tooltip">Added By  <strong>Alisa Noory</strong></span>
													</div>
													<!-- <div class="sale-window">Sale 20%</div> -->
													<!-- <div class="sale-window big-sale">Sale 50%</div> -->
													<div class="geodir-category-opt">
													@if($hotel->rate == '2*')
													<div class="listing-rating card-popup-rainingvis rating-star" data-starrating2="2"></div>
													@elseif($hotel->rate == '3*')
													<div class="listing-rating card-popup-rainingvis rating-star" data-starrating2="3"></div>
													@elseif($hotel->rate == '4*')
													<div class="listing-rating card-popup-rainingvis rating-star" data-starrating2="4"></div>
													@else
													<div class="listing-rating card-popup-rainingvis rating-star" data-starrating2="5"></div>
													@endif
													<!-- <div class="rate-class-name">
													<div class="score"><strong>Very Good</strong>27 Reviews </div>
													<span>5.0</span>
												</div> -->
											</div>
										</div>
										<div class="geodir-category-content fl-wrap title-sin_item">
											<div class="geodir-category-content-title fl-wrap">
												<div class="geodir-category-content-title-item">
													<h3 class="title-sin_map">@if(count($parms) >1)<a href="{{url('hotel-detail/'.$hotel->hid.'?'.$parms[1])}}">@else <a href="{{url('hotel-detail/'.$hotel->hid)}}">@endif {{$hotel->name}}</a></h3>
													<div class="geodir-category-location fl-wrap"><a href="#" class="map-item"><i class="fas fa-map-marker-alt"></i> {{Str::limit($hotel->address,80)}}</a></div>
												</div>
											</div>
											<div class="row"style="max-height: 246px;overflow-y: scroll">
                        <div class="calc-div" style="height:250px; ">
                              @foreach($hotel->rooms as $room)
                                @if($room->possibilities !="")
                                  @foreach($room->possibilities as $possbile)
                                  @if($possbile['bed_price'] !="")
                                  <?php
                                    // print_r($possbile['message']);die;
                                    ?>
                                    <h4>{{$room->name}} </h4>
                                      <p class="pricing" style=""><span>{{$possbile['bed_price']}} USD
                                      @if($possbile['abf_ch']!='') + {{$possbile['abf_ch']}} USD (ABF child)  @endif
                                      @if($possbile['extra_bed_ch']!='') + {{$possbile['extra_bed_ch']}} USD (Extrabed child)  @endif
                                      X {{$possbile['days']}} Nights</span> </p>
                                     <p style="padding-bottom:0;padding-right:10px;">{!! $possbile['message'] !!} <span style="float: right;color:#46a5dc;font-size: 15px;font-weight: 800;">{{$possbile['total']}} USD</span></p>
                                  @endif
                                  @endforeach
                                @endif
                              @endforeach
  												<div class="gala-sec">
  													<?php
  													$gala =Booking::getGalaDinner($hotel->hid,$from_date,$to_date);
  													 ?>
  													 @if($gala !="")
  													<span>Gala Dinner {{$gala->date}} - adult:<b>{{$gala->price_ad}} USD</b> child: <b>{{$gala->price_ch}} USD</b> </span>
  													@endif
  												</div>
  											</div>
                      </div>
											<!-- <ul class="facilities-list fl-wrap">
												<li><i class="fal fa-wifi"></i><span>Free WiFi</span></li>
												<li><i class="fal fa-parking"></i><span>Parking</span></li>
												<li><i class="fal fa-smoking-ban"></i><span>Non-smoking Rooms</span></li>
												<li><i class="fal fa-utensils"></i><span> Restaurant</span></li>
											</ul> -->
											<div class="geodir-category-footer fl-wrap">
												<div class="discount">@if($hotel->discount) Discount <span style="color: #f9b90f;">{{$hotel->discount}}%</span>@endif</div>
												<div class="geodir-category-price">Awg/Night <span>$ {{$hotel->low_rate}}</span></div>
												<div class="geodir-opt-list">

													@if($hotel->latitude)
													<a href="#" class="single-map-item" data-newlatitude="{{Booking::DMStoDD($hotel->latitude)}}" data-newlongitude="{{Booking::DMStoDD($hotel->longitude)}}"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map</span></a>
													@endif
													<a href="#" class="geodir-js-favorite"><i class="fal fa-heart"></i><span class="geodir-opt-tooltip">Save</span></a>
													<!-- <a href="#" class="geodir-js-booking"><i class="fal fa-exchange"></i><span class="geodir-opt-tooltip">Find Directions</span></a> -->
												</div>
											</div>
										</div>
									</article>
								</div>
								@endforeach

@if(count($hotels)>=10)
<div id="remove-row" class="">
	<button id="btn-more" data-id="{{$hotel->hid}}" class="load-more-button" href="javascript:void(0)">Load more <i class="fal fa-spinner" style="display:none;"></i> </button>
</div>
@endif
</div>
<!-- listing-item-container end-->

</div>
	<!-- list-main-wrap end-->
</div>
<!--col-list-wrap end -->
</div>
<!--listing  end-->
</div>
<!--row end-->
</div>
<div class="limit-box fl-wrap"></div>
</section>
</div>
<!-- content end-->
</div>
<!--wrapper end -->
@endsection
@section('script')
<script>
$(document).ready(function(){
	 $(document).on('click','#btn-more',function(){
			 var id = $(this).data('id');
			 var all_data = <?php echo $all_data; ?>;

			 $(".fa-spinner").show();
			 $.ajax({
					 url : '{{ url("listing-ajax") }}',
					 method : "POST",
					 data : {id:id,data:all_data,_token:"{{csrf_token()}}"},
					 dataType : "text",
					 success : function (data)
					 {
							if(data != '')
							{
									$('#remove-row').remove();
									$('#show-hotel').append(data);
							}
							else
							{
									$('#btn-more').html("No Data");
							}
							$('#gifid').hide();

					 }
			 });
		 // }
	 });
 });

$(document).ready(function(){
 var maxField = 5; //Input fields increment limitation
 var addButton = $('.sidebar-children .quantity-up'); //Add button selector
 var wrapper = $('.field_wrapper_sidebar'); //Input field wrapper
 $(addButton).click(function(){
		 //Check maximum number of input fields
	 if(y < maxField){
		 y++; //Increment field counter
		 // alert(x);

 var fieldHTML = '<div class="quantity-item age-items child-'+y+'">'+
									 '<div class="quantity">'+
										 '<select name="age[]">'+
											 '<option value="">0 years</option>'+
											 '<option value="1">1 years</option>'+
											 '<option value="2">2 years</option>'+
											 '<option value="3">3 years</option>'+
											 '<option value="4">4 years</option>'+
											 '<option value="5">5 years</option>'+
											 '<option value="6">6 years</option>'+
											 '<option value="7">7 years</option>'+
											 '<option value="8">8 years</option>'+
											 '<option value="9">9 years</option>'+
											 '<option value="10">10 years</option>'+
											 '<option value="11">11 years</option>'+
											 '<option value="12">12 years</option>'+
											 '<option value="13">13 years</option>'+
											 '<option value="14">14 years</option>'+
											 '<option value="15">15 years</option>'+
										 '</select>'+
									 '</div>'+
								 '</div>'; //New input field html

 $('#field_wrapper_sidebar').append(fieldHTML); //Add field html
}

});
 //Once remove button is clicked
 $(document).on('click', '.sidebar-children .quantity-down', function(e){
	 e.preventDefault();
	 // alert(x);
	 $('.child-'+y).remove();
	 // $(this).parent('div').remove(); //Remove field html
	 if (y>=0) {
		 y--; //Decrement field counter
	 }
 });
});
</script>
@endsection
