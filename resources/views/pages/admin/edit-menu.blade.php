@extends('layouts.layout-admin')
@section('content')
    <br style="height: 100vh;" class="d-flex align-items-center">
    <div style="max-width: 600px;" class="w-100 m-auto bg-white p-3 rounded ">
        <h1 class="h3 mt-3 mb-3 text-center text-black">Edit Menu</h1>
        <form  action="/editMenu/{{$link->id}}" method="get" enctype='multipart/form-data'>
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <input type="hidden" name="idlink" value="{{$link->id}}">
            <div class="mb-4 row">
                <label class="col-sm-2 form-label" for="email">Name</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="menu_title" id="menu_title"  value="{{$link->menu_title}}">
                </div>
            </div>
            <div class="mb-4 row">
            <label class="col-sm-2 form-label" for="email">Route</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" name="link" id="link"  value="{{$link->link}}">
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

