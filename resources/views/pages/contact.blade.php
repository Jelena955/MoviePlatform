@extends('layouts.layout')

@section('title') Contact @endsection
@section('description') Contact page. @endsection
@section('keywords') contact, online, message @endsection
@section('content')
    <div style="height: 100vh;" class="d-flex align-items-center">
        <div style="max-width: 600px;" class="w-100 m-auto bg-white p-3 rounded ">
            <h1 class="h3 mt-3 mb-3 text-center text-black">Contact us</h1>
            <form  action="contact" method="post">
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
                        <input class="form-control" type="text" name="name" id="name"  placeholder="Name">
                    </div>
                </div>
                <div class="mb-4 row">
                    <label class="col-sm-2 form-label" for="gender">Message</label>
                    <div class="col-sm-10">
                        <textarea name="message" id="message"></textarea>

                    </div>
                </div>


                <div class="mt-3">
                    <input class="btn btn-lg btn-dark w-100" type="submit" value="Send">
                </div>
                <hr>
            </form>
        </div>
    </div>
@endsection

