@extends('layouts.layout')

@section('title') All movies @endsection
@section('description') All movies page. @endsection
@section('keywords') all, online, movie, rating, year @endsection
@section('content')
    <div class="container">
        <label class="mr-5" style="background-color: black; color: rgba(245, 230, 83, 0.5);">Chose category: </label>
        <select style="background-color: #0a0e14; color:rgba(245, 230, 83, 0.5); "  class='mt-5' id="filter">
            <option value="all">All</option @foreach($genres as $genre)<option value="{{$genre->id}}">{{$genre->name}}</option>@endforeach</select>
        <label class="mr-5" style="background-color: black; color: rgba(245, 230, 83, 0.5);">Sort: </label>
        <select style="background-color: #0a0e14; color:rgba(245, 230, 83, 0.5); "  class='mt-5' id="sort">
            <option value="def">Default</option>
            <option value="lat">Latest</option>
            <option value="old">Oldest</option>
        </select>
        <div class="row justify-content-between mt-3" id="movies">

            @foreach($movies as $movie)
                @include('partials.movie-card')

            @endforeach


            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-5 mb-5" style="background-color: black; color: yellow" >
                {{$movies->links()}}
            </div>

        </div>

    </div>
    <nav aria-label="Page navigation example">
    </nav>
@endsection

