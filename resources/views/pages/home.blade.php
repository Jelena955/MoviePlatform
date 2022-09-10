@extends('layouts.layout')

@section('title') Home @endsection
@section('description') The main page. @endsection
@section('keywords') movie, online, home, best, popular @endsection

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="{{asset('assets/images/slider50.png')}}" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('assets/images/slider2.jpg')}}" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="{{asset('assets/images/slider4jpg.jpg')}}" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    <div class="container">
        <div class="row justify-content-between mt-3">
            <div class="container">
                <div class="row justify-content-between mt-3" id="movieslatest">
                    <h2>Latest </h2>
                    @foreach($moviesLatest as $movie)
                        @include('partials.movie-card')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-between mt-3">
            <div class="container">
                <div class="row justify-content-between mt-3" id="moviespopular">
                    <h2>Popular </h2>
                    @foreach($moviesPopular as $movie)
                        @include('partials.movie-card')
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-5">
        <div class="row justify-content-between mt-3">
            <div class="container">
                <div class="row justify-content-between mt-3" id="moviesbest">
                    <h2>Best rated</h2>
                    @foreach($moviesBest as $movie)
                        @include('partials.movie-card')
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection


