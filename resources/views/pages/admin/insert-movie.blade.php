@extends('layouts.layout-admin')
@section('content')
    <br style="height: 100vh;" class="d-flex align-items-center">
    <div style="max-width: 600px;" class="w-100 m-auto bg-white p-3 rounded ">
        <h1 class="h3 mt-3 mb-3 text-center text-black">Insert Movie</h1>
        <form  action="/insertMovie" method="post" enctype='multipart/form-data'>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="mb-4 row">
                <label class="col-sm-2 form-label" for="email">Title</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="title" id="title"  placeholder="Title">
                </div>
            </div>
            <div class="mb-4 row">
                <label class="col-sm-2 form-label" for="year">Year</label>
                <div class="col-sm-10">
                    <select class="js-example-basic-single" name="year" style="width: 75%">
                        @for($i=$year;$i>1940;$i--)

                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="mb-4 row">
                <label class="col-sm-2 form-label" for="image">Image</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" name="image" id="image" placeholder="Image" >
                </div>
            </div>
            <div class="mb-4 row">
                <label class="col-sm-2 form-label" for="genre">Genre</label>
                <div class="col-sm-10">
                    @foreach($genres as $genre)
                        <input type="checkbox" name="genre[]" value="{{$genre->id}}">  {{$genre->name}}
                    @endforeach

                </div>
            </div>


            <div class="mt-3">
                <input class="btn btn-lg btn-dark w-100" type="submit" value="Insert">
            </div>
            <hr>
        </form>
    </div>
</div>
@endsection
