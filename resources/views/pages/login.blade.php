@extends('layouts.layout')
@section('title') Login @endsection
@section('description') Thelogin page. @endsection
@section('keywords') login, online @endsection

@section('content')
<div style="height: 100vh;" class="d-flex align-items-center">
    <div style="max-width: 600px;" class="w-100 m-auto bg-white p-3 rounded ">
        <h1 class="h3 mt-3 mb-3 text-center text-black">Sign in</h1>
        <form  action="login" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="mb-4 row">
                <label class="col-sm-2 form-label" for="email">Email</label>
                <div class="col-sm-10">
                    <input class="form-control" type="email" name="email" id="email"  placeholder="Email address">
                </div>
{{--                {% if data['email_error'] %}--}}
{{--                <p class="danger text-danger">{{ data['email_error']}}</p>--}}
{{--                {% endif %}--}}
            </div>
            <div class="mb-4 row">
                <label class="col-sm-2 form-label" for="password">Password</label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" name="password" id="password" placeholder="Password" >
                </div>
{{--                {% if data['password_error'] %}--}}
{{--                <p class="danger text-danger">{{ data['password_error'] }}</p>--}}
{{--                {% endif %}--}}
            </div>

            <div class="mt-3">
                <input class="btn btn-lg btn-dark w-100" type="submit" value="Sign in">
{{--                <button type="button">Sing in</button>--}}
            </div>
            <hr>
            <p> Not registered?</p><a href="/registerForm"><p>Register here</p></a>
        </form>
    </div>
</div>
@endsection

