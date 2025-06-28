@extends('layouts.app')


@push('style')
@endpush

@section('content')
    <form id="role_form" method="POST" action="{{ route('admin.admins.store-or-update') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-8">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        @csrf
                        @isset($admin)
                            <input type="hidden" name="target" value="{{ $admin->id }}">
                        @endisset
                        <div class="row">
                            <div class="col-md-6">
                                <x-forms.textbox
                                    name="first_name"
                                    labelName="First Name"
                                    placeholder="First Name"
                                    required="required"
                                    value="{{ old('first_name', @$admin->first_name) }}">
                                </x-forms.textbox>
                            </div>
                            <div class="col-md-6">
                                <x-forms.textbox
                                    name="last_name"
                                    labelName="Last Name"
                                    placeholder="Last Name"
                                    required="required"
                                    value="{{ old('last_name', @$admin->last_name) }}">
                                </x-forms.textbox>
                            </div>
                            <div class="col-md-6">
                                <x-forms.textbox
                                    name="email"
                                    labelName="Email"
                                    placeholder="Email"
                                    required="required"
                                    type="email"
                                    value="{{ old('email', @$admin->email) }}">
                                </x-forms.textbox>
                            </div>
                            <div class="col-md-6">
                                <x-forms.textbox
                                    name="phone"
                                    labelName="Phone"
                                    placeholder="Phone"
                                    required="required"
                                    type="number"
                                    value="{{ old('phone', @$admin->phone) }}">
                                </x-forms.textbox>
                            </div>

                            @if($form_type=='create')
                                <div class="col-md-6">
                                    <x-forms.toggle-password
                                        name="password"
                                        labelName="Password"
                                        placeholder="Password"
                                        required="required"
                                        type="password">
                                    </x-forms.toggle-password>
                                </div>
                                <div class="col-md-6">
                                    <x-forms.toggle-password
                                        name="password_confirmation"
                                        labelName="Confirm Password"
                                        placeholder="Confirm Password"
                                        required="required"
                                        type="password">
                                    </x-forms.toggle-password>
                                </div>
                            @else
                                 <div class="col-md-6">
                                    <x-forms.toggle-password
                                        name="password"
                                        labelName="Password"
                                        placeholder="Password"
                                        type="password">
                                    </x-forms.toggle-password>
                                </div>
                                <div class="col-md-6">
                                    <x-forms.toggle-password
                                        name="password_confirmation"
                                        labelName="Confirm Password"
                                        placeholder="Confirm Password"
                                        type="password">
                                    </x-forms.toggle-password>
                                </div>
                            @endif



                        </div>
                        <div class="row justify-content-end">
                            <button type="submit" class="btn btn-primary rounded-0 mb-0">
                                <i class="fas fa-check"></i>
                                @isset($admin)
                                    Update Changes
                                @else
                                    Save Changes
                                @endisset
                            </button>
                        </div>
                    </div>
                </div><!-- /.card -->
            </div>
            <div class="col-xl-4">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <div class="col-md-12 px-0 text-center">
                                    <div id="image">

                                    </div>
                                </div>
                                <input type="hidden" name="old_image" value="{{ @$admin->image }}">
                            </div>
                        </div>


                        @if($form_type == 'create' || auth()->user()->id != $admin->id)
                            <div class="col-12">
                                <x-forms.select name="role" required="required" class="select2" labelName="Role">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" @isset($admin) {{ $role->id == $admin->role_id ? 'selected' : '' }}@endisset>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </x-forms.select>
                            </div>
                        @endif


                      </div>
                    </div>
                </div><!-- /.card -->
            </div>
        </div>
    </form>
@endsection


@push('script')
    <script>
        $('#image').spartanMultiImagePicker({
            fieldName: 'image',
            maxCount: 1,
            rowHeight: '150px',
            groupClassName: 'col-md-12 com-sm-12 com-xs-12',
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

        @if(isset($admin->image))
            $('#image img.spartan_image_placeholder').css('display','none');
            $('#image .spartan_remove_row').css('display','none');
            $('#image .img_').css('display','block');
            $('#image .img_').attr('src','{{ getImagePath($admin->image, "admin-profile") }}');
            $('#image input[name="image"]').attr('required',false);
        @endif

        $('.remove-files').on('click', function () {
            $(this).parents('.col-md-12').remove();
        });

    </script>
@endpush
