@extends('layouts.layout')
@section('title') Edit profile @endsection
@section('description') Edit @endsection
@section('keywords') edit, online@endsection

@section('content')
<div style="height: 100vh;" class="d-flex align-items-center">
    <div style="max-width: 600px;" class="w-100 m-auto bg-white p-3 rounded ">
        <h1 class="h3 mt-3 mb-3 text-center text-black">Edit profile</h1>
        <form  action="/editProfile" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="mb-4 row">
                <label class="col-sm-2 form-label" for="email">Email</label>
                <div class="col-sm-10">
                    <input class="form-control" type="email" name="email" id="email" value="{{$user->email}}"  placeholder="Email address">
                </div>
            </div>
            <div class="mb-4 row">
                <label class="col-sm-2 form-label" for="password">Name</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" value="{{$user->name}}" name="name" id="name" placeholder="Password" >
                </div>
            </div>
            <div class="mb-4 row">
                <label class="col-sm-2 form-label" for="password">Password</label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" name="password" id="password" placeholder="Confirm your password" >
                    <p>You must confirm your password</p>
                </div>
            </div>
            <div class="mb-4 row">
                <label class="col-sm-2 form-label" for="password">Change password</label>
                <div class="col-sm-10">
                    <input class="form-control" type="password" name="newPassword" id="newPassword" placeholder="New password" >
                    <p>This field is not required</p>
                </div>
            </div>
            <div class="mb-4 row">
                <label class="col-sm-2 form-label" for="password">Image</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" name="image" id="image" placeholder="Image">
                    <p>This field is not required</p>
                </div>
            </div>

            <div class="mt-3">
                <input class="btn btn-lg btn-dark w-100" type="submit" value="Edit">
                {{--                <button type="button">Sing in</button>--}}
            </div>
            <hr>
        </form>
    </div>
</div>
@endsection

