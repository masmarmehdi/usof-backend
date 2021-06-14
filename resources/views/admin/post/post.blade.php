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
              {{-- @include('includes.messages') --}}
              <!-- /.card-header -->
              <!-- form start -->
              <form action=" {{route('post.store')}} " method="POST">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Post title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                  </div>
                  <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="image">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="status">
                    <label class="form-check-label" for="status">Publish</label>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-header">
                <h2 class="card-title">Write something here</h2>
              </div>
            <!-- /.card-header -->
            <div class="card-body">
              <textarea id="summernote" name="body">
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
            </div>
            <div class="card-footer">
              Visit <a href="https://github.com/summernote/summernote/">Summernote</a> documentation for more examples and information about the plugin.
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="{{route('post.index')}}"class="btn btn-primary">Back</a>
            </div>
            <!-- /.card -->
          </form>
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
