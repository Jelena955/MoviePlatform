@extends('layouts.layout-admin')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
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
                                    <th>Tag name</th>
                                    <th>Route</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($menu as  $nav)
                                    <tr>
                                        <td>{{$nav->id}}</td>
                                        <td>{{$nav->menu_title}}</td>
                                        <td>{{$nav->link}}</td>
                                        <td><button><a href="/editMenuForm/{{$nav->id}}">Edit</a></button></td>
                                        <td><button><a href="/deleteMenu/{{$nav->id}}">Delete</a></button></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <button><a href="/insertMenuForm">Insert link</a></button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
