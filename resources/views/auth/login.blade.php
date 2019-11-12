<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
        .admin-login {font-size:0; /* Fixes inline block spacing */  }
        .admin-login div {
            width: 100%;
        }
        .card-header a{
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
.admin-login span { width:50%; display:inline-block; }
.admin-login span.align-right { text-align:right; }

.admin-login span a { font-size:14px; }
    </style>
</head>
<body>
<div class="splash-container">
    <div class="card ">
        <div class="card-header text-center">
            <a href="">
                ERP
            </a>
            <span class="splash-description">Please enter your user information.</span>
        </div>
{{--        {{dd(Hash::make('Testing123!'))}}--}}
        <div class="card-body">
            {{--@if($message = Session::get('error'))--}}
                {{--<div class="alert alert-danger">--}}
                    {{--<button type="button" class="close" data-dismiss="alert">x</button>--}}
                    {{--<strong>{{ $message }}</strong>--}}
                {{--</div>--}}
            {{--@endif--}}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <input class="form-control form-control-lg" id="email" name="email" type="email" placeholder="Email" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" id="password" name="password" type="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" value="1" name="remember" type="checkbox"><span class="custom-control-label">Remember Me</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
            </form>
        </div>
        <div class="card-footer bg-white p-0 admin-login">
            <div class="card-footer-item card-footer-item-bordered ">
                <span>
                    <a href="#" class="footer-link">Forgot Password</a>
                </span>
                <span>
                    <a href="{{ url('/client/login') }}" class="footer-link align-right">Login As Client</a>
                </span>
            </div>
        </div>
    </div>
</div>
<script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
