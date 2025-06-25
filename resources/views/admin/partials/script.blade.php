<!-- jQuery -->
<script src="{{ asset('backend/') }}/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend') }}/js/bootstrap.bundle.min.js"></script>
<!-- Seelct 2 -->
<script src="{{ asset('backend/js/select2.min.js') }}"></script>
<!-- spartan multi image picker -->
<script src="{{ asset('backend/js/spartan-multi-image-picker-min.js') }}"></script>


<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

<!-- AdminLTE App -->
<script src="{{ asset('backend') }}/js/adminlte.min.js"></script>
<script src="{{ asset('backend') }}/js/main.js"></script>
<script>
    $(document).ready(function () {
        $(document).on('click', '.logout-btn', function(){
            let method = 'POST';
            let url = "{{ route('admin.logout') }}";
            let title = 'Logout';
            let message = "Are Your Sure To Logout?";
            alertModalShow(method,url,title,message);
        });
    });
</script>
@stack('script')
