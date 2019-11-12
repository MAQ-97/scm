<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ url('assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    {{--<link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">--}}
    {{--<link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">--}}
    <link rel="stylesheet"
          href="{{ url('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    {{--<link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">--}}
    <link rel="stylesheet" href="{{ url('assets/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ url('css/multiselect/bootstrap-multiselect.css') }}" type="text/css"/>
    <title>ERP</title>
    <style>
        .navbar-brand {
            display: inline-block;
            margin-right: 1rem;
            line-height: inherit;
            white-space: nowrap;
            padding: 11px 20px;
            font-size: 30px;
            text-transform: uppercase;
            font-weight: 700;
            color: #007bff;
        }
    </style>
</head>

<body>

<div class="dashboard-main-wrapper">
    <div class="dashboard-header">
        <nav class="navbar navbar-expand-lg bg-white fixed-top">
            <a class="navbar-brand">ERP</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">

                    <li class="nav-item dropdown nav-user">
                        <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false"><img src="{{asset('assets/images/avatar-1.jpg')}}"
                                                                           alt="" class="user-avatar-md rounded-circle"></a>
                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                             aria-labelledby="navbarDropdownMenuLink2">
                            <div class="nav-user-info">
                                <h5 class="mb-0 text-white nav-user-name"
                                    style="text-transform: capitalize">{{ \Illuminate\Support\Facades\Auth::user()->name }}</h5>
                                <span class="status"></span><span class="ml-2">Available</span>
                            </div>
                            <a class="dropdown-item" href="{{ route('account') }}"><i class="fas fa-user mr-2"></i>Account</a>
                            <a class="dropdown-item" href="{{ url('/logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit()"><i
                                    class="fas fa-power-off mr-2"></i>Logout</a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="nav-left-sidebar sidebar-dark">
        <div class="menu-list">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav flex-column">
                        <li class="nav-divider">
                            Menu
                        </li>
                        {{--                        <li class="nav-item ">--}}
                        {{--                            <a class="nav-link @if(Route::current()->getName() == 'dashboard' ) active @endif" href="{{ route('dashboard') }}"><i class="fa fa-fw fa-home"></i>Dashboard <span class="badge badge-success"</span></a>--}}
                        {{--                        </li>--}}
                        @role('admin')
                        <li class="nav-item ">
                            <a class="nav-link @if(Route::current()->getName() == 'users.list' || Route::current()->getName() == 'user.add' ) active @endif"
                               href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1"
                               aria-controls="submenu-1"><i class="fa fa-fw fa-users"></i>Users <span
                                    class="badge badge-success">6</span></a>
                            <div id="submenu-1" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link @if(Route::current()->getName() == 'users.list' ) active @endif"
                                           href="{{ route('users.list') }}">All Users</a>
                                        <a class="nav-link @if(Route::current()->getName() == 'user.add' ) active @endif"
                                           href="{{ route('user.add') }}">Add User</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link @if(Route::current()->getName() == 'category.list' || Route::current()->getName() == 'category.add' ) active @endif"
                               href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2"
                               aria-controls="submenu-2"><i class="fa fa-fw fa-user-circle"></i>Categories <span
                                    class="badge badge-success">6</span></a>
                            <div id="submenu-2" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link @if(Route::current()->getName() == 'category.list' ) active @endif"
                                           href="{{ route('category.list') }}">All Categories</a>
                                        <a class="nav-link @if(Route::current()->getName() == 'category.add' ) active @endif"
                                           href="{{ route('category.add') }}">Add Category</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link @if(Route::current()->getName() == 'supplies.list' || Route::current()->getName() == 'supplies.add' ) active @endif"
                               href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5"
                               aria-controls="submenu-4"><i class="fa fa-fw fa-user-circle"></i>Supplies<span
                                    class="badge badge-success">6</span></a>
                            <div id="submenu-5" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link @if(Route::current()->getName() == 'supplies.list' ) active @endif"
                                           href="{{ route('supplies.list') }}">All supplies</a>

                                        <a class="nav-link @if(Route::current()->getName() == 'supplies.add' ) active @endif"
                                           href="{{ route('supplies.add') }}">Add Supplies</a>

                                        <a class="nav-link @if(Route::current()->getName() == 'supplies.verify' ) active @endif"
                                           href="{{ route('supplies.verify') }}">Verify Supply</a>

                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link @if(Route::current()->getName() == 'products.list' || Route::current()->getName() == 'product.add' ) active @endif"
                               href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5"
                               aria-controls="submenu-4"><i class="fa fa-fw fa-user-circle"></i>Products<span
                                    class="badge badge-success">6</span></a>
                            <div id="submenu-5" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link @if(Route::current()->getName() == 'products.list' ) active @endif"
                                           href="{{ route('products.list') }}">All Products</a>

                                        <a class="nav-link @if(Route::current()->getName() == 'product.add' ) active @endif"
                                           href="{{ route('product.add') }}">Add Product</a>

                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                </li>
                @endrole

                {{--                        <li class="nav-item ">--}}
                {{--                            <a class="nav-link @if(Route::current()->getName() == 'products.list' || Route::current()->getName() == 'product.add' ) active @endif"--}}
                {{--                               href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5"--}}
                {{--                               aria-controls="submenu-4"><i class="fa fa-fw fa-user-circle"></i>Products<span--}}
                {{--                                    class="badge badge-success">6</span></a>--}}
                {{--                            <div id="submenu-5" class="collapse submenu" style="">--}}
                {{--                                <ul class="nav flex-column">--}}
                {{--                                    <li class="nav-item">--}}
                {{--                                        <a class="nav-link @if(Route::current()->getName() == 'products.list' ) active @endif"--}}
                {{--                                           href="{{ route('products.list') }}">All Products</a>--}}

                {{--                                        <a class="nav-link @if(Route::current()->getName() == 'product.add' ) active @endif"--}}
                {{--                                           href="{{ route('product.add') }}">Add Product</a>--}}

                {{--                                    </li>--}}
                {{--                                </ul>--}}
                {{--                            </div>--}}
                {{--                        </li>--}}


                </ul>

        </div>
        </nav>
    </div>
</div>


<div class="dashboard-wrapper">
{{--    </div>--}}
{{--</div>--}}
