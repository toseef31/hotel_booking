@extends('frontend.layouts.master')
@section('content')
<!--  wrapper  -->
<div id="wrapper">
  <!-- content-->
  <div class="content">
    <!-- section-->
    <section class="flat-header color-bg adm-header">
      <div class="wave-bg wave-bg2"></div>
      <div class="container">
        <div class="dasboard-wrap fl-wrap">
          <div class="dasboard-breadcrumbs breadcrumbs"><a href="#">Home</a><a href="#">Dashboard</a><span>Profile page</span></div>
          <!--dasboard-sidebar-->
          <div class="dasboard-sidebar">
            <div class="dasboard-sidebar-content fl-wrap">
              <div class="dasboard-avatar">
                <img src="http://easybook.kwst.net/images/avatar/4.jpg" alt="">
              </div>
              <div class="dasboard-sidebar-item fl-wrap">
                <h3>
                <span>Welcome </span>
                Jessie Manrty
                </h3>
              </div>
              <a href="dashboard-add-listing.html" class="ed-btn">Add Hotel</a>
              <div class="user-stats fl-wrap">
                <ul>
                  <li>
                    Listings
                    <span>4</span>
                  </li>
                  <li>
                    Bookings
                    <span>32</span>
                  </li>
                  <li>
                    Reviews
                    <span>9</span>
                  </li>
                </ul>
              </div>
              <a href="#" class="log-out-btn color-bg">Log Out <i class="far fa-sign-out"></i></a>
            </div>
          </div>
          <!--dasboard-sidebar end-->
          <!-- dasboard-menu-->
          <div class="dasboard-menu">
            <div class="dasboard-menu-btn color3-bg">Dashboard Menu <i class="fal fa-bars"></i></div>
            <ul class="nav nav-tabs dasboard-menu-wrap" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active user-profile-act" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="booking-tab" data-toggle="tab" href="#booking" role="tab" aria-controls="booking" aria-selected="false">Booking</a>
              </li>
            </ul>
            

            <div class="dasboard-menu-btn color3-bg">Dashboard Menu <i class="fal fa-bars"></i></div>
            <!-- <ul class="dasboard-menu-wrap">
              <li>
                <a href="dashboard.html" class="user-profile-act"><i class="far fa-user"></i>Profile</a>
                <ul>
                  <li><a href="dashboard-myprofile.html">Edit profile</a></li>
                  <li><a href="dashboard-password.html">Change Password</a></li>
                </ul>
              </li>
              <li><a href="dashboard-messages.html"><i class="far fa-envelope"></i> Messages <span>3</span></a></li>
              <li>
                <a href="dashboard-listing-table.html"><i class="far fa-th-list"></i> My listigs  </a>
                <ul>
                  <li><a href="#">Active</a><span>5</span></li>
                  <li><a href="#">Pending</a><span>2</span></li>
                  <li><a href="#">Expire</a><span>3</span></li>
                </ul>
              </li>
              <li><a href="dashboard-bookings.html"> <i class="far fa-calendar-check"></i> Bookings <span>2</span></a></li>
              <li><a href="dashboard-review.html"><i class="far fa-comments"></i> Reviews </a></li>
            </ul> -->
          </div>
          <!--dasboard-menu end-->
          <!--Tariff Plan menu-->
          <div   class="tfp-btn"><span>Tariff Plan : </span> <strong>Extended</strong></div>
          <div class="tfp-det">
            <p>You Are on <a href="#">Extended</a> . Use link bellow to view details or upgrade. </p>
            <a href="#" class="tfp-det-btn color2-bg">Details</a>
          </div>
          <!--Tariff Plan menu end-->
        </div>
      </div>
    </section>
    <!-- section end-->
    <!-- section-->
    <section class="middle-padding">
      <div class="container">
        <!--dasboard-wrap-->
        <div class="dasboard-wrap fl-wrap">
          <!-- Tabs content -->
          <div class="tab-content show" id="myTabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
              <!-- dashboard-content-->
              <div class="dashboard-content fl-wrap">
                <div class="box-widget-item-header">
                  <h3> Your Profile</h3>
                </div>
                <!-- profile-edit-container-->
                <div class="profile-edit-container">
                  <div class="custom-form">
                    <label>Your Name <i class="far fa-user"></i></label>
                    <input type="text" placeholder="Jessie Manrty" value=""/>
                    <label>Email Address<i class="far fa-envelope"></i>  </label>
                    <input type="text" placeholder="JessieManrty@domain.com" value=""/>
                    <label>Phone<i class="far fa-phone"></i>  </label>
                    <input type="text" placeholder="+7(123)987654" value=""/>
                    <label> Adress <i class="fas fa-map-marker"></i>  </label>
                    <input type="text" placeholder="USA 27TH Brooklyn NY" value=""/>
                    <label> Website <i class="far fa-globe"></i>  </label>
                    <input type="text" placeholder="themeforest.net" value=""/>
                    <div class="row">
                      <div class="col-sm-9">
                        <label> Notes</label>
                        <textarea cols="40" rows="3" placeholder="About Me"></textarea>
                      </div>
                      <div class="col-sm-3">
                        <label>Change Avatar</label>
                        <div class="add-list-media-wrap">
                          <form class="fuzone">
                            <div class="fu-text">
                              <span><i class="fal fa-image"></i> Click here or drop files to upload</span>
                            </div>
                            <input type="file" class="upload">
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- profile-edit-container end-->
                <div class="box-widget-item-header mat-top">
                  <h3>Your  Tariff Plan</h3>
                </div>
                <!-- profile-edit-container-->
                <div class="profile-edit-container add-list-container">
                  <div class="custom-form">
                    <div class="row">
                      <!--col -->
                      <div class="col-md-4">
                        <div class="add-list-media-header">
                          <label class="radio inline">
                            <input type="radio" name="gender">
                            <span>Basic 99$</span>
                          </label>
                        </div>
                      </div>
                      <!--col end-->
                      <!--col -->
                      <div class="col-md-4">
                        <div class="add-list-media-header">
                          <label class="radio inline">
                            <input type="radio" name="gender"  checked>
                            <span>Extended 99$</span>
                          </label>
                        </div>
                      </div>
                      <!--col end-->
                      <!--col -->
                      <div class="col-md-4">
                        <div class="add-list-media-header">
                          <label class="radio inline">
                            <input type="radio" name="gender">
                            <span>Professional 149$</span>
                          </label>
                        </div>
                      </div>
                      <!--col end-->
                    </div>
                  </div>
                </div>
                <!-- profile-edit-container end-->
                <div class="box-widget-item-header mat-top">
                  <h3>Your  Socials</h3>
                </div>
                <!-- profile-edit-container-->
                <div class="profile-edit-container">
                  <div class="custom-form">
                    <label>Facebook <i class="fab fa-facebook"></i></label>
                    <input type="text" placeholder="https://www.facebook.com/" value=""/>
                    <label>Twitter<i class="fab fa-twitter"></i>  </label>
                    <input type="text" placeholder="https://twitter.com/" value=""/>
                    <label>Vkontakte<i class="fab fa-vk"></i>  </label>
                    <input type="text" placeholder="https://vk.com" value=""/>
                    <label> Instagram <i class="fab fa-instagram"></i>  </label>
                    <input type="text" placeholder="https://www.instagram.com/" value=""/>
                    <button class="btn    color2-bg  float-btn">Save Changes<i class="fal fa-save"></i></button>
                  </div>
                </div>
                <!-- profile-edit-container end-->
              </div>
              <!-- dashboard-list-box end-->
            </div>
            <div class="tab-pane fade hide" id="booking" role="tabpanel" aria-labelledby="booking-tab">
              <!-- dashboard-content--> 
              <div class="dashboard-content fl-wrap">
                  <div class="dashboard-list-box fl-wrap">
                      <div class="dashboard-header fl-wrap">
                          <h3>Bookings</h3>
                      </div>
                      <!-- dashboard-list end-->    
                      <div class="dashboard-list">
                          <div class="dashboard-message">
                              <span class="new-dashboard-item">New</span>
                              <div class="dashboard-message-avatar">
                                  <img src="http://easybook.kwst.net/images/avatar/3.jpg" alt="">
                              </div>
                              <div class="dashboard-message-text">
                                  <h4>Andy Smith - <span>27 December 2018</span></h4>
                                  <div class="booking-details fl-wrap">
                                      <span class="booking-title">Listing Item :</span> :
                                      <span class="booking-text"><a href="listing-sinle.html">Premium Plaza Hotel</a></span>
                                  </div>
                                  <div class="booking-details fl-wrap">
                                      <span class="booking-title">Persons :</span>   
                                      <span class="booking-text">4 Peoples</span>
                                  </div>
                                  <div class="booking-details fl-wrap">
                                      <span class="booking-title">Booking Date :</span>   
                                      <span class="booking-text">02.03.2018  - 10.03.2018</span>
                                  </div>
                                  <div class="booking-details fl-wrap">                                                               
                                      <span class="booking-title">Mail :</span>  
                                      <span class="booking-text"><a href="#" target="_top">yormail@domain.com</a></span>
                                  </div>
                                  <div class="booking-details fl-wrap">
                                      <span class="booking-title">Phone :</span>   
                                      <span class="booking-text"><a href="tel:+496170961709" target="_top">+496170961709</a></span>
                                  </div>
                                  <div class="booking-details fl-wrap">
                                      <span class="booking-title">Payment State :</span> 
                                      <span class="booking-text"> <strong class="done-paid">Paid  </strong>  using Paypal</span>
                                  </div>
                                  <span class="fw-separator"></span>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere convallis purus non cursus. Cras metus neque, gravida sodales massa ut. </p>
                              </div>
                          </div>
                      </div>
                      <!-- dashboard-list end-->    
                      <!-- dashboard-list end-->    
                      <div class="dashboard-list">
                          <div class="dashboard-message">
                              <div class="dashboard-message-avatar">
                                  <img src="http://easybook.kwst.net/images/avatar/2.jpg" alt="">
                              </div>
                              <div class="dashboard-message-text">
                                  <h4>Andy Smith - <span>27 December 2018</span></h4>
                                  <div class="booking-details fl-wrap">
                                      <span class="booking-title">Listing Item :</span>  
                                      <span class="booking-text"><a href="listing-sinle.html">Moonlight Hotel</a></span>
                                  </div>
                                  <div class="booking-details fl-wrap">
                                      <span class="booking-title">Persons :</span>   
                                      <span class="booking-text">4 Peoples</span>
                                  </div>
                                  <div class="booking-details fl-wrap">
                                      <span class="booking-title">Booking Date :</span>  
                                      <span class="booking-text">02.03.2018  - 10.03.2018</span>
                                  </div>
                                  <div class="booking-details fl-wrap">                                                               
                                      <span class="booking-title">Mail :</span>  
                                      <span class="booking-text"><a href="#" target="_top">yormail@domain.com</a></span>
                                  </div>
                                  <div class="booking-details fl-wrap">
                                      <span class="booking-title">Phone :</span>  
                                      <span class="booking-text"><a  href="tel:+496170961709" target="_top">+496170961709</a></span>
                                  </div>
                                  <div class="booking-details fl-wrap">
                                      <span class="booking-title">Payment State :</span> 
                                      <span class="booking-text"> <strong class="done-paid">Paid  </strong>  using Paypal</span>
                                  </div>
                                  <span class="fw-separator"></span>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere convallis purus non cursus. Cras metus neque, gravida sodales massa ut. </p>
                              </div>
                          </div>
                      </div>
                      <!-- dashboard-list end-->                                             
                      <!-- dashboard-list end-->    
                      <div class="dashboard-list">
                          <div class="dashboard-message">
                              <div class="dashboard-message-avatar">
                                  <img src="http://easybook.kwst.net/images/avatar/avatar-bg.png" alt="">
                              </div>
                              <div class="dashboard-message-text">
                                  <h4>Andy Smith - <span>27 December 2018</span></h4>
                                  <div class="booking-details fl-wrap">
                                      <span class="booking-title">Listing Item :</span>  
                                      <span class="booking-text"><a href="listing-sinle.html">Moonlight Hotel</a></span>
                                  </div>
                                  <div class="booking-details fl-wrap">
                                      <span class="booking-title">Persons :</span>   
                                      <span class="booking-text">4 Peoples</span>
                                  </div>
                                  <div class="booking-details fl-wrap">
                                      <span class="booking-title">Booking Date :</span>   
                                      <span class="booking-text">02.03.2018  - 10.03.2018</span>
                                  </div>
                                  <div class="booking-details fl-wrap">                                                               
                                      <span class="booking-title">Mail :</span>  
                                      <span class="booking-text"><a href="#" target="_top">yormail@domain.com</a></span>
                                  </div>
                                  <div class="booking-details fl-wrap">
                                      <span class="booking-title">Phone :</span>  
                                      <span class="booking-text"><a  href="tel:+496170961709" target="_top">+496170961709</a></span>
                                  </div>
                                  <div class="booking-details fl-wrap">
                                      <span class="booking-title">Payment State :</span> 
                                      <span class="booking-text"> <strong class="done-paid">Paid  </strong>  using Paypal</span>
                                  </div>
                                  <span class="fw-separator"></span>
                                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc posuere convallis purus non cursus. Cras metus neque, gravida sodales massa ut. </p>
                              </div>
                          </div>
                      </div>
                      <!-- dashboard-list end-->                                            
                  </div>
                  <!-- pagination-->
                  <div class="pagination">
                      <a href="#" class="prevposts-link"><i class="fa fa-caret-left"></i></a>
                      <a href="#" class="current-page">1</a>
                      <a href="#">2</a>
                      <a href="#">3</a>
                      <a href="#">4</a>
                      <a href="#" class="nextposts-link"><i class="fa fa-caret-right"></i></a>
                  </div>
              </div>
              <!-- dashboard-list-box end--> 
            </div>
          </div>
          <!-- End tab content -->
        </div>
        <!-- dasboard-wrap end-->
      </div>
    </section>
    <div class="limit-box fl-wrap"></div>
  </div>
  <!-- content end-->
</div>
<!--wrapper end -->
@endsection
@section('script')

@endsection