@extends('backend.layouts.app')
@section('title', $title)
@push('styles')

@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="mb-0 cd-title">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-hover table-striped" id="contact-datatable">
                            <thead>
                                <th>SL</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Messages</th>
                                <th>Created At</th>
                                @if (permission('contact-message-reply') || permission('contact-message-view'))
                                <th class="text-right">Action</th>
                                @endif
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="contact_modal" class="modal fade show" role="dialog">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header py-1">
                    <h5 class="modal-title" >View</h5>
                    <button type="button" class="close shadow-none" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        table = $('#contact-datatable').DataTable({
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
                url: "{{ route('admin.contact-messages.index') }}",
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
                {data: 'email'},
                {data: 'subject'},
                {data: 'message'},
                {data: 'created_at'},
                @if (permission('contact-message-view') || permission('contact-message-view'))
                {data: 'action'}
                @endif
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

        @permission('contact-message-view')
        $(document).on('click','.view_data',function(){
            var id = $(this).data('id');
            var email = $(this).data('email');
            if(id){
                $.ajax({
                    url: "{{ route('admin.contact-messages.view') }}",
                    type: "POST",
                    data: {_token:_token,id:id},
                    dataType: "JSON",
                    success: function(response){
                        $('#contact_modal .modal-body').html('');
                        if(response.status == 'success'){
                            $('#contact_modal .modal-body').append(response.data);
                            $('#contact_modal').modal({
                                keyboard: false,
                                backdrop: 'static'
                            });
                        }else{
                            notification(response.status,response.message);
                        }
                    },
                    error: function(){
                        notification('error','Somthing went wrong with data!');
                    }
                });
            }
        });
        @endpermission
    </script>
@endpush
