<div class="sidebar" data-color="#072f44" data-active-color="danger">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="{{url('/')}}" class="simple-text logo-mini">
          <div class="logo-image-small">
          
          </div>
        </a>
        <a href="{{url('/')}}" class="simple-text logo-normal">
          Hotel Booking
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
        @if(Session::get('chat_admin')->role =='admin')
          <li class="active ">
            <a href="{{url('/dashboard')}}">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          @endif
          @if(Session::get('chat_admin')->role =='admin' || Session::get('chat_admin')->role =='a')
          <li>
            <a href="#manageJobs"  data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="manageJobs">
              <i class="nc-icon nc-bell-55"></i>
              <p>Booking Management</p>
            </a>
            <ul class="collapse" id="manageJobs">
              <li><a href="{{url('dashboard/')}}">Booking</a></li>
            </ul>

          </li>
           @endif
         
           @if(Session::get('chat_admin')->role =='admin')
        
          <li>
            <a class="" data-toggle="collapse" href="#blog" role="button" aria-expanded="false" aria-controls="customer">
              <i class="nc-icon nc-diamond"></i>
              <p>Blogs</p>
            </a>
            <ul class="collapse" id="blog">
              <li><a href="{{url('/dashboard/blogs')}}">Blogs</a></li>
            </ul>
          </li>
          <li>
            <a href="#manageUsers"  data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="manageUsers">
              <i class="nc-icon nc-single-02"></i>
              <p>User Management</p>
            </a>
            <ul class="collapse" id="manageUsers">
              <li><a href="{{url('dashboard/user_management')}}">Add New User </a></li>
            </ul>
          </li>
         
          @endif
           @if(Session::get('chat_admin')->role =='admin' || Session::get('chat_admin')->role =='c')
          <li>
            <a href="">
              <i class="nc-icon nc-single-02"></i>
              <p>Payments</p>
            </a>
          </li>
          @endif
           @if(Session::get('chat_admin')->role =='admin')
          <li>
            <a href="">
              <i class="nc-icon nc-single-02"></i>
              <p>Help Menu</p>
            </a>
          </li>
          @endif
		   <li>
            <a href="{{ url('dashboard/logout') }}">
              <i class="nc-icon nc-single-02"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
