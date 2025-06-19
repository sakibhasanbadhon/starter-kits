<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Starter Kits | {{ $page_title ?? 'Title' }}</title>

  @include('admin.partials.style')
</head>
<body class="hold-transition login-page">
    @yield('content')
  <!-- /.login-box -->
  @include('admin.partials.script')
  @include('admin.includes.noty');
</body>
</html>
