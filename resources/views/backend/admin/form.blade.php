@extends('backend.layouts.app')

@section('title',$title)
@push('styles')

@endpush
@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0 card-title">{{ $title }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.admins.store-or-update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($edit)
                        <input type="hidden" name="update_id" value="{{ $edit->id }}">
                    @endisset
                    <x-forms.inputbox labelName="First Name" name="first_name" required="required" placeholder="Enter first name" value="{{ $edit->first_name ?? old('first_name') }}"/>
                    <x-forms.inputbox labelName="Last Name" name="last_name" required="required" placeholder="Enter last name" value="{{ $edit->last_name ?? old('last_name') }}"/>
                    <x-forms.inputbox type="email" labelName="Email" name="email" required="required" placeholder="Enter email" value="{{ $edit->email ?? old('email') }}"/>
                    <x-forms.inputbox type="tel" labelName="Phone" name="phone" required="required" placeholder="Enter phone no." value="{{ $edit->phone ?? old('phone') }}"/>
                    <div class="form-group">
                        <label for="password" class="required">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control form-control-sm shadow-none" placeholder="Enter password">
                            <div class="input-group-prepend border border-warning">
                                <span class="input-group-text bg-warning border-0">
                                    <i class="fas fa-eye-slash fa-sm" id="toggle-password" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        </div>
                        @error('password')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation" class="required">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-sm shadow-none" placeholder="Enter password">
                            <div class="input-group-prepend border border-warning">
                                <span class="input-group-text bg-warning border-0">
                                    <i class="fas fa-eye-slash fa-sm" id="toggle-confirm-password" style="cursor: pointer;"></i>
                                </span>
                            </div>
                        </div>
                        @error('password_confirmation')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror
                    </div>
                    <x-forms.selectbox labelName="Role" name="role_id" required="required">
                        <option value="">-- Select Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @isset($edit) {{ $role->id == $edit->role_id ? 'selected' : '' }}@endisset>{{ $role->name }}</option>
                        @endforeach
                    </x-forms.selectbox>
                    <x-forms.selectbox labelName="Status" name="status" required="required">
                        <option value="">-- Select Status --</option>
                        @foreach (STATUS as $id=>$name)
                            <option value="{{ $id }}" @isset($edit) {{ $id == $edit->status ? 'selected' : '' }}@endisset>{{ $name }}</option>
                        @endforeach
                    </x-forms.selectbox>

                    <div id="image" style="width: 120px;">
                        <label for="image">Image</label>
                    </div>
                    <input type="hidden" name="old_image" value="{{ $edit->image ?? '' }}">

                    <div class="text-right">
                        <button type="submit" class="btn btn-sm btn-primary shadow-none px-3">
                            @isset($edit)
                            Update
                            @else
                            Save
                            @endisset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
    <script src="{{ asset('backend/js/spartan-multi-image-picker-min.js') }}"></script>
    <script>
        $('#image').spartanMultiImagePicker({
            fieldName: 'image',
            maxCount: 1,
            rowHeight: '120px',
            groupClassName: 'col-md-12 com-sm-12 com-xs-12 px-0',
            maxFileSize: '',
            dropFileLabel: 'Drop Here',
            allowExt: 'png|jpg|jpeg',
            onExtensionErr: function (index, file) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Only png,jpg,jpeg file format allowed!'
                });
            }
        });

        @if(isset($edit->image))
            $('#image img.spartan_image_placeholder').css('display','none');
            $('#image .spartan_remove_row').css('display','none');
            $('#image .img_').css('display','block');
            $('#image .img_').attr('src','{{ file_path($edit->image) }}');
            $('#image input[name="image"]').attr('required',false);
        @endif

        $('.remove-files').on('click', function () {
            $(this).parents('.col-md-12').remove();
        });

        // password
        $(document).on('click','#toggle-password',function(){
            $('input#password').attr('type', function(i, type) {
                return type === 'password' ? 'text' : 'password';
            });
            $(this).toggleClass('fa-eye fa-eye-slash');
        });

        // confirm password
        $(document).on('click','#toggle-confirm-password',function(){
            $('input#password_confirmation').attr('type', function(i, type) {
                return type === 'password' ? 'text' : 'password';
            });
            $(this).toggleClass('fa-eye fa-eye-slash');
        });


    </script>
@endpush
