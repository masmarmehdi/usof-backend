@extends('admin.layouts.app')

@section('main-content')
 <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-info">
              <div class="card-header">
                <h2 class="card-title">Title</h2>
              </div>
              <form action=" {{route('post.update', $post->id)}} " method="post">
                  @method('PATCH')

                  @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="title">Post title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{$post->title}}">
                  </div>
                    <div class="form-group">
                        <label for="categories">Category</label>
                        <input type="text" class="form-control" name="categories" placeholder="Categories" value="{{$post->categories}}">
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <label>Upload a picture</label>
                            <input type="file" class="form-control" name="images[]" multiple>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Content</label>
                        <input type="text" name="content" class="form-control col-md-12" placeholder="Content" value="{{$post->content}}">
                    </div>
                </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="{{route('post.index')}}" class="btn btn-primary">Back</a>
            </div>
          </form>
        </div>
      </div>
        </div>
      </div>
    </section>
  </div>
@endsection
