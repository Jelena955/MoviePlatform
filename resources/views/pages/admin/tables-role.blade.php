@extends('layouts.layout-admin')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Role Table</h3>
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
                                @foreach($roles as  $role)
                                    <tr id="row{{$role->id}}">
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->role}}</td>
                                        <td><button cllas="btn-btn"><a href="/editRoleForm/{{$role->id}}">Edit</a></button></td>
                                        <td><button cllas="btn-btn"><a href="/deleteRole/{{$role->id}}">Delete</a></button></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            <button><a href="/insertRoleForm">Insert role</a></button>
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
