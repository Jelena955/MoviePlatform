@extends('layouts.layout-admin')
@section('content')
    <br style="height: 100vh;" class="d-flex align-items-center">
    <div style="max-width: 600px;" class="w-100 m-auto bg-white p-3 rounded ">
        <h1 class="h3 mt-3 mb-3 text-center text-black">Insert Tag</h1>
        <form  action="/insertTag" method="post" enctype='multipart/form-data'>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class="mb-4 row">
                <label class="col-sm-2 form-label" for="email">Name</label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="name" id="name"  placeholder="Name">
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
