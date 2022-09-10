@extends('layouts.layout')
@section('title') Profile @endsection
@section('description') Profile. @endsection
@section('keywords') profile, online, edit @endsection
@section('content')
    <section class="content" style="min-height: 77.2vh">
        <div class="container-fluid">
            <div class="row">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-md-6">
                    <h1>Hello {{$user->name}}</h1>
                    @if($user->img!=null)
                        <img src="{{asset ('assets/images').'/'.$user->img}}" width="200px">
                    @else
                        <img src="{{asset ('assets/images/nouserimg.png')}}" width="200px">

                    @endif
                </div>
                    <div class="col-md-6">
                       <h2>{{$user->email}}</h2>
                        <button><a href="/editProfileForm" style="color:black;">Edit profile</a></button>
                    </div>
            </div>
        </div>
    </section>
@endsection

