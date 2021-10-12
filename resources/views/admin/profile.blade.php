@extends('admin.layouts.app')
@section('main-content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Profile</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{Auth::user()->role}} Profile</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile text-center">
                                @if(Session::has('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        {{Session::get('success')}}
                                    </div>
                                @elseif(Session::has('fail'))
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        @foreach(Session::get('fail') as $message => $error)
                                            <p>{{"$message : $error[0]"}}</p>
                                        @endforeach
                                    </div>
                                @endif
                                <div>
                                    <img src="/profile_pictures/{{Auth::user()->profilePicture}}" class="img-circle" width="100" height="100" alt="{{Auth::user()->username}}'s avatar">
                                </div>

                                <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
                                <h5 class="text-center">Role : {{Auth::user()->role}}</h5>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <!-- /.col -->
                        <!-- /.card -->
                        <!-- /.col -->
                    </div>
                    <!-- left column -->
                    <div class="col-md-8">
                        <!-- general form elements -->
                        <div class="card card-primary card-outline">
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form enctype="multipart/form-data" action="{{route('admin.update')}}" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control"  value="{{Auth::user()->username}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Full name</label>
                                        <input type="text" class="form-control" disabled value="{{Auth::user()->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Email address</label>
                                        <input type="email" class="form-control" disabled value="{{Auth::user()->email}}">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <label>Upload profile picture</label>
                                        <input type="file" class="form-control" name="profilePicture">
                                    </div>
                                    <div class="form-group">
                                        <label>Role</label>
                                        <select id="role" name="role" class="form-control custom-select">
                                            <option @if(Auth::user()->role == 'user') selected disabled @endif>user</option>
                                            <option @if(Auth::user()->role == 'admin')selected disabled @endif>admin</option>
                                        </select>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card -->
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
