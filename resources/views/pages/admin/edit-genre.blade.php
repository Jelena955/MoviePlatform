@extends('layouts.layout-admin')
@section('content')
    <br style="height: 100vh;" class="d-flex align-items-center">
    <div style="max-width: 600px;" class="w-100 m-auto bg-white p-3 rounded ">
        <h1 class="h3 mt-3 mb-3 text-center text-black">Edit Genre</h1>
        <form  action="/editGenre/{{$genre->id}}" method="get" enctype='multipart/form-data'>
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <input type="hidden" name="idgenre" value="{{$genre->id}}">
            <div class="mb-4 row">
                <label class="col-sm-2 form-label" for="email">Name</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="name" id="name"  value="{{$genre->name}}">
                </div>
            </div>
            <div class="mt-3">
                <input class="btn btn-lg btn-dark w-100" type="submit" value="Edit">
            </div>
            <hr>
        </form>
    </div>
    </div>
@endsection
