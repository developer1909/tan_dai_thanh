<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{ (request()->routeIs(['dashboard'])) ? 'active' : '' }}">
                <a href="{{route('dashboard')}}" title="Dashboard">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
{{--            <li class="{{ (request()->routeIs(['orders.*'])) ? 'active' : '' }}">--}}
{{--                <a href="{{route('orders.create')}}" title="Orders list">--}}
{{--                    <span class="pcoded-micon"><i class="fa fa-plus-circle"></i></span>--}}
{{--                    <span class="pcoded-mtext">Tạo mới đơn hàng</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="{{ (request()->routeIs(['orders.*'])) ? 'active' : '' }}">--}}
{{--                <a href="{{route('orders.index')}}" title="Orders list">--}}
{{--                    <span class="pcoded-micon"><i class="icofont icofont-ui-note"></i></span>--}}
{{--                    <span class="pcoded-mtext">Danh sách đơn hàng</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="{{ (request()->routeIs(['surcharge_price.*'])) ? 'active' : '' }}">--}}
{{--                <a href="{{route('surcharge_price.index')}}" title="Surcharge price list">--}}
{{--                    <span class="pcoded-micon"><i class="icofont icofont-box"></i></span>--}}
{{--                    <span class="pcoded-mtext">Sản phẩm phụ thu</span>--}}
{{--                </a>--}}
{{--            </li>--}}
            <li class="{{ (request()->routeIs(['categories.*'])) ? 'active' : '' }}">
                <a href="{{route('categories.index')}}" title="Surcharge price list">
                    <span class="pcoded-micon"><i class="icofont icofont-clip-board"></i></span>
                    <span class="pcoded-mtext">Loại sản phẩm</span>
                </a>
            </li>
            <li class="{{ (request()->routeIs(['products.*'])) ? 'active' : '' }}">
                <a href="{{route('products.index')}}" title="Surcharge price list">
                    <span class="pcoded-micon"><i class="icofont icofont-clip-board"></i></span>
                    <span class="pcoded-mtext">Sản phẩm</span>
                </a>
            </li>
            <li class="{{ (request()->routeIs(['orders.*'])) ? 'active' : '' }}">
                <a href="{{route('orders.index')}}" title="Surcharge price list">
                    <span class="pcoded-micon"><i class="icofont icofont-clip-board"></i></span>
                    <span class="pcoded-mtext">Đơn hàng</span>
                </a>
            </li>
{{--            <li class="{{ (request()->routeIs(['administrators.*'])) ? 'active' : '' }}">--}}
{{--                <a href="{{route('administrators.index')}}">--}}
{{--                    <span class="pcoded-micon"><i class="fa fa-user-circle-o"></i></span>--}}
{{--                    <span class="pcoded-mtext">Quản trị viên</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="pcoded-hasmenu {{ (request()->routeIs(['users.*'])) ? 'active' : '' }}">--}}
{{--                <a href="javascript:void(0)">--}}
{{--                    <span class="pcoded-micon"><i class="fa fa-users"></i></span>--}}
{{--                    <span class="pcoded-mtext">Users</span>--}}
{{--                    <!-- <span class="pcoded-badge label label-warning">NEW</span> -->--}}
{{--                </a>--}}
{{--                <ul class="pcoded-submenu">--}}
{{--                    <li class="{{ (request()->routeIs(['users.patients.*'])) ? 'active' : '' }}">--}}
{{--                        <a href="{{route('users.patients.index')}}">--}}
{{--                            <span class="pcoded-mtext">Patient</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ (request()->routeIs(['users.pharmacies.*'])) ? 'active' : '' }}">--}}
{{--                        <a href="{{route('users.pharmacies.index')}}">--}}
{{--                            <span class="pcoded-mtext">Provider</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}


        </ul>

    </div>
</nav>
