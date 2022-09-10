@extends('layouts.layout')
@section('title') Register @endsection
@section('description') Register page @endsection
@section('keywords') register, online, name, email, password @endsection
@section('content')
    <div style="height: 100vh;" class="d-flex align-items-center">
        <div style="max-width: 600px;" class="w-100 m-auto bg-white p-3 rounded ">
            <h1 class="h3 mt-3 mb-3 text-center text-black">Register</h1>
            <form  action="register" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="mb-4 row">
                    <label class="col-sm-2 form-label" for="email">Email</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="email" name="email" id="email"  placeholder="Email address">
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-2 form-label" for="email">Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" id="name"  placeholder="Email address">
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-2 form-label" for="password">Password</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" name="password" id="password" placeholder="Password" >
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-2 form-label" for="password_confirmation">Password again</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Password again" >
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-2 form-label" for="gender">Gendre</label>
                    <div class="col-sm-10">
                        <select id="gender" name="gender"><option value="m">Male</option>
                        <option value="f">Female</option>
                        <option value="x">I do not want to say</option></select>

                    </div>
                </div>


                <div class="mt-3">
                    <input class="btn btn-lg btn-dark w-100" type="submit" value="Register">
                </div>
                <hr>
            </form>
        </div>

    </div>
@endsection

