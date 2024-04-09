
<header style="height: 120px;">
    <!-- Top Header Section End -->
    <!-- Logo Section Header Start -->
    <div class="logo-sec-wraper">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-5 col-lg-5 logo-sec">
                    <a  href="http://presidentofindia.nic.in/" class="logo-align enlarge-hover"  title="Rashtrapati Bhavan" target="_blank">
                        <img src="images/img_5.png" alt="emblem" style="height: 100px;">
                        <div class="brand-text">
                            <h4>
                                <!--राष्ट्रपति भवन-->
                                <span>Rashtrapati Bhavan</span>
                            </h4>
                        </div>
                    </a>
                </div>
                <div class="col-12 col-sm-12 col-md-2 col-lg-2 RBbuilding-sec wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;">
                    <a class="RB-building  enlarge-hover"  href='/dashboard' >
                        <img src="images/img.png" alt="emblem">
                    </a>
                </div>
                <div class="col-12 col-sm-12 col-md-5 col-lg-5">
                    <div class="logo-des  wow fadeInRight floatright">
                        <a class="logo-align wow fadeInLeft"  style="cursor: pointer" >
                            <img src="images/icons8-apply-64.png" alt="emblem" style="width: 65px" >
                            <div class="brand-text" style="padding-left: 1%">
                                <h4>
                                    <!--समेकित-->
                                    <span>IIAU</span>
                                </h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Logo Section Header End -->
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
                <a class="nav-link text-bold fontd" href='/dashboard'>Home </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white text-bold ">| </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-bold fontd" href="/logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>
