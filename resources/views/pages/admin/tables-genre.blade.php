@extends('layouts.layout-admin')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tag Table</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($genres as  $genre)
                                    <tr id="row{{$genre->id}}">
                                        <td>{{$genre->id}}</td>
                                        <td>{{$genre->name}}</td>
                                        <td><button cllas="btn-btn"><a href="/editGenreForm/{{$genre->id}}">Edit</a></button></td>
                                        <td><button cllas="btn-btn"><a href="/deleteGenre/{{$genre->id}}">Delete</a></button></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <button><a href="/insertGenreForm">Insert genre</a></button>
                        </div>
                        <!-- /.card-body -->


                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
