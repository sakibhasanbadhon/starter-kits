@extends('admin.layouts.app')

@section('button-area')
   <div class="d-flex justify-content-end">
       <div class="seach-area">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search_text">
            <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
        </div>
       </div>
        <div class="link-area ml-3">
            @permission('create-role')
                <a href="{{ route('admin.manage-admins.create') }}" class="btn btn-primary"><i class="fas fa-plus button-icon"></i> {{ __('Add New') }}</a>
            @endpermission
        </div>
   </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-body p-0">
                    <div class="table-responsive admins_table">
                        @include('admin.includes.tables.admins-table', compact('admins'))
                    </div>
                </div>
            </div><!-- /.card -->
        </div>
    </div>
@endsection


@push('script')
    <script>
        $(document).ready(function () {
            // Delete
            $(document).on('click', '.delete-btn', function(e){
                let method = 'POST';
                let url = "{{ route('admin.manage-admins.delete') }}";
                let title = 'Role Delete';
                let message = "Are Your Sure To Delete Admin?";
                let target = $(this).data('target');
                alertModalShow(method,url,title,message,target);
            });

            // // Search
            // $(document).on('keyup', 'input[name="search_text"]', function (e) {
            //     let route = '{{ route("admin.manage-admins.search") }}';
            //     let method = "POST";
            //     let table_class = '.urls_table'
            //     let text = $(this).val();
            //     globalSearch(text,route,method,table_class);
            // });

             // Search
             var time_out;
            $(document).on('keyup', 'input[name="search_text"]', function (e) {
                let text = $(this).val();
                let route = '{{ route("admin.manage-admins.search") }}';
                clearTimeout( );
                time_out = setTimeout(globalSearch, 500,text,route,'admins_table');
            });

        });

    </script>
@endpush
