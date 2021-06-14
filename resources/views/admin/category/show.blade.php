@extends('admin.layouts.app')

@section('main-content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Categories</h1>
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
      <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>Serial Number</th>
            <th>Tag Name</th>
            <th>Slug</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
            <tr>
              <td>{{$loop->index + 1}}</td>
              <td>{{$category->name}}</td>
              <td>{{$category->slug}}</td>
            </tr>
            @endforeach

          </tbody>
          <tfoot>
          <tr>
            <th>Serial Number</th>
            <th>Category Name</th>
            <th>Slug</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          </tfoot>
        </table>
      </div>
    </section>
    <!-- /.content -->
  </div>  <!-- /.content-wrapper -->
@endsection
