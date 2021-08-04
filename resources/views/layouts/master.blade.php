<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('includes.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  @include('includes.nav')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('includes.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content')
  
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('includes.scripts')
@yield('script')
  <!-- END PAGE LEVEL JS-->
  <script type="text/javascript">
        @if(Session::has('message'))
    var type="{{Session::get('alert-type','info')}}"


    switch(type){
        case 'info':
            toastr.info("{{Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{Session::get('message') }}");
            break;
    }
    @endif
</script>

</body>
</html>
