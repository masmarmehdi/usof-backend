<!DOCTYPE html>
<html lang="en">
    @include('admin.layouts.head')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')
        @section('main-content')
            @show
        @include('admin.layouts.footer')
    </div>
    @section('footer')
        @show
</body>
</html>
