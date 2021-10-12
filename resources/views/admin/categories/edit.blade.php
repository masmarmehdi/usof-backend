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
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('category.update', $category->id)}}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Category Title</label>
                                        <input type="text" class="form-control" name="title" id="title" placeholder="{{$category->title}}">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{route('category.index')}}" class="btn btn-primary">Back</a>
                                </div>
                                <!-- /.col-->
                            </form>
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
