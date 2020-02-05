<style>
table {
border-collapse: collapse;
border-spacing: 0;
width: 100%;
border: 1px solid #ddd;
}

th, td {
text-align: left;
padding: 16px;
border: 1px solid #ddd;
}

tr:nth-child(even) {
background-color: #f2f2f2;
}
.table-price {
  width: 473px;
  overflow: auto;
}
.calc-div {
  text-align: left;
}
.calc-div h5{
  font-size: 12px;
 /* color: #46A5DC; */
}
.calc-div p{
  font-size: 12px;
 /* color: #46A5DC; */
}
.calc-div h4 span{
  color: #696363;
  float: right;
}
.text-muted {
  color: #acacac;
}
</style>
<!--ajax-modal-wrap -->
<div class="ajax-modal-wrap fl-wrap">
    <div class="ajax-modal-close"><i class="fal fa-times"></i></div>
    <!--ajax-modal-item-->
    <div class="ajax-modal-item fl-wrap">
        <div class="ajax-modal-media fl-wrap">
          <?php
          if ($room_photos !="") {
          $room_image = $room_photos->photo_1;
          $room_image = substr($room_image,37);
          $base_path_mod = str_replace('\\', '/', $room_image);
          $room_images = url('http://tour2thailand.com/images/hotels'.$base_path_mod);
          // print_r($room_image); die;
          }
           ?>
          <!-- <img src="http://easybook.kwst.net/images/gal/9.jpg" alt=""> -->
          @if($room_photos !='')
            <img src="{{url($room_images)}}" alt="">
            @else
            <!-- <img src="http://easybook.kwst.net/images/gal/9.jpg" alt=""> -->
            <img src="{{asset('frontend-assets/no-image.jpeg')}}" alt="">
            @endif
            <div class="ajax-modal-title">
                <div class="section-title-separator"><span></span></div>
                {{$room_info->name}}
            </div>
            <!-- <div class="ajax-modal-photos-btn dynamic-gal" data-dynamicPath="[{'src': 'http://easybook.kwst.net/images/gal/slider/1.jpg'}, {'src': 'http://easybook.kwst.net/images/gal/slider/4.jpg'},{'src': 'http://easybook.kwst.net/images/gal/9.jpg'}]">Photos (<span>3</span>)</div> -->
        </div>
        <div class="ajax-modal-list fl-wrap">
            <ul>
                <li>
                    <i class="fal fa-user-alt"></i>
                    <h5><span>{{$room_info->permitted_occupants}}</span> Persons</h5>
                </li>
                <li>
                    <i class="fal fa-chalkboard"></i>
                    <h5><span>{{$room_info->units_type}}</span></h5>
                </li>
                <li>
                    <i class="fal fa-bath"></i>
                    <h5><span>1</span> Bathroom</h5>
                </li>
                <!-- <li>
                    <i class="fal fa-hand-holding-usd"></i>
                    <h5><span>81$</span> / Per Night</h5>
                </li> -->
            </ul>
        </div>
        <div class="ajax-modal-details fl-wrap">
            <!--ajax-modal-details-box-->
            <div class="ajax-modal-details-box">
                <h3>Details</h3>
                @if($room_description_en)
                <p>{{$room_description_en->description}}</p>
                @endif
            </div>
            <!--ajax-modal-details-box end-->
            <!--ajax-modal-details-box-->
            <div class="ajax-modal-details-box">
              <h3>Price</h3>
              <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive table-price">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>From</th>
                          <th>To</th>
                          <th>Single</th>
                          <th>Double</th>
                          <th>Breakfast</th>
                          <th>Lunch</th>
                          <th>Dinner</th>
                          <th>Extra Bed</th>
                          <th>Extra Child Bed</th>
                          <th>Child Breakfast</th>
                          <th>Child Lunch</th>
                          <th>Child Dinner</th>
                          <th>Remarks</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($room_quotation as $quote)
                        <tr>
                          <td>{{$quote->from_date}}</td>
                          <td>{{$quote->to_date}}</td>
                          <td>{{$quote->single}}</td>
                          <td>{{$quote->double_twin}}</td>
                          <td>{{$quote->abf_ad}}</td>
                          <td>{{$quote->lunch_ad}}</td>
                          <td>{{$quote->dinner_ad}}</td>
                          <td>{{$quote->extra_bed_ad}}</td>
                          <td>{{$quote->extra_bed_ch}}</td>
                          <td>{{$quote->abf_ch}}</td>
                          <td>{{$quote->lunch_ch}}</td>
                          <td>{{$quote->dinner_ch}}</td>
                          <td>{{$quote->remarks}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!--ajax-modal-details-box-->

            <!--ajax-modal-details-box-->
            <div class="ajax-modal-details-box">
                <h3>Price</h3>
                <!-- pricing start -->
                <?php
                // print_r(Booking::HotelDetail($hotel->hid)->child_age_to); die;
                if ($age !=null) {

                for ($i=0; $i < count($age); $i++) {
                  if (Booking::HotelDetail($room_info->hid)->child_age_from <= $age[$i] && Booking::HotelDetail($room_info->hid)->child_age_to >= $age[$i]) {
                  }else {
                    $adult = $adult+1;
                    $child = $child-1;
                  }
                }
              }

                // print_r($adult); die;
                 ?>
                <!-- <p>{{Booking::getRoomsCalculation($room_info->rid,$from_date,$to_date,$adult,$child,$age)}}</p> -->
                @foreach(Booking::getRoomsCalculation($room_info->rid,$from_date,$to_date,$adult,$child,$age) as $price)
                <div class="calc-div">
                  @if($price->quote !="")
                  @if($adult == 1 && $child ==0)
                  <h5> <span>{{$price->price}} USD  X {{$price->days}} Nights</span> </h5>
                  <p>{{$adult}} Adult</p>

                  @elseif($adult == 1 && $child ==1)
                  <h5> <span>{{$price->price}} USD  X {{$price->days}} Nights</span> </h5>
                  <p>{{$adult}} Adult + {{$child}} Child (Double Twin)</p>

                  @elseif($adult == 1 && $child ==2)
                  <h5> <span>{{$price->price}} USD @if($price->room == 2) + {{$price->price}} USD @else + {{$price->childprice}} USD (Child) @endif X {{$price->days}} Nights</span> </h5>
                  @if($price->room == 2)
                  <p>{{$price->room}} X Rooms= {{$adult}} Adult + {{$child}} Child (Double Twin)</p>
                  @else
                  <p>{{$adult}} Adult + 1 Child (Double Twin) + {{$child}} Child Extrabed</p>
                  @endif

                  @elseif($adult == 1 && $child ==3)
                  <h5> <span>{{$price->price}} USD + {{$price->price}} USD  X {{$price->days}} Nights</span> </h5>
                  <p>{{$price->room}} X Rooms= {{$adult}} Adult + {{$child}} Child (2 Double Twin)</p>
                  <!-- 1 Adult Ends -->

                  <!-- 2 Adult Start -->
                  @elseif($adult == 2 && $child ==0)
                  <h5> <span>{{$price->price}} USD  X {{$price->days}} Nights</span> </h5>
                  <p>{{$adult}} Adults (Double Twin)</p>
                  @elseif($adult == 2 && $child ==1)
                  <h5> <span>{{$price->price}} USD @if($price->room == 2) + {{$price->price}} USD @else + {{$price->childprice}} USD (Child) @endif  X {{$price->days}} Nights</span> </h5>
                  @if($price->room == 2)
                  <p>{{$price->room}} X Rooms= {{$adult}} Adult + {{$child}} Child (Double Twin)</p>
                  @else
                  <p>{{$adult}} Adult  (Double Twin) + {{$child}} Child Extrabed</p>
                  @endif
                  @elseif($adult == 2 && $child ==2)
                  <h5> <span>{{$price->price}} USD @if($price->room == 2) + {{$price->price}} USD @else + {{$price->childprice}} USD (Child) @endif X {{$price->days}} Nights</span> </h5>
                  @if($price->room == 2)
                  <p>{{$price->room}} X Rooms= {{$adult}} Adult + {{$child}} Child (Double Twin)</p>
                  @else
                  <p>{{$adult}} Adult + {{$child}} Child (Double Twin) + 1 Child Extrabed</p>
                  @endif
                  @elseif($adult == 2 && $child ==3)
                  <h5> <span>{{$price->price}} USD + {{$price->price}} USD X {{$price->days}} Nights</span> </h5>
                  <p>{{$price->room}} X Rooms= {{$adult}} Adult (Double Twin) + {{$child}} Child (Double Twin)</p>
                  <!-- 2 Adult End -->

                  <!-- 3 Adult Start -->
                  @elseif($adult == 3 && $child ==0)
                  <h5> <span>{{$price->price}} USD + {{$price->extra_price_ad}} USD (Adult) X {{$price->days}} Nights</span> </h5>
                  @if($price->room == 2)
                  <p>{{$price->room}} X Rooms= 2 Adult (Double Twin) + 1 Adult (Single) </p>
                  @else
                  <p>2 Adult (Double Twin) + 1 Adult Extrabed</p>
                  @endif

                  @elseif($adult == 3 && $child ==1)
                  <h5> <span>{{$price->price}} USD @if($price->room == 2) + {{$price->price}} USD @else + {{$price->extra_price_ad}} USD (Adult) @endif  X {{$price->days}} Nights</span> </h5>
                  @if($price->room == 2)
                  <p>{{$price->room}} X Rooms= 2 Adult (Double Twin) + 1 Adult {{$child}} Child (Double Twin)</p>
                  @else
                  <p>2 Adult+ 1 Child  (Double Twin) + 1 Adult Extrabed</p>
                  @endif

                  @elseif($adult == 3 && $child ==2)
                  <h5> <span>{{$price->price}} USD + {{$price->price}} USD  @if($price->room == 3) + {{$price->price}} USD @else + {{$price->childprice}}  USD (Adult) @endif  X {{$price->days}} Nights</span> </h5>
                  @if($price->room == 3)
                  <p>{{$price->room}} X Rooms= 2 Adult (Double Twin) + 2 Child (Double Twin) + 1 Adult (Single)</p>
                  @else
                  <p>{{$price->room}} X Rooms= 2 Adult (Double Twin) + {{$child}} Child (Double Twin) + 1 Adult Extrabed</p>
                  @endif

                  @elseif($adult == 3 && $child ==3)
                  <h5> <span> @if($price->room == 3) {{$price->price}} X 3 USD  @else  {{$price->price}} X 2 USD + {{$price->childprice}} USD (Child) + {{$price->extra_price_ad}} (Adult) @endif X {{$price->days}} Nights</span> </h5>
                  @if($price->room == 3)
                  <p>{{$price->room}} X Rooms= 2 Adult (Double Twin) + 2 Child (Double Twin) + 1 Adult 1 Child (Double Twin)</p>
                  @else
                  <p>{{$price->room}} X Rooms= 2 Adult (Double Twin) 1 Child Extrabed + 2 Child (Double Twin) 1 Adult Extrabed</p>
                  @endif
                  <!-- Adult 3 End -->


                  <!-- Adult 4 Start -->
                  @elseif($adult == 4 && $child ==0)
                  <h5> <span>{{$price->price}} X 2 USD X {{$price->days}} Nights</span> </h5>
                  <p>{{$price->room}} X Rooms 2 Adult (Double Twin) + 2 Adult (Double Twin) </p>

                  @elseif($adult == 4 && $child ==1)
                  <h5> <span>@if($price->room==3) {{$price->price}} X 3 USD @else {{$price->price}} X 2 USD + {{$price->childprice}} USD (Child) @endif  X {{$price->days}} Nights</span> </h5>
                  @if($price->room == 3)
                  <p>{{$price->room}} X Rooms= 2 Adult (Double Twin) + 2 Adult (Double Twin) + 1 Child (Single)</p>
                  @else
                  <p>{{$price->room}} X Rooms= 2 Adult + 1 Child  (Double Twin + Child Extrabed) + 2 Adult (Double Twin)</p>
                  @endif

                  @elseif($adult == 4 && $child ==2)
                  <h5> <span>@if($price->room == 3) {{$price->price}} X 3 USD @else {{$price->price}} X 2 USD + {{$price->childprice}} X 2 USD @endif  X {{$price->days}} Nights</span> </h5>
                  @if($price->room == 3)
                  <p>{{$price->room}} X Rooms= 2 Adult (Double Twin) + 2 Child (Double Twin) + 2 Adult (Double Twin)</p>
                  @else
                  <p>{{$price->room}} X Rooms= 2 Adult + 1 Child  (Double Twin + Child Extrabed) + 2 Adult + 1 (Double Twin + Child Extrabed)</p>
                  @endif

                  @elseif($adult == 4 && $child ==3)
                  <h5> <span> @if($price->room == 4) {{$price->price}} X 4 USD  @else  {{$price->price}} X 3 USD + {{$price->childprice}} USD (Child)  @endif X {{$price->days}} Nights</span> </h5>
                  @if($price->room == 4)
                  <p>{{$price->room}} X Rooms= 2 Adult (Double Twin) + 1 Adult 1 Child (Double Twin) + 2 Child (Double Twin) + 1 Adult (Single)</p>
                  @else
                  <p>{{$price->room}} X Rooms= 2 Adult + 1 Child (Double Twin + Child Extrabed) + 2 Child (Double Twin) + 2 Adult (Double Twin)</p>
                  @endif
                  <!-- 4 Adult Ends -->


                  <!-- Adult 5 -->
                  @elseif($adult == 5 && $child ==0)
                  <h5> <span>@if($price->room == 3) {{$price->price}} X 3 USD @else {{$price->price}} X 2 USD + {{$price->extra_price_ad}} @endif  X {{$price->days}} Nights</span> </h5>
                  @if($price->room == 3)
                  <p>{{$price->room}} X Rooms= 2 Adult (Double Twin) + 2 Adult (Double Twin) + 1 Adult (Single)</p>
                  @else
                  <p>{{$price->room}} X Rooms= 2 Adult + 1 Adult  (Double Twin + Adult Extrabed) + 2 Adult (Double Twin)</p>
                  @endif

                  @elseif($adult == 5 && $child ==1)
                  <h5> <span>@if($price->room==3) {{$price->price}} X 3 USD @else {{$price->price}} X 2 USD + {{$price->childprice}} USD (Child) + {{$price->extra_price_ad}} USD (Adult) @endif  X {{$price->days}} Nights</span> </h5>
                  @if($price->room == 3)
                  <p>{{$price->room}} X Rooms= 2 Adult (Double Twin) + 2 Adult (Double Twin) + 1 Child 1 Adult (Double Twin)</p>
                  @else
                  <p>{{$price->room}} X Rooms= 2 Adult + 1 Child  (Double Twin + Child Extrabed) + 2 Adult + 1 Adult (Double Twin + Adult Extrabed)</p>
                  @endif

                  @elseif($adult == 5 && $child ==2)
                  <h5> <span>@if($price->room == 4) {{$price->price}} X 4 USD @else {{$price->price}} X 3 USD + {{$price->childprice}} X 1 USD @endif  X {{$price->days}} Nights</span> </h5>
                  @if($price->room == 4)
                  <p>{{$price->room}} X Rooms= 2 Adult (Double Twin) + 2 Adult (Double Twin) + 2 Child (Double Twin) + 1 Adult (Single)</p>
                  @else
                  <p>{{$price->room}} X Rooms= 2 Adult + 1 Child  (Double Twin + Child Extrabed) + 2 Adult (Double Twin) + 1 Adult 1 Child (Double Twin)</p>
                  @endif

                  @elseif($adult == 5 && $child ==3)
                  <h5> <span> @if($price->room == 4) {{$price->price}} X 4 USD  @else  {{$price->price}} X 3 USD + {{$price->childprice}} X 2 USD (Child)  @endif X {{$price->days}} Nights</span> </h5>
                  @if($price->room == 4)
                  <p>{{$price->room}} X Rooms 2 Adult (Double Twin) + 2 Adult (Double Twin) + 2 Child (Double Twin) + 1 Adult 1 Child (Double Twin)</p>
                  @else
                  <p>{{$price->room}} X Rooms 2 Adult + 1 Child (Double Twin + Child Extrabed) + 2 Adult + 1 Child (Double Twin + Child Extrabed) + 1 Adult 1 Child (Double Twin)</p>
                  @endif
                  <!-- 5 Adult Ends -->
                  @endif


                  @if($price->quote->is_abf_included == '1')
                  <p><span class="text-muted">Breakfast Included</span> <span style="float:right;color: #46A5DC; font-size:20px;">{{$price->totalprice}} USD</span> </p>
                  @else
                  <p><span style="float:right;color: #46A5DC; font-size:20px;">{{$price->totalprice}} USD</span></p>
                  @endif

                  @else
                  <p>Get Price on Call</p>
                  @endif
                </div>
                @endforeach
                <!-- Pricing End -->
            </div>
            <!--ajax-modal-details-box-->

            <!--ajax-modal-details-box-->
            <div class="ajax-modal-details-box">
                <h3>Room Amenities</h3>
                <div class="listing-features fl-wrap">
                    <ul>
                        <!-- <li><i class="fal fa-wifi"></i> Free WiFi</li>
                        <li><i class="fas fa-glass-martini-alt"></i> Mini Bar</li>
                        <li><i class="fal fa-snowflake"></i>Air Conditioner</li>
                        <li><i class="fal fa-tv"></i><span>Tv Inside</li> -->
                        @if($room_quotation[0]->is_abf_included == 1)
                        <li><i class="fal fa-concierge-bell"></i> Breakfast</li>
                        @endif
                        <li><i class="fal fa-concierge-bell"></i> Lunch</li>
                        <li><i class="fal fa-concierge-bell"></i> Dinner</li>
                        @if($room_info->is_smoking == 0)
                        <li><i class="fa fa-smoking-ban"></i>Non-smoking</li>
                        @endif
                        @if($room_info->has_kitchen == 1)
                        <li><i class="fas fa-utensils"></i>Kitchen</li>
                        @endif
                        @if($room_info->has_private_pool == 1)
                        <li><i class="fal fa-swimming-pool"></i>Private Pool</li>
                        @endif
                        @if($room_info->is_pets_allowed == 1)
                        <li><i class="fal fa-paw"></i> Pet Friendly</li>
                        @endif
                        @if($room_info->extra_bed == 1)
                        <li><i class="fal fa-bed"></i> Extra Bed</li>
                        @endif
                    </ul>
                </div>
            </div>
            <!--ajax-modal-details-box end-->
            <a href="booking-single.html" class="btn float-btn color2-bg">Book Now<i class="fas fa-caret-right"></i></a>
        </div>
    </div>
    <!--ajax-modal-item-->
</div>
<!--ajax-modal-wrap end -->
