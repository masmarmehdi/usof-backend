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

    <section class="content">
      <div class="card-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
          <tr>
            <th>ID</th>
            <th>username</th>
            <th>name</th>
            <th>email</th>
            <th>profile picture</th>
            <th>rating</th>
            <th>role</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
          </thead>
          <tbody>
            
            @foreach ($users as $user)
            {{-- @foreach ($element as $user) --}}
            <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->username}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->profilePicture}}</td>
              <td>{{$user->rating}}</td>
              <td>{{$user->role}}</td>
              <td>{{$user->created_at}}</td>
              <td>{{$user->updated_at}}</td>
            </tr>
            
            @endforeach



          </tbody>
        </table>

    </section>
    <!-- /.content -->
  </div>  <!-- /.content-wrapper -->
@endsection

@section('footer')
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('dist/js/demo.js')}}"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $(document).ready(function() {
    $('#example1').DataTable();
    });
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection

