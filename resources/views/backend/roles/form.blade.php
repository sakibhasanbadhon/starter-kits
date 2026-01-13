@extends('backend.layouts.app')
@section('title', $title)
@push('styles')

@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="role_form" method="POST" action="{{ route('admin.roles.store-or-update') }}">
                        @csrf
                        @isset($role)
                            <input type="hidden" name="update_id" value="{{ $role->id }}">
                        @endisset
                        <x-forms.inputbox name="name" labelName="Role Name" placeholder="Role Name" required="required" value="{{ $role->name ?? old('name') }}"/>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="select_all_permission" onchange="selectAllPermision()">
                            <label class="form-check-label" for="select_all_permission"><strong style="font-size: 15px;">All Permission</strong></label>
                        </div>
                        @error('permissions')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <table class="table table-bordered table-sm mt-2">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Module</th>
                                    <th>Permissions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modules as $module)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                class="form-check-input module_{{ $module->id }} module_permission"
                                                id="module_{{ $module->id }}"
                                                onclick="moduleWisePermission('module_{{ $module->id }}', 'single_{{ $module->id }}')"
                                            >
                                            <label class="form-check-label" for="module_{{ $module->id }}">
                                                {{ $module->name }}
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($module->permissions as $permission)
                                            <div class="form-check mr-3">
                                                <input
                                                    type="checkbox"
                                                    class="form-check-input select_single_permission2 single_{{ $module->id }}"
                                                    id="permission_item_{{ $permission->id }}"
                                                    name="permission[]"
                                                    value="{{ $permission->id }}"
                                                    onclick="singlePermission('single_{{ $module->id }}', 'module_{{ $module->id }}')"

                                                    @isset($role)
                                                        @foreach ($role->permissions as $role_permission)
                                                            {{ $permission->id ==  $role_permission->id ? 'checked' : ''}}
                                                        @endforeach
                                                    @endisset
                                                >
                                                <label class="form-check-label" for="permission_item_{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="text-right mt-2">
                            <button type="submit" class="btn btn-primary btn-sm shadow-none">
                                @isset($role)
                                Update
                                @else
                                Save
                                @endisset
                            </button>
                        </div>
                    </form>
                </div>
            </div><!-- /.card -->
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function selectAllPermision() {
        let isChecked = $('#select_all_permission').is(':checked');
        $('.form-check-input').prop('checked', isChecked);
    }

    function moduleWisePermission(moduleId, singleClass) {
        let isChecked = $('#' + moduleId).is(':checked');
        $('.' + singleClass).prop('checked', isChecked);
        checkAllPermissionStatus();
    }

    function singlePermission(singleClass, moduleId) {
        let total = $('.' + singleClass).length;
        let checked = $('.' + singleClass + ':checked').length;
        $('#' + moduleId).prop('checked', total === checked);
        checkAllPermissionStatus();
    }

    function checkAllPermissionStatus() {
        let totalCheckboxes = $('.select_single_permission2').length;
        let totalChecked = $('.select_single_permission2:checked').length;
        $('#select_all_permission').prop('checked', totalCheckboxes === totalChecked);
    }

    $(document).ready(function () {
        $('[id^="module_"]').each(function () {
            let moduleId = $(this).attr('id');
            let singleClass = 'single_' + moduleId.replace('module_', '');
            singlePermission(singleClass, moduleId);
        });
        checkAllPermissionStatus();
    });
</script>

@endpush
