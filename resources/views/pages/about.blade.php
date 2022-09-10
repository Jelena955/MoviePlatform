@extends('layouts.layout')

@section('title') Home @endsection
@section('description') The main page. @endsection
@section('keywords') movie, online, home, best, popular @endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center ">
            <div class="w-50">
                <h2>Name:Jelena Naumovski</h2>
                <h2>Collage:Visoka ICT</h2>
                <img src="{{asset ('assets/images/profile1647167795.jpg')}}">
                <p><a href="https://github.com/Jelena955">Github</a></p>
                <p><a href="https://www.linkedin.com/in/jelena-naumovski-090b871bb/">LinkedIn</a></p>
                <p><a href="{{asset ('assets/Dokumentacija.pdf')}}">Dokumentacija</a></p>
            </div>
        </div>
    </div>
@endsection
