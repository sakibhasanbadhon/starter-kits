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
            {{-- @permission('create-role') --}}
                {{-- <a href="{{ route('admin.manage-admins.create') }}" class="btn btn-primary"><i class="fas fa-plus button-icon"></i> {{ __('Add New') }}</a> --}}
            {{-- @endpermission --}}
        </div>
   </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card card-primary card-outline">
                <div class="card-body p-0">
                    <div class="table-responsive user_table">
                        @include('admin.includes.tables.users-table', compact('users'))
                    </div>
                </div>
            </div><!-- /.card -->
        </div>
    </div>

@endsection


@push('script')
    <script>
        $(document).ready(function () {

             // Search
             var time_out;
            $(document).on('keyup', 'input[name="search_text"]', function (e) {
                let text = $(this).val();
                let route = '{{ route("admin.manage-admins.user.search") }}';
                clearTimeout( );
                time_out = setTimeout(globalSearch, 500,text,route,'user_table');
            });

        });

    </script>
@endpush

