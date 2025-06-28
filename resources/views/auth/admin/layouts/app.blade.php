<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Starter Kits | {{ $page_title ?? 'Title' }}</title>

  @include('partials.style')
</head>
<body class="hold-transition login-page">
    @yield('content')
  <!-- /.login-box -->
  @include('partials.script')
</body>
</html>
