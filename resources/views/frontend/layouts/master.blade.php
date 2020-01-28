<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
    <meta name="robots" content="index, follow"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <!--=============== css  ===============-->
    <link type="text/css" rel="stylesheet" href="{{asset('frontend-assets/css/reset.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend-assets/css/plugins.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend-assets/css/style.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend-assets/css/color.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('frontend-assets/css/custom.css')}}">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="{{asset('frontend-assets/bootstrap/css/bootstrap.min.css')}}" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/fontawesome/css/all.min.css')}}"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/fontawesome/css/brands.min.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="{{asset('frontend-assets/fontawesome/css/regular.min.css')}}"> -->
    <!--=============== favicons ===============-->
    <link rel="shortcut icon" href="images/favicon.ico">

    <title>Booking</title>
    @yield('style')
  </head>
  <body>
    <!--loader-->
    <div class="loader-wrap">
        <div class="pin">
            <div class="pulse"></div>
        </div>
    </div>
    <!--loader end-->
    <div id="main" style="opacity: 1;">

    @include('frontend.includes.header')

    @yield('content')

    @include('frontend.includes.footer')

    <!--map-modal -->
    <div class="map-modal-wrap">
      <div class="map-modal-wrap-overlay"></div>
      <div class="map-modal-item">
        <div class="map-modal-container fl-wrap">
          <div class="map-modal fl-wrap">
            <div id="singleMap" data-latitude="40.7" data-longitude="-73.1"></div>
          </div>
          <h3><i class="fal fa-location-arrow"></i><a href="#">Hotel Title</a></h3>
          <input id="pac-input" class="controls fl-wrap controls-mapwn" type="text" placeholder="What Nearby ?   Bar , Gym , Restaurant ">
          <div class="map-modal-close"><i class="fal fa-times"></i></div>
        </div>
      </div>
    </div>
    <!--map-modal end -->
    <!--register form -->
    <div class="main-register-wrap modal">
      <div class="reg-overlay"></div>
      <div class="main-register-holder">
        <div class="main-register fl-wrap">
          <div class="close-reg color-bg"><i class="fal fa-times"></i></div>
          <ul class="tabs-menu">
            <li class="current"><a href="#tab-1"><i class="fal fa-sign-in-alt"></i> Login</a></li>
            <li><a href="#tab-2"><i class="fal fa-user-plus"></i> Register</a></li>
          </ul>
          <!--tabs -->
          <div id="tabs-container">
            <div class="tab">
              <!--tab -->
              <div id="tab-1" class="tab-content">
                <h3>Sign In <span>Easy<strong>Book</strong></span></h3>
                <div class="custom-form">
                  <form method="post"  name="registerform">
                    <label>Username or Email Address <span>*</span> </label>
                    <input name="email" type="text"   onClick="this.select()" value="">
                    <label >Password <span>*</span> </label>
                    <input name="password" type="password"   onClick="this.select()" value="" >
                    <button type="submit"  class="log-submit-btn color-bg"><span>Log In</span></button>
                    <div class="clearfix"></div>
                    <div class="filter-tags">
                      <input id="check-a" type="checkbox" name="check">
                      <label for="check-a">Remember me</label>
                    </div>
                  </form>
                  <div class="lost_password">
                    <a href="#">Lost Your Password?</a>
                  </div>
                </div>
              </div>
              <!--tab end -->
              <!--tab -->
              <div class="tab">
                <div id="tab-2" class="tab-content">
                  <h3>Sign Up <span>Easy<strong>Book</strong></span></h3>
                  <div class="custom-form">
                    <form method="post"   name="registerform" class="main-register-form" id="main-register-form2">
                      <label >Full Name <span>*</span> </label>
                      <input name="name" type="text"   onClick="this.select()" value="">
                      <label>Email Address <span>*</span></label>
                      <input name="email" type="text"  onClick="this.select()" value="">
                      <label >Password <span>*</span></label>
                      <input name="password" type="password"   onClick="this.select()" value="" >
                      <button type="submit"     class="log-submit-btn color-bg"  ><span>Register</span></button>
                    </form>
                  </div>
                </div>
              </div>
              <!--tab end -->
            </div>
            <!--tabs end -->
            <div class="log-separator fl-wrap"><span>or</span></div>
            <div class="soc-log fl-wrap">
              <p>For faster login or register use your social account.</p>
              <a href="#" class="facebook-log"><i class="fab fa-facebook-f"></i>Connect with Facebook</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--register form end -->
    <a class="to-top"><i class="fas fa-caret-up"></i></a>
    <!--ajax-modal-container-->
            <div class="ajax-modal-overlay"></div>
            <div class="ajax-modal-container">
                <!--ajax-modal -->
                <div class='ajax-loader'>
                    <div class='ajax-loader-cirle'></div>
                </div>
                <div id="ajax-modal" class="fl-wrap">
                </div>
                <!--ajax-modal-container end -->
            </div>
            <!--ajax-modal-container end -->
    </div>

    <!-- Optional JavaScript -->
    <!--=============== scripts  ===============-->
    <script type="text/javascript" src="{{asset('frontend-assets/js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend-assets/js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend-assets/js/scripts.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIgGlP4x2CNrSRBfgfCgDtmJmQ5-jkvB0&libraries=places&callback=initAutocomplete"></script>
    <script type="text/javascript" src="{{asset('frontend-assets/js/map-single.js')}}"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script>
    <script src="{{asset('frontend-assets/bootstrap/js/bootstrap.min.js')}}" ></script>
    <script>
    var x = 0;
  $(document).ready(function(){
  // $(document).on('click','.children .quantity-up',function(){
    var maxField = 5; //Input fields increment limitation
    var addButton = $('.children .quantity-up'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    $(addButton).click(function(){
        //Check maximum number of input fields
      if(x < maxField){
        x++; //Increment field counter
        // alert(x);

    var fieldHTML = '<div class="quantity-item age-items child'+x+'">'+
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

    $('#field_wrapper').append(fieldHTML); //Add field html
  }

});
    //Once remove button is clicked
    $(document).on('click', '.children .quantity-down', function(e){
      e.preventDefault();
      // alert(x);
      $('.child'+x).remove();
      // $(this).parent('div').remove(); //Remove field html
      if (x>=0) {
        x--; //Decrement field counter
      }
    });
  });

  function search(container,value){
    // alert(value);
    var search  = value;
    var token   = "{{ csrf_Token() }}";
    $.ajax({
      url:"{{url('/getcities')}}",
      type:"POST",
      data:{search:search,_token:token},
      success:function(res){
       var searchData = JSON.parse(res);
       console.log(searchData);
        // $('#'+container).html(searchData);
        // $('#'+container).css('display','block');
        $('#search-container').html(searchData);
        $('#search-container').show();
      }
    });
  }
</script>
    @yield('script')
  </body>
</html>
