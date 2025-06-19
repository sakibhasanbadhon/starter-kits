@extends('admin.layouts.app')

@section('button-area')
   <div class="d-flex justify-content-end">
       <div class="seach-area">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="search-text">
            <div class="input-group-append">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
        </div>
       </div>
        <div class="link-area ml-3">
            @permission('create-role')
                <a href="{{ route('admin.manage-admins.roles.create') }}" class="btn btn-primary"><i class="fas fa-plus button-icon"></i> {{ __('Add New') }}</a>
            @endpermission
        </div>
   </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-body p-0">
                    <div class="table-responsive roles_table">
                        @include('admin.includes.tables.roles-table', compact('roles'))
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
                let url = "{{ route('admin.manage-admins.roles.delete') }}";
                let title = 'Role Delete';
                let message = "Are Your Sure To Delete Role?";
                let target = $(this).data('target');
                alertModalShow(method,url,title,message,target);
            });

            // Search
            var time_out;
            $(document).on('keyup', 'input[name="search-text"]', function (e) {
                let text = $(this).val();
                let route = '{{ route("admin.manage-admins.roles.search") }}';
                clearTimeout( );
                time_out = setTimeout(globalSearch, 500,text,route,'roles_table');
            });
        });

    </script>
@endpush
