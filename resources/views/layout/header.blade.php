
<header>
    <!-- Top Header Section Start -->
    <!-- Logo Section Header Start -->
    <div class="logo-sec-wraper">
        <div class="container">
            <div class="row">
                <div class="col-1 col-sm-1 col-md-1 col-lg-1 logo-sec">
                        <a href="http://presidentofindia.nic.in/" class="logo-align" title="Rashtrapati Bhavan" target="_blank">
                            <img src="{{ asset('storage/img_5.png') }}" alt="emblem" style="height: 100px;">
                        </a>
                </div>
                <div class="col-2 col-sm-2 col-md-2 col-lg-2 logo-sec">
                    <h4 style="margin-top: 5%;font-family: 'Times New Roman', serif;font-size: 200%;margin-left: -15%">Rashtrapati Bhavan</h4>
                </div>
                <div class="col-2 col-sm-2 col-md-2 col-lg-2 logo-sec">
                </div>
                <div class="col-2 col-sm-2 col-md-2 col-lg-2 RBbuilding-sec wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
                    <a class="RB-building enlarge-hover " href='{{route('dashboard')}}' >
                        <img src="{{ asset('storage/img.png') }}" alt="emblem" style="margin-left: 20%">
                    </a>
                </div>
                <div class="col-3 col-sm-3 col-md-3 col-lg-3 logo-sec">
                </div>
                <div class="col-1 col-sm-1 col-md-1 col-lg-1" style="margin-top: 1%">
                    <div class="logo-des wow fadeInRight floatright">
                        <a class="logo-align wow fadeInLeft" style="cursor: pointer">
                            <img src="{{ asset('storage/icons8-apply-64.png') }}" alt="emblem" style="width: 65px">
                        </a>
                    </div>
                </div>
                <div class="col-1 col-sm-1 col-md-1 col-lg-1 logo-sec" style="margin-top: 1.5%">
                <div class="brand-text" >
                    <h4>
                        <span style="font-family: 'Times New Roman', serif;font-size: 160%;;margin-left: -15%">IIAU</span>
                    </h4>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Logo Section Header End -->
    <!-- Top Header Section End -->
</header>


<nav class="main-header navbar navbar-expand navbar-light font-weight-bold" style="background-color: #4d305c;">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-bold text-white" href="#">

                    Welcome, &nbsp;{{$user->name}}</a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                    <a class="nav-link text-white text-bold fontd" href='{{route('user.change_password')}}'>Change Password </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white text-bold ">|</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white text-bold fontd" href="{{route('logout')}}">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
