@extends('admin.layouts.app')

@section('main-content')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
              <h1 class="mb-3">Create category</h1>
            <!-- general form elements -->
            <div class="card card-outline card-info">

              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('category.store')}}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Category Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Category Title">
                  </div>
        </div>
        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          <a href="{{route('category.index')}}" class="btn btn-primary">Back</a>
        </div>
              </form>
        <!-- /.col-->
      </div>
          </div>
        </div>
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
