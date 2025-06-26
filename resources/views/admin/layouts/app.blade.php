<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Starter Kits</title>
    @include('admin.partials.style')
    @stack('styles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('admin.includes.preloader')

        @include('admin.includes.header')

        @include('admin.includes.side-nav')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @include('admin.includes.breadcrumb')

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        @include('admin.includes.footer')
        @include('admin.includes.modals.alert')
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED SCRIPTS -->
    @include('admin.partials.script')
    @include('admin.includes.noty')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
        // ajax header setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // token
        var _token = "{{ csrf_token() }}";
        var table;
    </script>
    @stack('scripts')
</body>

</html>
