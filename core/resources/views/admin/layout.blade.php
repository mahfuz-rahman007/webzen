<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Webzen</title>
    <link rel="shortcut icon" href="" type="image/png">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
    @include('admin.partials.styles')
    @yield('styles')
</head>
<body {{ Session::has('notification') ? 'data-notification' : '' }} @if(Session::has('notification')) data-notification-message='{{ json_encode(Session::get('notification')) }} @endif' class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

<div class="wrapper">

    @include('admin.partials.top-navbar')

    @include('admin.partials.side-navbar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      @yield('content')
  </div>
  <!-- /.content-wrapper -->

  @include('admin.partials.footer')
</div>

@includeif('admin.partials.scripts')
@yield('scripts')

</body>
</html>
