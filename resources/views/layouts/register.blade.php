@extends('layouts.default')
@section('css')
    <style>
        .form-group.required label:after {
            content: " *";
            color: red;
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <h2>Registered!!</h2>
            <p>
                Your user have been created.<a href="{{route(client.login)}}">Login</a> with following credentials:
            </p>
            <span><h4>Email:</h4></span><span><p>{{$user->email}}</p></span>
            <span><h4>Password:</h4></span><span><p>click123!</p></span>

        </div>
    </div>
@endsection
