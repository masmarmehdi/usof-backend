@extends('admin.layouts.app')

@section('main-content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="mb-3">Posts</h1>
            <a class="btn btn-primary" href="{{route('post.create')}}">Add new Post</a>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Posts</li>
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
          <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 ">
        <table id="example1" class="table table-bordered table-striped table-responsive">
          <thead>
          <tr>
              <th>ID<i class="fas fa-sort"></i></th>
              <th>user_id<i class="fas fa-sort"></i></th>
              <th>Title<i class="fas fa-sort"></i></th>
              <th>Category<i class="fas fa-sort"></i></th>
              <th>Content<i class="fas fa-sort"></i></th>
              <th>Status<i class="fas fa-sort"></i></th>
              <th>Likes<i class="fas fa-sort"></i></th>
              <th>Dislikes<i class="fas fa-sort"></i></th>
              <th>Comments<i class="fas fa-sort"></i></th>
              <th>Created at<i class="fas fa-sort"></i></th>
              <th>Updated at<i class="fas fa-sort"></i></th>
              <th>Edit</th>
              <th>Detail</th>
              <th>Delete</th>
          </tr>
          </thead>
          <tbody>

            @foreach ($posts as $comment => $post)

            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->user_id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->categories}}</td>
                <td>{{$post->content}}</td>
                <td>
                    <form action="{{route('admin.post.status', $post->id)}}" method="post">
                        @method('patch')
                        @csrf
                        @if($post->status == 'inactive')
                            <button class="btn btn-warning" type="submit">
                                {{$post->status}}
                            </button>
                        @elseif($post->status == 'active')
                            <button class="btn btn-success" type="submit">
                                {{$post->status}}
                            </button>
                        @endif
                    </form>
                </td>
                <td>{{$post->likes}}</td>
                <td>{{$post->dislikes}}</td>
                <td>{{$comments[$comment]}}</td>
                <td>{{$post->created_at}}</td>
                <td>{{$post->updated_at}}</td>
                <td><button class="btn btn-warning"><a class="link-dark" href="{{route('post.edit', $post->id)}}" style="text-decoration-color: #0a0e14">Edit</a></button></td>
                <td><button class="btn btn-primary"><a class="link-dark" href="{{route('post.detail', $post->id)}}" style="text-decoration-color: #0a0e14">details</a></button></td>
                <td>
                    <form action="{{route('post.delete', $post->id)}}" method="post">
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
      </div>
    </section>
    <!-- /.content -->
  </div>  <!-- /.content-wrapper -->
    <!-- /.content -->
  </div>  <!-- /.content-wrapper -->
@endsection
