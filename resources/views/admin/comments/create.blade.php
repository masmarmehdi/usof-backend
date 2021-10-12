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
                <h2 class="card-title">Create a Comment</h2>
              </div>
              {{-- @include('includes.messages') --}}
              <!-- /.card-header -->
              <!-- form start -->
              <form action=" {{route('comment.store')}} " method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="post_id">Post id</label>
                    <input type="text" class="form-control" name="post_id" id="post_id" placeholder="post_id">
                  </div>
                    <label for="content">Make a comment here:</label>
                    <textarea type="text" class="form-control" name="content" placeholder="Write some comment here"></textarea>
                </div>
              <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="{{route('comment.index')}}" class="btn btn-primary">Back</a>
              </div>
              </form>
                <!-- /.card-body -->

            <!-- /.card -->
          </form>
        </div>
        <!-- /.col-->
      </div>
        </div>
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
