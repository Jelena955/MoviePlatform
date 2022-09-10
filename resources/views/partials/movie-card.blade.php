<div class="card mt-3 col-md-3" style="width: 18rem; background-color:black; border: 1px solid gray; box-shadow:5px 5px 20px 5px rgba(245, 230, 83, 0.3);">
    <img src="{{asset ('assets/images/'.$movie->img)}}" class="card-img-top" alt="..." style="max-height: 300px;">
    <div class="card-body">
        <a style="text-decoration: none" href="/movie-page/{{ $movie->id }}"><h5
                class="movielink card-title">{{ $movie->title }}</h5>
        </a>
        <p class="card-text">{{ $movie->year }}</p>

            @if ($movie->ratings_avg_rating > 0 )
            <h6>Average rating: {{round($movie->ratings_avg_rating,1)}}
            @for($j=1;$j<=round($movie->ratings_avg_rating,1);$j++)
            <i class="fa fa-star" aria-hidden="true"></i>
            @endfor
            @if(floor($movie->ratings_avg_rating) < $movie->ratings_avg_rating )
            <i class="fa fa-star-half-o" aria-hidden="true"></i>
            @endif
            @else
                <h6>No one has rated yet
                </h6>
            @endif
        </h6>

    </div>
</div>
