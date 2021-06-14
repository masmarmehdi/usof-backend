@extends('admin.layouts.app')

@section('main-content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Posts</h1>
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
      <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>ID</th>
            <th>user_id</th>
            <th>Category</th>
            <th>Content</th>
            <th>Likes</th>
            <th>Dislikes</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          </thead>
          <tbody>
            
            @foreach ($posts as $item)
            {{-- @foreach ($element as $item) --}}
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->user_id}}</td>
              <td>{{$item->title}}</td>
              <td>{{$item->content}}</td>
              <td>{{$item->likes}}</td>
              <td>{{$item->dislikes}}</td>
              <td>{{$item->created_at}}</td>
              <td>{{$item->updated_at}}</td>


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
