@extends('admin.layouts.app')

@section('main-content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-outline card-info">
              <div class="card-header">
                <h2 class="card-title">Title</h2>
              </div>
              @include('includes.messages')
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('category.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Category Title</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Category Title">
                  </div>
                  <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug">
                  </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="{{route('category.index')}}"class="btn btn-primary">Back</a>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection