<?php
$count = count($hotels);
 ?>
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
$parms=explode('?',url()->previous());
// $parms=explode('?',Request::fullUrl());
// print_r($parms[1]); die;
 ?>
 <style>
 .rating-star {
  margin-bottom: 20px;
}
 </style>
<div class="listing-item">
  <article class="geodir-category-listing fl-wrap">
    <div class="geodir-category-img">
      <a href="{{url('hotel-detail/'.$hotel->hid.'?'.$parms[1])}}">
        @if($image !="")
        <img src="{{url($hotel_image)}}" alt="" style="height:270px; overflow:hidden;">
        @else
        <img src="{{asset('frontend-assets/no-image.jpeg')}}" alt="" style="height:270px;">
        @endif
      </a>
      <div class="listing-avatar"><a href="author-single.html"><img src="images/avatar/1.jpg" alt=""></a>
      <span class="avatar-tooltip">Added By  <strong>Alisa Noory</strong></span>
    </div>
    <!-- <div class="sale-window">Sale 20%</div> -->
    <!-- <div class="sale-window big-sale">Sale 50%</div> -->
    <div class="geodir-category-opt">
    @if($hotel->rate == '2*')
    <div class="listing-rating card-popup-rainingvis rating-star" data-starrating3="2"><i class='fas fa-star'></i><i class='fas fa-star'></i></div>
    @elseif($hotel->rate == '3*')
    <div class="listing-rating card-popup-rainingvis rating-star" data-starrating3="3"><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i></div>
    @elseif($hotel->rate == '4*')
    <div class="listing-rating card-popup-rainingvis rating-star" data-starrating3="4"><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i></div>
    @else
    <div class="listing-rating card-popup-rainingvis rating-star" data-starrating3="5"><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i><i class='fas fa-star'></i></div>
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
        <h3 class="title-sin_map"><a href="{{url('hotel-detail/'.$hotel->hid.'?'.$parms[1])}}">{{$hotel->name}}</a></h3>
        <div class="geodir-category-location fl-wrap"><a href="#" class="map-item"><i class="fas fa-map-marker-alt"></i> {{Str::limit($hotel->address,80)}}</a></div>
      </div>
    </div>
    <div class="" style="height:140px;">
      <p>{{Str::limit($decription,115)}}</p>
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
        <a href="javascript:void(0);" class="single-map-item" data-newlatitude="{{Booking::DMStoDD($hotel->latitude)}}" data-newlongitude="{{Booking::DMStoDD($hotel->longitude)}}"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map</span></a>
        <a href="#" class="geodir-js-favorite"><i class="fal fa-heart"></i><span class="geodir-opt-tooltip">Save</span></a>
        <!-- <a href="#" class="geodir-js-booking"><i class="fal fa-exchange"></i><span class="geodir-opt-tooltip">Find Directions</span></a> -->
      </div>
    </div>
  </div>
</article>
</div>
@endforeach
<!-- listing-item end -->
@if($count >=10)
<div id="remove-row" class="">
  <button id="btn-more" data-id="{{$hotel->hid}}" class="load-more-button" href="javascript:void(0)">Load more <i class="fal fa-spinner" style="display:none;"></i> </button>
</div>
@endif
