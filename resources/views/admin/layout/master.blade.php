
<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.includes.head')

</head>

<body>
<!-- Pre-loader start -->
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
            <div class="ring">
                <div class="frame"></div>
            </div>
        </div>
    </div>
</div>
<!-- Pre-loader end -->
<div id="pcoded" class="pcoded">
    <div class="pcoded-overlay-box"></div>
    <div class="pcoded-container navbar-wrapper">

        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">

                <div class="navbar-logo">
                    <a class="mobile-menu" id="mobile-collapse" href="#!">
                        <i class="feather icon-menu"></i>
                    </a>
                    <a href="{{route('dashboard')}}">
                        CMS Tân Đại Thành
{{--                                                    <img class="img-fluid" src="{{asset('template_admin\files\assets\images\logo.png')}}" alt="RX App Logo">--}}
                    </a>
                    <a class="mobile-options">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                </div>

                <div class="navbar-container container-fluid">
                    <ul class="nav-left">
                        <li class="header-search">
                            <div class="main-search morphsearch-search">
                                <div class="input-group">
                                    <span class="input-group-addon search-close"><i class="feather icon-x"></i></span>
                                    <input type="text" class="form-control">
                                    <span class="input-group-addon search-btn"><i class="feather icon-search"></i></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#!" onclick="javascript:toggleFullScreen()">
                                <i class="feather icon-maximize full-screen"></i>
                            </a>
                        </li>
                    </ul>
{{--                    <ul class="nav-right">--}}
{{--                        <li class="user-profile header-notification">--}}
{{--                            <div class="dropdown-primary dropdown">--}}
{{--                                <div class="dropdown-toggle" data-toggle="dropdown">--}}
{{--                                    --}}{{--                                        <img src="{{asset('template_admin\files\assets\images\avatar-4.jpg')}}" class="img-radius" alt="User-Profile-Image">--}}
{{--                                    <span>{{auth('admin')->user()->name}}</span>--}}
{{--                                    <i class="feather icon-chevron-down"></i>--}}
{{--                                </div>--}}
{{--                                <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">--}}
{{--                                    <li>--}}
{{--                                        <a href="{{route('administrators.profile')}}">--}}
{{--                                            <i class="feather icon-user"></i> Thông tin cá nhân--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li>--}}
{{--                                        <a href="{{route('admin.logout')}}">--}}
{{--                                            <i class="feather icon-log-out"></i> Đăng xuất--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}

{{--                            </div>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
                </div>
            </div>
        </nav>
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                @include('admin.includes.sidebar')
                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <div class="main-body">

                            @yield('content')

                            <div id="styleSelector">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('admin.includes.scripts')

@yield('script')
</body>

</html>
