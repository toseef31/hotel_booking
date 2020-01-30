@extends('frontend.layouts.master')
@section('content')
<!--  wrapper  -->
<div id="wrapper">
	<!-- content-->
	<div class="content">
		<!--section -->
		<section class="hero-section" data-scrollax-parent="true" id="sec1">
			<div class="hero-parallax">
				<div class="slideshow-container" data-scrollax="properties: { translateY: '200px' }" >
					<!-- slideshow-item -->
					<div class="slideshow-item">
						<div class="bg"  data-bg="http://easybook.kwst.net/images/bg/9.jpg"></div>
					</div>
					<!--  slideshow-item end  -->
					<!-- slideshow-item -->
					<div class="slideshow-item">
						<div class="bg"  data-bg="http://easybook.kwst.net/images/bg/13.jpg"></div>
					</div>
					<!--  slideshow-item end  -->
					<!-- slideshow-item -->
					<div class="slideshow-item">
						<div class="bg"  data-bg="http://easybook.kwst.net/images/bg/6.jpg"></div>
					</div>
					<!--  slideshow-item end  -->
				</div>
				<div class="overlay op7"></div>
			</div>
			<div class="hero-section-wrap fl-wrap">
				<div class="container">
					<div class="home-intro">
						<div class="section-title-separator"><span></span></div>
						<h2>EasyBook Hotel Booking System</h2>
						<span class="section-separator"></span>
						<h3>Let's start exploring the world together with EasyBook</h3>
					</div>
					<form class="" action="{{url('/listing')}}" method="get">
			      {{csrf_field()}}
						<div class="main-search-input-wrap">
						<div class="main-search-input fl-wrap">
							<div class="main-search-input-item location" id="autocomplete-container">
								<!-- <span class="inpt_dec"><i class="fal fa-map-marker"></i></span> -->
								<div class="listsearch-input-item show-city">
	                <select data-placeholder="City" name="city" class="chosen-select" >
	                  <option value="">All Cities</option>
	                  @foreach(Booking::getcities() as $city)
	                  <option value="{{$city->name}}">{{$city->name}}</option>
	                  @endforeach
	                </select>
	              </div>
								<!-- <input type="text" placeholder="Hotel , City..." class="autocomplete-input" id="autocompleteid2"  value=""/> -->
								<!-- <a href="#"><i class="fal fa-dot-circle"></i></a> -->
							</div>
							<div class="main-search-input-item main-date-parent main-search-input-item_small">
								<span class="inpt_dec"><i class="fal fa-calendar-check"></i></span> <input type="text" placeholder="When" name="main-input-search"   value=""/>
							</div>
							<div class="main-search-input-item">
								<div class="qty-dropdown fl-wrap">
									<div class="qty-dropdown-header fl-wrap"><i class="fal fa-users"></i> Persons</div>
									<div class="qty-dropdown-content fl-wrap">
										<div class="quantity-item">
											<label><i class="fas fa-male"></i> Adults</label>
											<div class="quantity">
												<input type="number" min="1" max="3" step="1" value="1">
											</div>
										</div>
										<div class="quantity-item">
											<label><i class="fas fa-child"></i> Children</label>
											<div class="quantity main-children">
												<input type="number" min="0" max="5" step="1" value="0" id="total-child">
											</div>
										</div>
										<div class="field_wrapper_main" id="field_wrapper_main">
										</div>

									</div>
								</div>
							</div>
							<button class="main-search-button color2-bg" onclick="window.location.href='listing.html'">Search <i class="fal fa-search"></i></button>
						</div>
					</div>
				</form>
				</div>
			</div>
			<div class="header-sec-link">
				<div class="container"><a href="#sec2" class="custom-scroll-link color-bg"><i class="fal fa-angle-double-down"></i></a></div>
			</div>
		</section>

		<!-- section end -->
		<!--section -->
		<section id="sec2">
			<div class="container">
				<div class="section-title">
					<div class="section-title-separator"><span></span></div>
					<h2>Popular Destination</h2>
					<span class="section-separator"></span>
					<p>Explore some of the best tips from around the city from our partners and friends.</p>
				</div>
			</div>
			<!-- portfolio start -->
			<div class="gallery-items fl-wrap mr-bot spad home-grid">
				<!-- gallery-item-->
				<div class="gallery-item">
					<div class="grid-item-holder">

						<div class="listing-item-grid">
							<div class="listing-counter"><span>{{ Booking::Bangkok() }}</span> Hotels</div>
							<img  src="{{ url('frontend-assets/hotelsimages/Bangkok.jpg')}}"   alt="">
							<div class="listing-item-cat">
								<h3><a href="{{ url('/listing?city=Bangkok')}}">Bangkok</a></h3>
								<div class="weather-grid"   data-grcity="Rome"></div>
								<div class="clearfix"></div>
								<p>Constant care and attention to the patients makes good record</p>
							</div>
						</div>

					</div>
				</div>
				<!-- gallery-item end-->
				<!-- gallery-item-->
				<div class="gallery-item gallery-item-second">
					<div class="grid-item-holder">

						<div class="listing-item-grid">
							<img  src="{{ url('frontend-assets/hotelsimages/pattaya_beach.jpg')}}"   alt="">
							<div class="listing-counter"><span>{{ Booking::Pattaya() }} </span> Hotels</div>
							<div class="listing-item-cat">
								<h3><a href="{{ url('/listing?city=Pattaya')}}">Pattaya</a></h3>
								<div class="weather-grid"   data-grcity="Paris"></div>
								<div class="clearfix"></div>
								<p>Constant care and attention to the patients makes good record</p>
							</div>
						</div>

					</div>
				</div>
				<!-- gallery-item end-->
				<!-- gallery-item-->
				<div class="gallery-item">
					<div class="grid-item-holder">

						<div class="listing-item-grid">
							<div class="listing-counter"><span>{{ Booking::Sihanoukville() }} </span> Hotels</div>
							<img  src="{{ url('frontend-assets/hotelsimages/Sihanoukville.jpg')}}"  alt="">
							<div class="listing-item-cat">
								<h3><a href="{{ url('/listing?city=Sihanoukville')}}">Sihanoukville</a></h3>
								<div class="weather-grid"   data-grcity="Sihanoukville"></div>
								<div class="clearfix"></div>
								<p>Constant care and attention to the patients makes good record</p>
							</div>
						</div>

					</div>
				</div>
				<!-- gallery-item end-->
				<!-- gallery-item-->
				<div class="gallery-item">
					<div class="grid-item-holder">

						<div class="listing-item-grid">
							<div class="listing-counter"><span>{{ Booking::KualaLumpur() }}</span> Hotels</div>
							<img  src="{{ url('frontend-assets/hotelsimages/KualaLumpur.jpg')}}"   alt="">
							<div class="listing-item-cat">
								<h3><a href="{{ url('/listing?city=Sihanoukville')}}">Kuala Lumpur</a></h3>
								<div class="weather-grid"   data-grcity="Kuala Lumpur"></div>
								<div class="clearfix"></div>
								<p>Constant care and attention to the patients makes good record</p>
							</div>
						</div>

					</div>
				</div>
				<!-- gallery-item end-->
				<!-- gallery-item-->
				<div class="gallery-item">
					<div class="grid-item-holder">
						<div class="listing-item-grid">
							<div class="listing-counter"><span>122</span> Hotels</div>
							<img  src="http://easybook.kwst.net/images/city/6.jpg"   alt="">
							<div class="listing-item-cat">
								<h3><a href="listing.html">New York</a></h3>
								<div class="weather-grid"   data-grcity="New York"></div>
								<div class="clearfix"></div>
								<p>Constant care and attention to the patients makes good record</p>
							</div>
						</div>
					</div>
				</div>
				<!-- gallery-item end-->
			</div>
			<!-- portfolio end -->
			<a href="listing.html" class="btn    color-bg">Explore All Cities<i class="fas fa-caret-right"></i></a>

		</section>
		<!-- section end -->
		<!-- section-->
		<section class="grey-blue-bg">
			<!-- container-->
			<div class="container">
				<div class="section-title">
					<div class="section-title-separator"><span></span></div>
					<h2>Recently Added Hotels</h2>
					<span class="section-separator"></span>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.</p>
				</div>
			</div>
			<!-- container end-->
			<!-- carousel -->
			<div class="list-carousel fl-wrap card-listing ">
				<!--listing-carousel-->
				<div class="listing-carousel  fl-wrap ">
					<!--slick-slide-item-->
					<div class="slick-slide-item">
						<!-- listing-item  -->
						<div class="listing-item">
							<article class="geodir-category-listing fl-wrap">
								<div class="geodir-category-img">
									<a href="listing-single.html"><img src="http://easybook.kwst.net/images/gal/8.jpg" alt=""></a>
									<div class="listing-avatar"><a href="author-single.html"><img src="http://easybook.kwst.net/images/avatar/1.jpg" alt=""></a>
									<span class="avatar-tooltip">Added By  <strong>Alisa Noory</strong></span>
								</div>
								<div class="sale-window">Sale 20%</div>
								<div class="geodir-category-opt">
									<div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
									<div class="rate-class-name">
										<div class="score"><strong>Very Good</strong>27 Reviews </div>
										<span>5.0</span>
									</div>
								</div>
							</div>
							<div class="geodir-category-content fl-wrap title-sin_item">
								<div class="geodir-category-content-title fl-wrap">
									<div class="geodir-category-content-title-item">
										<h3 class="title-sin_map"><a href="listing-single.html">Premium Plaza Hotel</a></h3>
										<div class="geodir-category-location fl-wrap"><a href="#" class="map-item"><i class="fas fa-map-marker-alt"></i> 27th Brooklyn New York, USA</a></div>
									</div>
								</div>
								<p>Sed interdum metus at nisi tempor laoreet. Integer gravida orci a justo sodales.</p>
								<ul class="facilities-list fl-wrap">
									<li><i class="fal fa-wifi"></i><span>Free WiFi</span></li>
									<li><i class="fal fa-parking"></i><span>Parking</span></li>
									<li><i class="fal fa-smoking-ban"></i><span>Non-smoking Rooms</span></li>
									<li><i class="fal fa-utensils"></i><span> Restaurant</span></li>
								</ul>
								<div class="geodir-category-footer fl-wrap">
									<div class="geodir-category-price">Awg/Night <span>$ 320</span></div>
									<div class="geodir-opt-list">
										<a href="#" class="single-map-item" data-newlatitude="40.72956781" data-newlongitude="-73.99726866"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map</span></a>
										<a href="#" class="geodir-js-favorite"><i class="fal fa-heart"></i><span class="geodir-opt-tooltip">Save</span></a>
										<a href="#" class="geodir-js-booking"><i class="fal fa-exchange"></i><span class="geodir-opt-tooltip">Find Directions</span></a>
									</div>
								</div>
							</div>
						</article>
					</div>
					<!-- listing-item end -->
				</div>
				<!--slick-slide-item end-->
				<!--slick-slide-item-->
				<div class="slick-slide-item">
					<!-- listing-item  -->
					<div class="listing-item">
						<article class="geodir-category-listing fl-wrap">
							<div class="geodir-category-img">
								<a href="listing-single.html"><img src="http://easybook.kwst.net/images/gal/4.jpg" alt=""></a>
								<div class="listing-avatar"><a href="author-single.html"><img src="http://easybook.kwst.net/images/avatar/2.jpg" alt=""></a>
								<span class="avatar-tooltip">Added By  <strong>Julie Cramp</strong></span>
							</div>
							<div class="sale-window big-sale">Sale 50%</div>
							<div class="geodir-category-opt">
								<div class="listing-rating card-popup-rainingvis" data-starrating2="4"></div>
								<div class="rate-class-name">
									<div class="score"><strong>Good</strong>12 Reviews </div>
									<span>4.2</span>
								</div>
							</div>
						</div>
						<div class="geodir-category-content fl-wrap title-sin_item">
							<div class="geodir-category-content-title fl-wrap">
								<div class="geodir-category-content-title-item">
									<h3 class="title-sin_map"><a href="listing-single.html">Grand Hero Palace</a></h3>
									<div class="geodir-category-location fl-wrap"><a href="#" class="map-item"><i class="fas fa-map-marker-alt"></i> W 85th St, New York,  USA</a></div>
								</div>
							</div>
							<p> Morbi suscipit erat in diam bibendum rutrum in nisl. Aliquam et purus ante.</p>
							<ul class="facilities-list fl-wrap">
								<li><i class="fal fa-wifi"></i><span>Free WiFi</span></li>
								<li><i class="fal fa-parking"></i><span>Parking</span></li>
								<li><i class="fal fa-smoking-ban"></i><span>Non-smoking Rooms</span></li>
								<li><i class="fal fa-utensils"></i><span> Restaurant</span></li>
							</ul>
							<div class="geodir-category-footer fl-wrap">
								<div class="geodir-opt-link">
									<div class="geodir-category-price">Awg/Night <span>$ 120</span></div>
								</div>
								<div class="geodir-opt-list">
									<a href="#" class="single-map-item" data-newlatitude="40.76221766" data-newlongitude="-73.96511769"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map</span></a>
									<a href="#" class="geodir-js-favorite"><i class="fal fa-heart"></i><span class="geodir-opt-tooltip">Save</span></a>
									<a href="#" class="geodir-js-booking"><i class="fal fa-exchange"></i><span class="geodir-opt-tooltip">Find Directions</span></a>
								</div>
							</div>
						</div>
					</article>
				</div>
				<!-- listing-item end -->
			</div>
			<!--slick-slide-item end-->
			<!--slick-slide-item-->
			<div class="slick-slide-item">
				<!-- listing-item  -->
				<div class="listing-item">
					<article class="geodir-category-listing fl-wrap">
						<div class="geodir-category-img">
							<a href="listing-single.html"><img src="images/gal/6.jpg" alt=""></a>
							<div class="listing-avatar"><a href="author-single.html"><img src="http://easybook.kwst.net/images/avatar/3.jpg" alt=""></a>
							<span class="avatar-tooltip">Added By  <strong>Andy Moore</strong></span>
						</div>
						<div class="geodir-category-opt">
							<div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
							<div class="rate-class-name">
								<div class="score"><strong>Good</strong>6 Reviews </div>
								<span>4.7</span>
							</div>
						</div>
					</div>
					<div class="geodir-category-content fl-wrap title-sin_item">
						<div class="geodir-category-content-title fl-wrap">
							<div class="geodir-category-content-title-item">
								<h3 class="title-sin_map"><a href="listing-single.html">Park Central</a></h3>
								<div class="geodir-category-location fl-wrap"><a href="#" class="map-item"><i class="fas fa-map-marker-alt"></i>40 Journal Square Plaza, NJ,  USA</a></div>
							</div>
						</div>
						<p> Sed tempor iaculis massa faucibus feugiat. In fermentum facilisis massa.</p>
						<ul class="facilities-list fl-wrap">
							<li><i class="fal fa-wifi"></i><span>Free WiFi</span></li>
							<li><i class="fal fa-parking"></i><span>Parking</span></li>
							<li><i class="fal fa-smoking-ban"></i><span>Non-smoking Rooms</span></li>
							<li><i class="fal fa-utensils"></i><span> Restaurant</span></li>
						</ul>
						<div class="geodir-category-footer fl-wrap">
							<div class="geodir-opt-link">
								<div class="geodir-category-price">Awg/Night <span>$ 80</span></div>
							</div>
							<div class="geodir-opt-list">
								<a href="#" class="single-map-item" data-newlatitude="40.88496706" data-newlongitude="-73.88191222"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map</span></a>
								<a href="#" class="geodir-js-favorite"><i class="fal fa-heart"></i><span class="geodir-opt-tooltip">Save</span></a>
								<a href="#" class="geodir-js-booking"><i class="fal fa-exchange"></i><span class="geodir-opt-tooltip">Find Directions</span></a>
							</div>
						</div>
					</div>
				</article>
			</div>
			<!-- listing-item end -->
		</div>
		<!--slick-slide-item end-->
		<!--slick-slide-item-->
		<div class="slick-slide-item">
			<!-- listing-item  -->
			<div class="listing-item">
				<article class="geodir-category-listing fl-wrap">
					<div class="geodir-category-img">
						<a href="listing-single.html"><img src="http://easybook.kwst.net/images/gal/2.jpg" alt=""></a>
						<div class="listing-avatar"><a href="author-single.html"><img src="http://easybook.kwst.net/images/avatar/4.jpg" alt=""></a>
						<span class="avatar-tooltip">Added By  <strong>Mary Jones</strong></span>
					</div>
					<div class="sale-window">Sale 20%</div>
					<div class="geodir-category-opt">
						<div class="listing-rating card-popup-rainingvis" data-starrating2="3"></div>
						<div class="rate-class-name">
							<div class="score"><strong>Pleasant</strong>10 Reviews </div>
							<span>3.2</span>
						</div>
					</div>
				</div>
				<div class="geodir-category-content fl-wrap title-sin_item">
					<div class="geodir-category-content-title fl-wrap">
						<div class="geodir-category-content-title-item">
							<h3 class="title-sin_map"><a href="listing-single.html">Holiday Home</a></h3>
							<div class="geodir-category-location fl-wrap"><a href="#" class="map-item"><i class="fas fa-map-marker-alt"></i> 75 Prince St,  NY, USA</a></div>
						</div>
					</div>
					<p>  Mauris ac maximus neque. Nam in mauris quis libero sodales eleifend.</p>
					<ul class="facilities-list fl-wrap">
						<li><i class="fal fa-wifi"></i><span>Free WiFi</span></li>
						<li><i class="fal fa-parking"></i><span>Parking</span></li>
						<li><i class="fal fa-smoking-ban"></i><span>Non-smoking Rooms</span></li>
						<li><i class="fal fa-utensils"></i><span> Restaurant</span></li>
					</ul>
					<div class="geodir-category-footer fl-wrap">
						<div class="geodir-opt-link">
							<div class="geodir-category-price">Awg/Night <span>$ 50</span></div>
						</div>
						<div class="geodir-opt-list">
							<a href="#" class="single-map-item" data-newlatitude="40.72228267" data-newlongitude="-73.99246214"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map</span></a>
							<a href="#" class="geodir-js-favorite"><i class="fal fa-heart"></i><span class="geodir-opt-tooltip">Save</span></a>
							<a href="#" class="geodir-js-booking"><i class="fal fa-exchange"></i><span class="geodir-opt-tooltip">Find Directions</span></a>
						</div>
					</div>
				</div>
			</article>
		</div>
		<!-- listing-item end -->
		</div>
		<!--slick-slide-item end-->
		<!--slick-slide-item-->
		<div class="slick-slide-item">
		<!-- listing-item  -->
		<div class="listing-item">
			<article class="geodir-category-listing fl-wrap">
				<div class="geodir-category-img">
					<a href="listing-single.html"><img src="http://easybook.kwst.net/images/gal/3.jpg" alt=""></a>
					<div class="listing-avatar"><a href="author-single.html"><img src="http://easybook.kwst.net/images/avatar/5.jpg" alt=""></a>
					<span class="avatar-tooltip">Added By  <strong>Fider Mamby</strong></span>
				</div>
				<div class="sale-window">Sale 10%</div>
				<div class="geodir-category-opt">
					<div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
					<div class="rate-class-name">
						<div class="score"><strong>Very Good</strong>102 Reviews </div>
						<span>4.7</span>
					</div>
				</div>
			</div>
			<div class="geodir-category-content fl-wrap title-sin_item">
				<div class="geodir-category-content-title fl-wrap">
					<div class="geodir-category-content-title-item">
						<h3 class="title-sin_map"><a href="listing-single.html">Gold Plaza Hotel</a></h3>
						<div class="geodir-category-location fl-wrap"><a href="#" class="map-item"><i class="fas fa-map-marker-alt"></i> 34-42 Montgomery St , NY, USA</a></div>
					</div>
				</div>
				<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nec tincidunt arcu, sit amet . </p>
				<ul class="facilities-list fl-wrap">
					<li><i class="fal fa-wifi"></i><span>Free WiFi</span></li>
					<li><i class="fal fa-parking"></i><span>Parking</span></li>
					<li><i class="fal fa-smoking-ban"></i><span>Non-smoking Rooms</span></li>
					<li><i class="fal fa-utensils"></i><span> Restaurant</span></li>
				</ul>
				<div class="geodir-category-footer fl-wrap">
					<div class="geodir-opt-link">
						<div class="geodir-category-price">Awg/Night <span>$ 210</span></div>
					</div>
					<div class="geodir-opt-list">
						<a href="#" class="single-map-item" data-newlatitude="40.94982541" data-newlongitude="-73.84357452"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map</span></a>
						<a href="#" class="geodir-js-favorite"><i class="fal fa-heart"></i><span class="geodir-opt-tooltip">Save</span></a>
						<a href="#" class="geodir-js-booking"><i class="fal fa-exchange"></i><span class="geodir-opt-tooltip">Find Directions</span></a>
					</div>
				</div>
			</div>
		</article>
		</div>
		<!-- listing-item end -->
		</div>
		<!--slick-slide-item end-->
		<!--slick-slide-item-->
		<div class="slick-slide-item">
		<!-- listing-item  -->
		<div class="listing-item">
		<article class="geodir-category-listing fl-wrap">
			<div class="geodir-category-img">
				<a href="listing-single.html"><img src="http://easybook.kwst.net/images/gal/5.jpg" alt=""></a>
				<div class="listing-avatar"><a href="author-single.html"><img src="http://easybook.kwst.net/images/avatar/1.jpg" alt=""></a>
				<span class="avatar-tooltip">Added By  <strong>Alisa Noory</strong></span>
			</div>
			<div class="sale-window big-sale">Sale 70%</div>
			<div class="geodir-category-opt">
				<div class="listing-rating card-popup-rainingvis" data-starrating2="4"></div>
				<div class="rate-class-name">
					<div class="score"><strong> Good</strong>8 Reviews </div>
					<span>4.1</span>
				</div>
			</div>
		</div>
		<div class="geodir-category-content fl-wrap title-sin_item">
			<div class="geodir-category-content-title fl-wrap">
				<div class="geodir-category-content-title-item">
					<h3 class="title-sin_map"><a href="listing-single.html">Moonlight Hotel</a></h3>
					<div class="geodir-category-location fl-wrap"><a href="#" class="map-item"><i class="fas fa-map-marker-alt"></i> 70 Bright St New York, USA</a></div>
				</div>
			</div>
			<p> Class aptent taciti  Mauris ac maximus neque. Nam in mauris quis libero sodales eleifend.</p>
			<ul class="facilities-list fl-wrap">
				<li><i class="fal fa-wifi"></i><span>Free WiFi</span></li>
				<li><i class="fal fa-parking"></i><span>Parking</span></li>
				<li><i class="fal fa-smoking-ban"></i><span>Non-smoking Rooms</span></li>
				<li><i class="fal fa-utensils"></i><span> Restaurant</span></li>
			</ul>
			<div class="geodir-category-footer fl-wrap">
				<div class="geodir-opt-link">
					<div class="geodir-category-price">Awg/Night <span>$ 105</span></div>
				</div>
				<div class="geodir-opt-list">
					<a href="#" class="single-map-item" data-newlatitude="40.90261483" data-newlongitude="-74.15737152"><i class="fal fa-map-marker-alt"></i><span class="geodir-opt-tooltip">On the map</span></a>
					<a href="#" class="geodir-js-favorite"><i class="fal fa-heart"></i><span class="geodir-opt-tooltip">Save</span></a>
					<a href="#" class="geodir-js-booking"><i class="fal fa-exchange"></i><span class="geodir-opt-tooltip">Find Directions</span></a>
				</div>
			</div>
		</div>
		</article>
		</div>
		<!-- listing-item end -->
		</div>
		<!--slick-slide-item end-->
		</div>
		<!--listing-carousel end-->
		<div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
		<div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
		</div>
		<!--  carousel end-->
		</section>
		<!-- section end -->
		<!--section -->
		<section class="parallax-section" data-scrollax-parent="true">
			<div class="bg"  data-bg="images/bg/2.jpg" data-scrollax="properties: { translateY: '100px' }"></div>
			<div class="overlay op7"></div>
			<!--container-->
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="colomn-text fl-wrap pad-top-column-text_small">
							<div class="colomn-text-title">
								<h3>Most Popular Hotels</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.</p>
								<a href="listing.html" class="btn  color2-bg float-btn">View All Hotels<i class="fas fa-caret-right"></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<!--light-carousel-wrap-->
						<div class="light-carousel-wrap fl-wrap">
							<!--light-carousel-->
							<div class="light-carousel">
								<!--slick-slide-item-->
								<div class="slick-slide-item">
									<div class="hotel-card fl-wrap title-sin_item">
										<div class="geodir-category-img card-post">
											<a href="listing-single.html"><img src="http://easybook.kwst.net/images/gal/8.jpg" alt=""></a>
											<div class="listing-counter">Awg/Night <strong>$85</strong></div>
											<div class="sale-window">Sale 20%</div>
											<div class="geodir-category-opt">
												<div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
												<h4 class="title-sin_map"><a href="listing-single.html">Moonlight Hotel</a></h4>
												<div class="geodir-category-location"><a href="#" class="single-map-item" data-newlatitude="40.90261483" data-newlongitude="-74.15737152"><i class="fas fa-map-marker-alt"></i> 75 Prince St,  NY, USA</a></div>
												<div class="rate-class-name">
													<div class="score"><strong> Good</strong>8 Reviews </div>
													<span>4.8</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--slick-slide-item end-->
								<!--slick-slide-item-->
								<div class="slick-slide-item">
									<div class="hotel-card fl-wrap title-sin_item">
										<div class="geodir-category-img">
											<a href="listing-single.html"><img src="http://easybook.kwst.net/images/gal/7.jpg" alt=""></a>
											<div class="listing-counter">Awg/Night <strong>$80</strong></div>
											<div class="sale-window big-sale">Sale 50%</div>
											<div class="geodir-category-opt">
												<div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
												<h4 class="title-sin_map"><a href="listing-single.html">Holiday Home</a></h4>
												<div class="geodir-category-location"><a href="#" class="single-map-item" data-newlatitude="40.72228267" data-newlongitude="-73.99246214"><i class="fas fa-map-marker-alt"></i> 34-42 Montgomery St , NY, USA</a></div>
												<div class="rate-class-name">
													<div class="score"><strong> Good</strong>2 Reviews </div>
													<span>4.7</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--slick-slide-item end-->
								<!--slick-slide-item-->
								<div class="slick-slide-item">
									<div class="hotel-card fl-wrap title-sin_item">
										<div class="geodir-category-img">
											<a href="listing-single.html"><img src="http://easybook.kwst.net/images/gal/9.jpg" alt=""></a>
											<div class="listing-counter">Awg/Night <strong>$120</strong></div>
											<div class="sale-window">Sale 10%</div>
											<div class="geodir-category-opt">
												<div class="listing-rating card-popup-rainingvis" data-starrating2="5"></div>
												<h4 class="title-sin_map"><a href="listing-single.html">Grand Hero Palace</a></h4>
												<div class="geodir-category-location"><a href="#" class="single-map-item" data-newlatitude="40.76221766" data-newlongitude="-73.96511769"><i class="fas fa-map-marker-alt"></i> 70 Bright St New York, USA</a></div>
												<div class="rate-class-name">
													<div class="score"><strong> Good</strong>31 Reviews </div>
													<span>4.9</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!--slick-slide-item end-->
							</div>
							<!--light-carousel end-->
							<div class="fc-cont  lc-prev"><i class="fal fa-angle-left"></i></div>
							<div class="fc-cont  lc-next"><i class="fal fa-angle-right"></i></div>
						</div>
						<!--light-carousel-wrap end-->
					</div>
				</div>
			</div>
		</section>
		<!-- section end -->
		<!--section -->
		<section>
			<div class="container">
				<div class="section-title">
					<div class="section-title-separator"><span></span></div>
					<h2>Why Choose Us</h2>
					<span class="section-separator"></span>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.</p>
				</div>
				<!-- -->
				<div class="row">
					<div class="col-md-4">
						<!-- process-item-->
						<div class="process-item big-pad-pr-item">
							<span class="process-count"> </span>
							<div class="time-line-icon"><i class="fal fa-headset"></i></div>
							<h4><a href="#"> Best service guarantee</a></h4>
							<p>Proin dapibus nisl ornare diam varius tempus. Aenean a quam luctus, finibus tellus ut, convallis eros sollicitudin turpis.</p>
						</div>
						<!-- process-item end -->
					</div>
					<div class="col-md-4">
						<!-- process-item-->
						<div class="process-item big-pad-pr-item">
							<span class="process-count"> </span>
							<div class="time-line-icon"><i class="fal fa-gift"></i></div>
							<h4> <a href="#">Exclusive gifts</a></h4>
							<p>Proin dapibus nisl ornare diam varius tempus. Aenean a quam luctus, finibus tellus ut, convallis eros sollicitudin turpis.</p>
						</div>
						<!-- process-item end -->
					</div>
					<div class="col-md-4">
						<!-- process-item-->
						<div class="process-item big-pad-pr-item nodecpre">
							<span class="process-count"> </span>
							<div class="time-line-icon"><i class="fal fa-credit-card"></i></div>
							<h4><a href="#"> Get more from your card</a></h4>
							<p>Proin dapibus nisl ornare diam varius tempus. Aenean a quam luctus, finibus tellus ut, convallis eros sollicitudin turpis.</p>
						</div>
						<!-- process-item end -->
					</div>
				</div>
				<!--process-wrap   end-->
				<!-- <div class=" single-facts fl-wrap mar-top">
					inline-facts
					<div class="inline-facts-wrap">
						<div class="inline-facts">
							<i class="fal fa-users"></i>
							<div class="milestone-counter">
								<div class="stats animaper">
									<div class="num" data-content="0" data-num="254">154</div>
								</div>
							</div>
							<h6>New Visiters Every Week</h6>
						</div>
					</div>
					inline-facts end
					inline-facts
					<div class="inline-facts-wrap">
						<div class="inline-facts">
							<i class="fal fa-thumbs-up"></i>
							<div class="milestone-counter">
								<div class="stats animaper">
									<div class="num" data-content="0" data-num="12168">12168</div>
								</div>
							</div>
							<h6>Happy customers every year</h6>
						</div>
					</div>
					inline-facts end
					inline-facts
					<div class="inline-facts-wrap">
						<div class="inline-facts">
							<i class="fal fa-award"></i>
							<div class="milestone-counter">
								<div class="stats animaper">
									<div class="num" data-content="0" data-num="172">172</div>
								</div>
							</div>
							<h6>Won Awards</h6>
						</div>
					</div>
					inline-facts end
					inline-facts
					<div class="inline-facts-wrap">
						<div class="inline-facts">
							<i class="fal fa-hotel"></i>
							<div class="milestone-counter">
								<div class="stats animaper">
									<div class="num" data-content="0" data-num="732">732</div>
								</div>
							</div>
							<h6>New Listing Every Week</h6>
						</div>
					</div>
					inline-facts end
				</div> -->
			</div>
		</section>
		<!-- section end -->
		<!--section -->
		<section class="color-bg hidden-section">
			<div class="wave-bg wave-bg2"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<!-- -->
						<div class="colomn-text  pad-top-column-text fl-wrap">
							<div class="colomn-text-title">
								<h3>Our App   Available Now</h3>
								<p>In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing elit, sed diam nonu mmy nibh euismod tincidunt ut laoreet dolore magna aliquam erat.</p>
								<a href="#" class=" down-btn color3-bg"><i class="fab fa-apple"></i> Download for iPhone</a>
								<a href="#" class=" down-btn color3-bg"><i class="fab fa-android"></i> Download for Android</a>
							</div>
						</div>
						<!--process-wrap   end-->
					</div>
					<div class="col-md-6">
						<div class="collage-image">
							<img src="images/api.png" class="main-collage-image" alt="">
							<div class="images-collage-title color3-bg">Easy<span>Book</span></div>
							<div class="collage-image-min cim_1"><img src="images/api/1.jpg" alt=""></div>
							<div class="collage-image-min cim_2"><img src="images/api/2.jpg" alt=""></div>
							<div class="collage-image-min cim_3"><img src="images/api/3.jpg" alt=""></div>
							<div class="collage-image-input">Search <i class="fa fa-search"></i></div>
							<div class="collage-image-btn color2-bg">Booking now</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- section end -->
		<!--section -->
		<!-- <section>
			<div class="container">
				<div class="section-title">
					<div class="section-title-separator"><span></span></div>
					<h2>Testimonials</h2>
					<span class="section-separator"></span>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.</p>
				</div>
			</div>
			<div class="clearfix"></div> -->
			<!--slider-carousel-wrap -->
			<!-- <div class="slider-carousel-wrap text-carousel-wrap fl-wrap">
				<div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
				<div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
				<div class="text-carousel single-carousel fl-wrap"> -->
					<!--slick-item -->
					<!-- <div class="slick-item">
						<div class="text-carousel-item">
							<div class="popup-avatar"><img src="http://easybook.kwst.net/images/avatar/1.jpg" alt=""></div>
							<div class="listing-rating card-popup-rainingvis" data-starrating2="5"> </div>
							<div class="review-owner fl-wrap">Milka Antony  - <span>Happy Client</span></div>
							<p> "In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing elit, sed diam nonu mmy nibh euismod tincidunt ut laoreet dolore magna aliquam erat."</p>
							<a href="#" class="testim-link">Via Facebook</a>
						</div>
					</div> -->
					<!--slick-item end -->
					<!--slick-item -->
					<!-- <div class="slick-item">
						<div class="text-carousel-item">
							<div class="popup-avatar"><img src="http://easybook.kwst.net/images/avatar/2.jpg" alt=""></div>
							<div class="listing-rating card-popup-rainingvis" data-starrating2="4"> </div>
							<div class="review-owner fl-wrap">Milka Antony  - <span>Happy Client</span></div>
							<p> "In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing elit, sed diam nonu mmy nibh euismod tincidunt ut laoreet dolore magna aliquam erat."</p>
							<a href="#" class="testim-link">Via Facebook</a>
						</div>
					</div> -->
					<!--slick-item end -->
					<!--slick-item -->
					<!-- <div class="slick-item">
						<div class="text-carousel-item">
							<div class="popup-avatar"><img src="http://easybook.kwst.net/images/avatar/3.jpg" alt=""></div>
							<div class="listing-rating card-popup-rainingvis" data-starrating2="5"> </div>
							<div class="review-owner fl-wrap">Milka Antony  - <span>Happy Client</span></div>
							<p> "In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing elit, sed diam nonu mmy nibh euismod tincidunt ut laoreet dolore magna aliquam erat."</p>
							<a href="#" class="testim-link">Via Facebook</a>
						</div>
					</div> -->
					<!--slick-item end -->
					<!--slick-item -->
					<!-- <div class="slick-item">
						<div class="text-carousel-item">
							<div class="popup-avatar"><img src="http://easybook.kwst.net/images/avatar/4.jpg" alt=""></div>
							<div class="listing-rating card-popup-rainingvis" data-starrating2="5"> </div>
							<div class="review-owner fl-wrap">Milka Antony  - <span>Happy Client</span></div>
							<p> "In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo gravida. Lorem ipsum dolor sit amet, conse ctetuer adipiscing elit, sed diam nonu mmy nibh euismod tincidunt ut laoreet dolore magna aliquam erat."</p>
							<a href="#" class="testim-link">Via Facebook</a>
						</div>
					</div> -->
					<!--slick-item end -->
				<!-- </div>
			</div> -->
			<!--slider-carousel-wrap end-->
		<!-- </section> -->
		<!-- section end-->
		<section class="parallax-section" data-scrollax-parent="true">
			<div class="bg"  data-bg="http://easybook.kwst.net/images/bg/14.jpg" data-scrollax="properties: { translateY: '100px' }"></div>
			<div class="overlay"></div>
			<!--container-->
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<!-- column text-->
						<div class="colomn-text fl-wrap">
							<div class="colomn-text-title">
								<h3>The owner of the hotel or business ?</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas in pulvinar neque. Nulla finibus lobortis pulvinar.</p>
								<a href="dashboard-add-listing.html" class="btn  color-bg float-btn">Add your hotel<i class="fal fa-plus"></i></a>
							</div>
						</div>
						<!--column text   end-->
					</div>
				</div>
			</div>
		</section>
		<!-- section end -->
		<!--section -->
		<!-- <section class=" middle-padding">
			<div class="container">
				<div class="section-title">
					<div class="section-title-separator"><span></span></div>
					<h2>Tips & Articles</h2>
					<span class="section-separator"></span>
					<p>Browse the latest articles from our blog.</p>
				</div>
				<div class="row home-posts">
					<div class="col-md-4">
						<article class="card-post">
							<div class="card-post-img fl-wrap">
								<a href="blog-single.html"><img  src="http://easybook.kwst.net/images/all/11.jpg"   alt=""></a>
							</div>
							<div class="card-post-content fl-wrap">
								<h3><a href="blog-single.html">Blog Post Title.</a></h3>
								<p>In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo gravida. </p>
								<div class="post-author"><a href="#"><img src="images/avatar/4.jpg" alt=""><span>By , Mery Lynn</span></a></div>
								<div class="post-opt">
									<ul>
										<li><i class="fal fa-calendar"></i> <span>25 April 2018</span></li>
										<li><i class="fal fa-eye"></i> <span>264</span></li>
										<li><i class="fal fa-tags"></i> <a href="#">Design</a>  </li>
									</ul>
								</div>
							</div>
						</article>
					</div>
					<div class="col-md-4">
						<article class="card-post">
							<div class="card-post-img fl-wrap">
								<div class="list-single-main-media fl-wrap">
									<div class="single-slider-wrapper fl-wrap">
										<div class="single-slider fl-wrap"  >
											<div class="slick-slide-item"><img src="http://easybook.kwst.net/images/all/9.jpg" alt=""></div>
											<div class="slick-slide-item"><img src="http://easybook.kwst.net/images/all/7.jpg" alt=""></div>
											<div class="slick-slide-item"><img src="http://easybook.kwst.net/images/all/1.jpg" alt=""></div>
										</div>
										<div class="swiper-button-prev sw-btn"><i class="fa fa-long-arrow-left"></i></div>
										<div class="swiper-button-next sw-btn"><i class="fa fa-long-arrow-right"></i></div>
									</div>
								</div>
							</div>
							<div class="card-post-content fl-wrap">
								<h3><a href="blog-single.html">Blog Post Title.</a></h3>
								<p>In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo gravida. </p>
								<div class="post-author"><a href="#"><img src="images/avatar/1.jpg" alt=""><span>By , Mery Lynn</span></a></div>
								<div class="post-opt">
									<ul>
										<li><i class="fal fa-calendar"></i> <span>25 April 2018</span></li>
										<li><i class="fal fa-eye"></i> <span>264</span></li>
										<li><i class="fal fa-tags"></i> <a href="#">Design</a>  </li>
									</ul>
								</div>
							</div>
						</article>
					</div>
					<div class="col-md-4">
						<article class="card-post">
							<div class="card-post-img fl-wrap">
								<a href="blog-single.html"><img  src="images/all/10.jpg"   alt=""></a>
							</div>
							<div class="card-post-content fl-wrap">
								<h3><a href="blog-single.html">Blog Post Title.</a></h3>
								<p>In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus. Nulla eu mi magna. Etiam suscipit commodo gravida. </p>
								<div class="post-author"><a href="#"><img src="http://easybook.kwst.net/images/avatar/1.jpg" alt=""><span>By , Mery Lynn</span></a></div>
								<div class="post-opt">
									<ul>
										<li><i class="fal fa-calendar"></i> <span>25 April 2018</span></li>
										<li><i class="fal fa-eye"></i> <span>264</span></li>
										<li><i class="fal fa-tags"></i> <a href="#">Design</a>  </li>
									</ul>
								</div>
							</div>
						</article>
					</div>
				</div>
				<a href="blog.html" class="btn    color-bg ">Read All News<i class="fas fa-caret-right"></i></a>
			</div>
			<div class="section-decor"></div>
		</section> -->
	</div>
	<!-- content end-->
</div>
<!--wrapper end -->
@endsection
