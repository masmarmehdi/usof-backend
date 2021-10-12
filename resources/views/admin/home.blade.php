@extends('admin.layouts.app')

@section('main-content')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blank Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Title</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
          <div class="card-body pb-0">
              <div class="row d-flex align-items-stretch">
                  @foreach($posts as $post)
                      @if($post->status == 'active')
                  <div class="col-6">
                      <div class="card">
                          <div class="d-flex justify-content-between">
                              <div class="card-header text-muted border-bottom-0 mb-3">
                                  <b>Categories:</b>
                                  @foreach(\App\Models\Category::where('title', $post->categories)->get() as $category)
                                      {{$category->title}}
                                  @endforeach
                              </div>
                              <div class="text-muted mt-2 mr-2">
                                  {{$post->created_at}}
                              </div>
                          </div>
                          <div class="card-body pt-0">

                              <div class="row">
                                  <div class="col-12">
                                      <div class="d-flex justify-content-between mb-5">
                                          <div>
                                              @foreach(\App\Models\User::where('id', $post->user_id)->get() as $user)
                                              <img src="/profile_pictures/{{$user->profilePicture}}" alt="{{$user->username}}" class="img-circle" width="60" height="60">
                                              <a href="{{route('user.profile', $user->id)}}" target="_blank">{{$user->name}}</a>
                                              @endforeach
                                          </div>
                                          <div>
                                              <h2 class="text-center  text-muted mb-5">{{$post->title}}</h2>
                                          </div>
                                      </div>
                                  </div>
                                  <h4>{{$post->content}}</h4>
                                  <div class="list-inline gallery">
                                      @foreach(explode("|", $post->images) as $image)
                                          <img  class="" src="/posts_picture/{{$image}}" alt="{{$post->name}}" width="100%" height="auto">
                                      @endforeach
                                  </div>
                              </div>
                          </div>
                          <div class="card-footer d-flex justify-content-between">
                                      <form action="{{route('post.like', $post->id)}}" method="post">
                                          @csrf
                                          <input type="hidden" name="type" value="like">
                                          <button class="btn btn-success" type="submit"><i class="far fa-thumbs-up"></i>({{\App\Models\LikeDislike::where('post_id', $post->id)->where('type', 'like')->count()}})</button>
                                      </form>
                              <div class="ml-auto p-2">
                                      <form action="{{route('post.dislike', $post->id)}}" method="post">
                                          @csrf
                                          <input type="hidden" name="type" value="dislike">
                                          <button class="btn btn-danger" type="submit"><i class="far fa-thumbs-down"></i>({{\App\Models\LikeDislike::where('post_id', $post->id)->where('type', 'dislike')->count()}})</button>
                                      </form>
                              </div>
                          </div>
                                  <div class=" card-footer col-12">
                                      <div class="d-flex flex-row add-comment-section mb-1">
                                          <img class="img-fluid img-responsive rounded-circle mr-2" src="../../../profile_pictures/{{Auth::user()->profilePicture}}" width="38">
                                          <input type="text" class="form-control mr-3" placeholder="Add comment">
                                          <button class="btn btn-primary" type="button">Comment</button>
                                      </div>
                                          <div class="collapsable-comment">
                                              <div class="d-flex flex-row justify-content-between align-items-center action-collapse p-2" data-toggle="collapse" aria-expanded="false" aria-controls="collapse-1" href="#collapse-1"><span>Comments({{\App\Models\Comment::where('post_id', $post->id)->count()}})</span><i class="fa fa-chevron-down service-drop"></i></div>

                                              <div id="collapse-1" class="collapse">
                                                  @foreach(App\Models\Comment::where('post_id', $post->id) as $comment)
                                                  <div class="commented-section mt-2">
                                                  <div class="d-flex flex-row align-items-center commented-user">
                                                      <h5 class="mr-2">{{App\Models\User::where('id', $comment->user_id)->name}}</h5><span class="dot mb-1"></span>
                                                  </div>
                                                  <div class="comment-text-sm"><span>{{$comment->content}}</span></div>
                                                  <div class="reply-section">
                                                      <div class="d-flex flex-row align-items-center voting-icons"><i class="fa fa-sort-up fa-2x mt-3 hit-voting"></i><i class="fa fa-sort-down fa-2x mb-3 hit-voting"></i><span class="ml-2">10</span><span class="dot ml-2"></span>
                                                          <h6 class="ml-2 mt-1">Reply</h6>
                                                      </div>
                                                  </div>
                                              </div>
                                                  @endforeach

                                              </div>
                                              </div>
                                      </div>
{{--                                  </div>--}}
{{--                                  </div>--}}
{{--                      </div>--}}
                          {{--                              </div>--}}
{{--                          </div>--}}
                      </div>
                  </div>
                      @endif

                  @endforeach
              </div>
          </div>
        <!-- /.card-body -->
        <div class="card-footer justify-content-center">
            {{$posts->links()}}
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>  <!-- /.content-wrapper -->
@endsection
