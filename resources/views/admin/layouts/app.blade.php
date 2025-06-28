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
        {{-- preloader --}}
        @include('admin.includes.preloader')

        {{-- header --}}
        @include('admin.includes.header')

        {{-- navber --}}
        @include('admin.includes.side-nav')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            {{-- breadcrumb --}}
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

        {{-- footer --}}
        @include('admin.includes.footer')

        {{-- alert --}}
        @include('admin.includes.modals.alert')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    @include('admin.partials.script')

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

        // toastr alert message
        function notification(status, message){
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "500",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            switch (status) {
                case 'success':
                toastr.success(message);
                break;

                case 'error':
                toastr.error(message);
                break;

                case 'warning':
                toastr.warning(message);
                break;

                case 'info':
                toastr.info(message);
                break;
            }
        }

        $(document).ready(function(){
            // session flash message
            @if (Session::get('success'))
                notification('success',"{{ Session::get('success') }}")
            @elseif (Session::get('error'))
                notification('error',"{{ Session::get('error') }}")
            @elseif (Session::get('info'))
                notification('info',"{{ Session::get('info') }}")
            @elseif (Session::get('warning'))
                notification('warning',"{{ Session::get('warning') }}")
            @endif

            // tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // datatable reload
            $(document).on('click', 'button.table-reload', function(){
                table.ajax.reload();
            });

            // reset btn
            $(document).on('click','.reset_btn',function(){
                $('form#store_or_update_form').find('.schedule-error').remove();
                $('#store_or_update_form select').selectpicker('val','');
                $('form#store_or_update_form')[0].reset();
            });

            // search table
            $(document).on('keyup keypress', 'input[name="search_here"]', function(){
                table.ajax.reload();
            });
        });
    </script>
    
    @stack('scripts')
</body>

</html>
