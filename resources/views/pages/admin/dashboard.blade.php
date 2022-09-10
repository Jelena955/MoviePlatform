
@extends('layouts.layout-admin')
@section('content')

    <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard v2</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v2</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-film"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Number of movies</span>
                            <span class="info-box-number">
                  {{$numberOfMovies}}

                </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-star"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Number of ratings</span>
                            <span class="info-box-number">{{$numberOfRatings}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i
                                    class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Number of Members</span>
                            <span class="info-box-number">{{$numberOfUsers}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user-plus"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">New Members past 20 days</span>
                            <span class="info-box-number">{{$numberOfUsersNewest}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.row -->

            <!-- Main row -->

            <!-- /.card -->


            <!--/.direct-chat -->

            <!-- /.col -->


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Logins</h3>

                            <div class="card-tools">
                                <div class="info-box-content">
                                    <label for="start">Filter date:</label>

                                    <input type="date" id="datelog" name="datelog"
                                           value="{{date ('Y-m-d')}}"
                                           min="{{date ('Y-m-d', strtotime ("-1000 day"))}}" max="{{date ('Y-m-d')}}">
                                    <button type="button" id="logdate">Filter</button>
                                </div>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                    <tr>
                                        <th>IP</th>
                                        <th>URL</th>
                                        <th>Method</th>
                                        <th>Email</th>
                                        <th>Time of login</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tablelogins">
                                    @foreach($loggedUsers as $user)
                                        <tr>
                                            <td><p>{{$user->ip}}</p></td>
                                            <td><p>{{$user->url}}</p></td>
                                            <td><p>{{$user->method}}</p></td>
                                            <td><p>{{$user->email}}</p></td>
                                            <td><p>{{$user->created_at}}</p></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Logouts</h3>

                            <div class="card-tools">
                                <div class="info-box-content">
                                    <label for="start">Filter date:</label>

                                    <input type="date" id="datelogout" name="datelogout"
                                           value="{{date ('Y-m-d')}}"
                                           min="{{date ('Y-m-d', strtotime ("-1000 day"))}}" max="{{date ('Y-m-d')}}">
                                    <button type="button" id="logoutdate">Filter</button>
                                </div>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table m-0">
                                    <thead>
                                    <tr>
                                        <th>IP</th>
                                        <th>URL</th>
                                        <th>Method</th>
                                        <th>Email</th>
                                        <th>Time of login</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tablelogouts">
                                    @foreach($loggedOutUsers as $user)
                                        <tr>
                                            <td><p>{{$user->ip}}</p></td>
                                            <td><p>{{$user->url}}</p></td>
                                            <td><p>{{$user->method}}</p></td>
                                            <td><p>{{$user->email}}</p></td>
                                            <td><p>{{$user->created_at}}</p></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <!-- USERS LIST -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Latest Members</h3>

                        <div class="card-tools">
                            <div class="info-box-content">
                                <label for="start">Start date:</label>

                                <input type="date" id="date" name="date"
                                       value="{{date ('Y-m-d')}}"
                                       min="{{date ('Y-m-d', strtotime ("-20 day"))}}" max="{{date ('Y-m-d')}}">
                                <button type="button" id="regdate">Filter</button>
                            </div>
                            <span class="badge badge-danger">{{$numberOfUsersNewest}} new member past 20 days</span>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <ul class="users-list clearfix" id="userstable">
                            @foreach($newestUsers as $user)
                                <li>
                                    @if($user->img!=null)
                                    <img src="{{asset ('assets/images/'.$user->img)}}" width="200" alt="User Image">
                                    @else
                                        <img src="{{asset ('assets/images/nouserimg.png')}}" width="200" alt="User Image">
                                    @endif
                                    <a class="users-list-name" href="#">{{$user->name}}</a>
                                    <span class="users-list-date">{{$user->created_at}}</span>
                                </li>
                            @endforeach
                        </ul>
                        <!-- /.users-list -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer text-center">
                        <a href="/adminUser">View All Users</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!--/.card -->
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <!-- DIRECT CHAT -->
                <div class="card direct-chat direct-chat-warning">
                    <div class="card-header">
                        <h3 class="card-title">Messages</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <table class="table m-0">
                        <thead>
                        <tr>
                            <th>Message ID</th>
                            <th>From</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td><p>{{$message->id}}</p></td>
                                <td><p>{{$message->email}}</p></td>
                                <td><p>{{$message->message}}</p></td>
                                <td><p>{{$message->created_at}}</p></td>
                                <td><button cllas="btn-btn"><a href="/deleteMessage/{{$message->id}}">Delete</a></button></td>
                            </tr>
                        @endforeach
                        <!-- /.card-footer-->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->

            <!-- /.card -->
        </div>
        <!-- /.col -->


        <!-- /.info-box -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Most popular movies</h3>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Movie</th>
                            <th>Popularity</th>
                            <th style="width: 40px">Number of tags</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($mostPopularMovie as $movie)
                            <tr>
                                <td>{{$movie->id}}</td>
                                <td>{{$movie->title}}</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: {{$movie->tag_count*5}}%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-danger">{{$movie->tag_count}}</span></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-body -->
        <!-- /.footer -->
        </div>

    </section>
    <!-- /.content -->

@endsection
