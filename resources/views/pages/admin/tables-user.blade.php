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
                                    <th>Image</th>
                                    <th>Mail</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as  $user)
                                    <tr id="row{{$user->id}}">
                                        <td>{{$user->id}}</td>
                                        <td>@if($user->img!=null)
                                                <img src="{{asset ('assets/images/'.$user->img)}}" width="100" alt="User Image">
                                            @else
                                                <img src="{{asset ('assets/images/nouserimg.png')}}" width="100" alt="User Image">
                                            @endif</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->name}}</td>
                                        <td> Current role: <b>@if($user->role!=null){{$user->role['role']}}@else This user has no role @endif</b>
                                            <p>Change role:</p>
                                            <input type="hidden" name="iduser" id="iduser" value="{{$user->id}}">
                                            <select name="role{{$user->id}}" id="role{{$user->id}}">@foreach($roles as $role)<option value="{{$role->id}}">{{$role->role}}</option>@endforeach</select>
                                            <input type="submit" name="{{$user->id}}" class="role" value="Change">
                                        </td>
                                        <td><button cllas="btn-btn"><a href="/deleteUser/{{$user->id}}">Delete</a></button></td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
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
