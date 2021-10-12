@extends('admin.layouts.app')

@section('main-content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="mb-3">Users</h1>
            <a class="btn btn-primary" href="{{route('user.create')}}">Add new User/Admin</a>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{Session::get('success')}}
            </div>
        @elseif(Session::has('fail'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{Session::get('fail')}}
            </div>
        @endif
      <div class="card-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>ID</th>
            <th>username</th>
            <th>name</th>
            <th>email</th>
            <th>profile picture</th>
            <th>rating</th>
            <th>role</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Delete</th>
          </tr>
          </thead>
          <tbody>

            @foreach ($users as $user)
            <tr>
              <td>{{$user->id}}</td>
                <td><a href="{{route('user.profile', $user->id)}}" target="_blank">{{$user->username}}</a></td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
                <td><img class="img-circle" src="/profile_pictures/{{$user->profilePicture}}" alt="{{$user->username}}'s photo" width="100" height="100"></td>
              <td>{{$user->rating}}</td>
              <td>{{$user->role}}</td>
              <td>{{$user->created_at}}</td>
              <td>{{$user->updated_at}}</td>
                <td>
                    <form action="{{route('user.destroy', $user->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
    <!-- /.content -->
  </div>  <!-- /.content-wrapper -->
@endsection


