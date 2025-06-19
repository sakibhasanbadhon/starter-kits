@extends('admin.layouts.app')

@section('button-area')
    <a href="{{ route('admin.manage-admins.roles.index') }}" class="btn btn-primary rounded-0 mb-0"><i class="fas fa-arrow-left button-icon"></i> Back</a>
@endsection


@push('style')
    <style>
        #role_form .form-check{
            margin-bottom: 5px
        }
        #role_form ul{
            list-style: none
        }
        #role_form .form-check-input{
            width: 20px;
            height: 20px;
        }
        #role_form .form-check-label{
            margin-top: 3px;
            margin-left: 9px;
            font-size: 16px;
            font-weight: 600
        }
        .permission-col:nth-child(odd) {
            border-right: 1px solid #ebebeb;
        }
    </style>
@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <form id="role_form" method="POST" action="{{  route('admin.manage-admins.roles.store') }}">
                        @csrf
                        @isset($role)
                            <input type="hidden" name="update_id" value="{{ $role->id }}">
                        @endisset
                        <div class="row">
                            <div class="col-12 mb-3">
                                <x-forms.textbox name="role_name" labelName="Role name" placeholder="Role Name" required="required" errorInput="role_name" value="{{ $role->name ?? old('role_name') }}"></x-forms.textbox>
                            </div>

                            <div class="col-12 mb-2">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" onchange="selectAllPermision()" id="select_all_permission">
                                    <label class="form-check-label" for="select_all_permission">All Permission</label>
                                </div>
                            </div>

                            @foreach ($modules as $module)
                                <div class="col-md-6 permission-col pb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input module_{{ $module->id }} select_single_permission module_permission" id="module_{{ $module->id }}" onclick="moduleWisePermission('module_{{ $module->id }}','single_{{ $module->id }}')">
                                        <label class="form-check-label" for="module_{{ $module->id }}">{{ $module->name }}</label>
                                    </div>
                                    <ul>
                                        @foreach ($module->permissions as $permission)
                                            <li>
                                                <div class="form-check">
                                                    <input 
                                                        type="checkbox" 
                                                        class="form-check-input select_single_permission select_single_permission2 single_{{ $module->id }}" 
                                                        onclick="singlePermission('single_{{ $module->id }}', 'module_{{ $module->id }}')"  
                                                        id="permission_item_{{ $permission->id }}"
                                                        name="permission[]" 
                                                        value="{{ $permission->id }}"

                                                        @isset($role)
                                                            @foreach ($role->permissions as $role_permission)
                                                                {{ $permission->id ==  $role_permission->id ? 'checked' : ''}}
                                                            @endforeach
                                                        @endisset
                                                    >
                                                    <label class="form-check-label" for="permission_item_{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>

                                                
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach

                       </div>
                       <div class="row justify-content-end">
                            <button type="submit" id="save_btn" class="btn btn-primary rounded-0 mb-0">
                                <i class="fas fa-check"></i>
                                @isset($role)
                                    Update Changes
                                @else
                                    Save Changes
                                @endisset
                            </button>
                       </div>
                    </form>
                </div>
            </div><!-- /.card -->
        </div>
    </div>
@endsection


@push('script')
    <script>

        $(document).ready(function () {

            let single_check_all = $('.select_single_permission2:checked').length;
            let single_total_all = $('.select_single_permission2').length;
            console.log(single_total_all, single_check_all);
            if(single_check_all == single_total_all){
                $('#select_all_permission').prop('checked', true);
            }

            $('.permission-col').each(function (key, value) {
                let single_check = $(value).find('.select_single_permission2:checked').length;
                let single_total = $(value).find('.select_single_permission2').length;
                if(single_check == single_total){
                    $(value).find('.module_permission').prop('checked', true);
                }
            })
        });

        // All permission click
        function selectAllPermision(){
            if($('#select_all_permission:checked').length == 1){
                $('.select_single_permission').prop('checked', true);
            }else{
                $('.select_single_permission').prop('checked', false);
            }
        }

        // Module permisison click
        function moduleWisePermission(module_selector, single_selector){
            if($('.'+module_selector+':checked').length == 1){
                $('.'+single_selector).prop('checked', true);
            }else{
                $('.'+single_selector).prop('checked', false);
            }

            let total_module_check = $('.module_permission:checked').length;
            let total_module       = $('.module_permission').length;

            if(total_module_check == total_module){
                $('#select_all_permission').prop('checked', true);
            }else{
                $('#select_all_permission').prop('checked', false);
            }
        }

        // Single permission click
        function singlePermission(single_selector, module_selector){
            let total_single = $('.'+single_selector).length;
            let single_checked = $('.'+single_selector+':checked').length;

            if(total_single == single_checked){
                $('.'+module_selector).prop('checked', true);
            }else{
                $('.'+module_selector).prop('checked', false);
            }

            let total_module_check = $('.module_permission:checked').length;
            let total_module       = $('.module_permission').length;

            if(total_module_check == total_module){
                $('#select_all_permission').prop('checked', true);
            }else{
                $('#select_all_permission').prop('checked', false);
            }
        }
    </script>
@endpush
