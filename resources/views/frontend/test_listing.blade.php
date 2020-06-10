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
</style>
<!--  wrapper  -->
<div id="wrapper">

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

										<div class="listing-item">
											<article class="geodir-category-listing fl-wrap">
												<div class="geodir-category-img">


													</a>
													<div class="listing-avatar"><a href="author-single.html"><img src="images/avatar/1.jpg" alt=""></a>
														<span class="avatar-tooltip">Added By  <strong>Alisa Noory</strong></span>
													</div>
													<!-- <div class="sale-window">Sale 20%</div> -->
													<!-- <div class="sale-window big-sale">Sale 50%</div> -->
													<div class="geodir-category-opt">

											</div>
										</div>

											<div class="" style="height:310px;">
								         @foreach($hotel->rooms as $room)
                         @if($room->possibilities != null && isset($room->possibilities['message']))
                          {{$room->possibilities['message']}}
                          @endif
                         @endforeach

											</div>

									</article>
								</div>
								@endforeach


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
