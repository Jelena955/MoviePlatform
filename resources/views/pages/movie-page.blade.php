@extends('layouts.layout')
@section('title') @endsection
@section('description') @endsection
@section('keywords')@endsection
@section('content')
    <div class="container">
        <div class="mx-auto align-top" id="modalRating" style="z-index: 2;display:none">
            <div class="modal-body" id="modal_body">
                <p>Rating:</p>
                <fieldset class="rate">
                    <input type="radio" id="rating10" name="rating" value="5" @if(isset($userRating[0])) @if($userRating[0]->rating   == 5) checked = "checked" @endif @endif /><label for="rating10" title="5 stars"></label>
                    <input type="radio" id="rating9" name="rating" value="4.5" @if(isset($userRating[0])) @if($userRating[0]->rating ==4.5) checked = "checked"  @endif @endif   /><label class="half" for="rating9" title="4 1/2 stars"></label>
                    <input type="radio" id="rating8" name="rating" value="4" @if(isset($userRating[0])) @if($userRating[0]->rating == 4)  checked = "checked"  @endif @endif /><label for="rating8" title="4 stars"></label>
                    <input type="radio" id="rating7" name="rating" value="3.5" @if(isset($userRating[0])) @if($userRating[0]->rating   ==3.5)  checked = "checked"  @endif @endif /><label class="half" for="rating7" title="3 1/2 stars"></label>
                    <input type="radio" id="rating6" name="rating" value="3" @if(isset($userRating[0])) @if($userRating[0]->rating   == 3) checked = "checked" @endif @endif /><label for="rating6" title="3 stars"></label>
                    <input type="radio" id="rating5" name="rating" value="2.5" @if(isset($userRating[0])) @if($userRating[0]->rating   ==2.5) checked = "checked"  @endif @endif /><label class="half" for="rating5" title="2 1/2 stars"></label>
                    <input type="radio" id="rating4" name="rating" value="2" @if(isset($userRating[0])) @if($userRating[0]->rating   ==2) checked = "checked" @endif @endif  /><label for="rating4" title="2 stars"></label>
                    <input type="radio" id="rating3" name="rating" value="1.5" @if(isset($userRating[0])) @if($userRating[0]->rating   ==1.5) checked = "checked" @endif @endif  /><label class="half" for="rating3" title="1 1/2 stars"></label>
                    <input type="radio" id="rating2" name="rating" value="1" @if(isset($userRating[0])) @if($userRating[0]->rating   ==1) checked = "checked" @endif @endif  /><label for="rating2" title="1 star"></label>
                    <input type="radio" id="rating1" name="rating" value="0.5" @if(isset($userRating[0])) @if($userRating[0]->rating   == 0.5) checked = "checked"  @endif @endif /><label class="half" for="rating1" title="1/2 star"></label>
                </fieldset>
                <p id="errors" style="color: crimson"></p>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModal" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add_rating">Rate</button>
                <button type="button" class="btn btn-primary btn-danger" id="delete_rating">Remove rating</button>
            </div>
        </div>
        <div class="mx-auto align-top" id="popup" style="z-index: 2;display:none"></div>
        <div class=" row mt-5 d-flex justify-content-around">
            <div class="col-xl-5 col-sm-12 mt-5" id="text" style=" width:50%; z-index: 1">
                <h1 class="title" style="max-width: 50%;">{{ $movie->title }}</h1>
                <h4><b>Year</b></h4>
                <p class="card-text">{{ $movie->year }}</p>
                <h4><b>Genres</b></h4>
                <p class="mt-3">@foreach($genres as $genre) {{ $genre->name }} @endforeach </p>
                <h4><b>Tags</b></h4>
                <p id="tagsless" class="mt-3"
                   style="max-width: 700px;">@foreach($tags as $tag)#{{ $tag->tag }}  @endforeach </p>
                               <p id="tagsmore" class="mt-3"#}
                                     {#                   style="max-width: 700px; display: none"> @foreach($tags as $tag)}#{{ $tag->tag }}  @endforeach </p>

                @if ($rating->ratings_avg_rating > 0 )
                    <p>Average rating: {{round($rating->ratings_avg_rating,1)}}</p>
                @for($j=1;$j<=round($rating->ratings_avg_rating,1);$j++)
                <i class="fa fa-star" aria-hidden="true"></i>
                    @endfor

                @if(floor($rating->ratings_avg_rating) < $rating->ratings_avg_rating )
                <i class="fa fa-star-half-o" aria-hidden="true"></i>
                @endif
                @else
                    <p>No one has rated yet
                    </p>

                @endif

                <div id="user_rating">
                    @if(\Illuminate\Support\Facades\Auth::check ())
                @if(isset($userRating[0]) && $userRating[0]->rating!=null)
                    <p>Your rating: {{round($userRating[0]->rating,1)}}</p>
                        <input type="hidden" id="rating" value="{{$movie->id}}">
                    @if ($userRating[0]->rating > 0 )
                        <h6>Click to change rating</h6>
                        @for($j=1;$j<=round($userRating[0]->rating,1);$j++)
                            <i class="fa fa-star user_rating" aria-hidden="true" class="btn" data-bs-toggle="modal" data-bs-target="#rating_modal"></i>
                        @endfor

                        @if(floor($userRating[0]->rating) < $userRating[0]->rating )
{{--                            <i class="fa fa-star-half-o" aria-hidden="true"></i>--}}
                                <i class="fa fa-star-half-o user_rating" aria-hidden="true" class="btn" data-bs-toggle="modal" data-bs-target="#rating_modal"></i>
                        @endif
                        <input type="hidden" id="user_rating" value="{{$userRating[0]->id}}"></input>

                    @endif
                @else
                    <p class="mt-3">Add your rating:</p>
                    <i class="fa fa-star empty_star" aria-hidden="true" class="btn modal" id="modal" data-bs-toggle="modal" data-bs-target="#rating_modal"></i>
                @endif

                @endif
                </div>
{{--                ({{ movie.count != 0 ?  movie.count ~ ' reviews' : "Movie is not rated yet" }})--}}


            @if(\Illuminate\Support\Facades\Auth::check ())

                <form class="mt-5" style="background-color: black" method="" > <select class="js-example-basic-multiple" id="tagsearch" name="tags[]" multiple="multiple">
                        <option value="AL">Alabama</option>
                        ...
                        <option value="WY">Wyoming</option>
                        <input type="hidden" id="idmovie" name="idmovie" value="{{ $movie->id }}">
                        <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                    </select>
                    <button class="ml-5 click"type="button"  id="tagButton">Add tags</button>

                </form>

                @endif
            </div>

            <div class="d-flex col-xl-5 col-sm-12 justify-content-center mt-5" id="imgmovie"><img src="{{asset ('assets/images/'.$movie->img)}}"
                                                                                                  style="float:right;height: 500px !important;"
                                                                                                  class="img-thumbnail "
                                                                                                  alt="..."></div>
           </div>

    </div>

    <div style="background-color: rgb(83, 37, 73)">


    </div>

    <h1 style="color: white"></h1>
@endsection
