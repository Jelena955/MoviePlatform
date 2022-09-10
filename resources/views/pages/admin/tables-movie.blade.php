@extends('layouts.layout-admin')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Movie Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Movie</th>
                                    <th>Year</th>
                                    <th>Genres</th>
                                    <th>Tags</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($movies as  $movie)
                                <tr>
                                    <td>{{$movie->id}}</td>
                                    <td>{{$movie->title}}</td>
                                    <td>{{$movie->year}}</td>
                                    <td>@if(count($movie->genre)!=0)@foreach($movie->genre as $genre)@if($loop->last){{$genre->name}} @else{{$genre->name}}, @endif
                                        @endforeach @else <h6>No genres yet</h6> @endif</td>
                                    <td>@if(count($movie->tag)!=0)@foreach($movie->tag as $tag)@if($loop->last) {{$tag->tag}} @else {{$tag->tag}},  @endif @endforeach @else No tags yet @endif</td>
                                    <td><form method="post" action="/editMovieForm/{{$movie->id}}">@csrf<input type="hidden" name="idmovie" value="{{$movie->id}}"><button>Edit</button></form></td>
                                    <td><button><a href="/deleteMovie/{{$movie->id}}">Delete</a></button></td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <button><a href="/insertMovieForm">Insert movie</a></button>
                        </div>
                    </div>
                    <!-- /.card -->
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
