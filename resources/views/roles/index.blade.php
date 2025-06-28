@extends('layouts.app')
@section('title', $title)
@push('styles')

@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="mb-0 cd-title d-flex align-items-center justify-content-between">{{ $title }}
                        <a href="{{ route('admin.roles.create') }}" class="btn btn-sm btn-primary rounded-0"><i class="fas fa-plus fa-sm"></i> Add Role</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-hover table-striped" id="role-datatable">
                            <thead>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Permission</th>
                                <th>Created By</th>
                                <th>Created At</th>
                                <th class="text-right">Action</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        table = $('#role-datatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
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
                url: "{{ route('admin.roles.index') }}",
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
                {data: 'permissions'},
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
            },
            dom: "<'row'<'col-sm-6'l><'col-sm-6 text-right'Bf>>" +"<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            buttons: [
                {
                    extend: 'csv',
                    className: 'table-btn custom-csv'
                },
                {
                    extend: 'excel',
                    className: 'table-btn custom-excel'
                },
                {
                    extend: 'pdf',
                    className: 'table-btn custom-pdf'
                }
            ]
        });

        // delete category
        $(document).on('click', '.delete_data', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let row = table.row($(this).parent('tr'));
            let url = "{{ route('admin.roles.delete') }}";
            delete_data(id,url,row,name);
        });
    </script>
@endpush
