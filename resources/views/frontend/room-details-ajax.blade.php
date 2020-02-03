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
                <h3>Calculation</h3>
                <div class="listing-features fl-wrap">
                  <p>{{$adult}} Adult @if($child >0) + {{$child}} Child + {{$child}} Child Extra Breakfast @endif = <span>{{Booking::getPriceWithoutChild($room_info->rid,$from_date,$to_date,$adult,$child)}}</span> </p>
                  @if($child > 0)
                  <p>{{$adult}} Adult + {{$child}} Child + {{$child}} Child Extra Bed + {{$child}} Child Extra Breakfast  = <span>{{Booking::getPriceWithChild($room_info->rid,$from_date,$to_date,$adult,$child)}}</span> </p>
                  @endif
                </div>
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
