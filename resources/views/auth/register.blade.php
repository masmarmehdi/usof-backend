
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyBlog | Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="icon" href="../../myblogicon.jpg" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{Session::get('success')}}
        </div>
    @elseif(Session::has('fail'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{Session::get('fail')}}
        </div>
    @endif
    <div class="register-logo">
        <a href="{{route('home')}}"><b><img src="../../MyBlog.png" alt="myBlog logo"></b></a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Register a new membership</p>

            <form action="{{route('register.check')}}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input id="username" type="text" class="form-control " name="username" value="{{ old('username') }}" required  placeholder="Username">

{{--                    @error('username')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                    @enderror--}}
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input id="name" type="text" class="form-control " name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name">

{{--                    @error('name')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                    @enderror--}}
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
{{--                    @error('email')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                    @enderror--}}

                </div>
                <div class="input-group mb-3">
                    <input id="password" type="password" class="form-control " name="password" required autocomplete="new-password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
{{--                    @error('password')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                    @enderror--}}

                </div>
                <div class="input-group mb-3">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
{{--                    @error('password_confirmation')--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                        <strong>{{ $message }}</strong>--}}
{{--                    </span>--}}
{{--                    @enderror--}}
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

{{--            <div class="social-auth-links text-center">--}}
{{--                <p>- OR -</p>--}}
{{--                <a href="{{route('auth.github')}}" class="btn btn-block btn-dark">--}}
{{--                    <i class="fab fa-github mr-2"></i>--}}
{{--                    Sign up using Github--}}
{{--                </a>--}}
{{--                <a href="{{route('auth.facebook')}}" class="btn btn-block btn-primary">--}}
{{--                    <i class="fab fa-facebook mr-1"></i>--}}
{{--                    Sign up using Facebook--}}
{{--                </a>--}}
{{--                <a href="{{route('auth.google')}}" class="btn btn-block btn-danger">--}}
{{--                    <i class="fab fa-google-plus mr-2"></i>--}}
{{--                    Sign up using Google+--}}
{{--                </a>--}}
{{--            </div>--}}

            <a href="{{route('auth.login')}}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
