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
                                <h2 class="card-title">Change comment</h2>
                            </div>
                        {{-- @include('includes.messages') --}}
                        <!-- /.card-header -->
                            <!-- form start -->
                            <form action=" {{route('comment.update', $comment->id)}} " method="POST">
                                @method('PUT')
                                @csrf
                                <div class="card-body">
                                    <textarea type="text" class="form-control" name="content">{{$comment->content}}</textarea>
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
                </div>
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
