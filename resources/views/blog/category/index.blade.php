@extends('admin.layouts.app')
@section('title', $title)
@push('styles')

@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="mb-0 cd-title d-flex align-items-center justify-content-between">{{ $title }}
                        <button class="btn btn-sm btn-primary rounded-0" onclick="showFormModal('Add Category', 'Save')"><i class="fas fa-plus fa-sm"></i> Add Category</button>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-hover table-striped" id="category-datatable">
                            <thead>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('blog.category.store-or-update')
@endsection

@push('scripts')
    <script>
        table = $('#category-datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            order: [], //Initial no order
            bInfo: true, //TO show the total number of data
            bFilter: false, //For datatable default search box show/hide
            ordering: false,
            lengthMenu: [
                [5, 10, 15, 25, 50, 100],
                [5, 10, 15, 25, 50, 100]
            ],
            pageLength: 10, //number of data show per page
            ajax: {
                url: "{{ route('admin.categories.index') }}",
                type: "GET",
                dataType: "JSON",
                data: function(d) {
                    d._token = _token;
                    d.search = $('input[name="search_here"]').val();
                },
            },
            columns: [
                {data: 'DT_RowIndex'},
                {data: 'name'},
                {data: 'status'},
                {data: 'created_by'},
                {data: 'created_at'},
                {data: 'action'}
            ],
            language: {
                processing: "<img src='{{ asset('backend/img/table-loading.svg') }}'>",
                emptyTable: '<strong class="text-danger">No Data Found</strong>',
                infoEmpty: '',
                zeroRecords: '<strong class="text-danger">No Data Found</strong>',
                oPaginate: {
                    sPrevious: "Previous", // This is the link to the previous page
                    sNext: "Next", // This is the link to the next page
                },
                lengthMenu: `<div class='d-flex align-items-center w-100 justify-content-between'>_MENU_
                    <input name='search_here' class='form-control form-control-sm ml-2 shadow-none' autocomplete="off" placeholder="Search here..."/>
                    </div>`,
            }
        });

        // save user
        $(document).on('click', '#save-btn', function () {
            var form_data = document.getElementById('store_or_update_form');
            var form = new FormData(form_data);
            let url = "{{ route('admin.categories.store-or-update') }}";
            let id = $('#update_id').val();
            let method;
            if (id) {
                method = 'update';
            } else {
                method = 'add';
            }
            $.ajax({
                url: url,
                type: "POST",
                data: form,
                dataType: "JSON",
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function(){
                    $('#save-btn span').addClass('spinner-border spinner-border-sm text-light');
                },
                complete: function(){
                    $('#save-btn span').removeClass('spinner-border spinner-border-sm text-light');
                },
                success: function (data) {
                    $('#store_or_update_form').find('.is-invalid').removeClass('is-invalid');
                    $('#store_or_update_form').find('.error').remove();
                    if (data.status == false) {
                        $.each(data.errors, function (key, value) {
                            $('#store_or_update_form #' + key).addClass('is-invalid');
                            $('#store_or_update_form #' + key).parent().append('<small class="error text-danger">' + value + '</small>');
                        });
                    } else {
                        notification(data.status, data.message);
                        if (data.status == 'success') {
                            if (method == 'update') {
                                table.ajax.reload(null, false);
                            } else {
                                table.ajax.reload();
                            }
                            $('#store_or_update_modal').modal('hide');
                        }
                    }
                },
                error: function (xhr, ajaxOption, thrownError) {
                    console.log(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
                }
            });
        });

        // status changes
        $(document).on('click', '.change_status', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var status = $(this).data('status');
            var url = "{{ route('admin.categories.status-change') }}"
            change_status(id, status, name, url);
        });
    </script>
@endpush
