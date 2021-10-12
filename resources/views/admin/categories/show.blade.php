@extends('admin.layouts.app')

@section('main-content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="mb-3">Categories</h1>
            <a class="btn btn-primary" href="{{route('category.create')}}">Add new Category</a>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Categories</li>
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
            <div class="alert alert-danger alert-dismissible d-flex justify-content-center">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{Session::get('fail')}}
            </div>
        @endif
      <div class="card card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Id <i class="fas fa-sort"></i></th>
            <th>Category Name <i class="fas fa-sort"></i></th>
            <th>Created at <i class="fas fa-sort"></i></th>
            <th>Updated at <i class="fas fa-sort"></i></th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
            <tr>
              <td>{{ $category->id }}</td>
                <td><a href="{{route('category.detail', $category->id)}}" target="_blank">{{ $category->title }}</a></td>
              <td>{{ $category->created_at }}</td>
              <td>{{ $category->updated_at }}</td>
                <td><button class="btn btn-warning"><a class="link-dark" href="{{route('category.edit', $category->id)}}">Edit</a></button></td>
                <td>
                    <form action="{{route('category.destroy', $category->id)}}" method="post">
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
