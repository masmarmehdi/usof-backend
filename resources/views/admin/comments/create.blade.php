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
                <h2 class="card-title">Comment</h2>
              </div>
              {{-- @include('includes.messages') --}}
              <!-- /.card-header -->
              <!-- form start -->
              <form action=" {{route('comment.store')}} " method="POST">
                {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label for="post_id">Post id</label>
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug">
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-header">
                <h2 class="card-title">Make a comment here</h2>
              </div>
            <!-- /.card-header -->
            <div class="card-body">
              <textarea id="summernote" name="body">
                Place <em>some</em> <u>comment</u> <strong>here</strong>
              </textarea>
            </div>
            <div class="card-footer">
              Visit <a href="https://github.com/summernote/summernote/">Summernote</a> documentation for more examples and information about the plugin.
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="{{route('comment.index')}}"class="btn btn-primary">Back</a>
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
