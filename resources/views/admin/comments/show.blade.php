@extends('admin.layouts.app')

@section('main-content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="mb-3">Comments</h1>
            <a class="btn btn-primary" href="{{route('comment.create')}}">Add new Comment</a>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Comments</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible d-flex justify-content-center">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{Session::get('success')}}
            </div>
        @elseif(Session::has('fail'))
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{Session::get('fail')}}
            </div>
        @endif
      <div class="card card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>ID <i class="fas fa-sort"></i></th>
            <th>user_id <i class="fas fa-sort"></i></th>
            <th>post_id <i class="fas fa-sort"></i></th>
            <th>Content <i class="fas fa-sort"></i></th>
            <th>Likes <i class="fas fa-sort"></i></th>
            <th>Dislikes <i class="fas fa-sort"></i></th>
            <th>Created at <i class="fas fa-sort"></i></th>
            <th>Updated at <i class="fas fa-sort"></i></th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          </thead>
          <tbody>

            @foreach ($comments as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->user_id}}</td>
                <td>{{$item->post_id}}</td>
                <td>{{$item->content}}</td>
                <td>{{$item->likes}}</td>
                <td>{{$item->dislikes}}</td>
                <td>{{$item->created_at}}</td>
                <td>{{$item->updated_at}}</td>
                <td><button class="btn btn-warning"><a class="link-dark" href="{{route('comment.edit', $item->id)}}">Edit</a></button></td>
                <td>
                    <form action="{{route('comment.destroy', $item->id)}}" method="post">
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
    <!-- /.content -->
  </div>  <!-- /.content-wrapper -->
@endsection
