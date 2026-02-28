@extends('admin.layouts.app')


@section('content')

<div class="row modern-card">
    <!-- Left Side - Tabs -->
    <div class="col-md-4 col-lg-3 p-0">
        <div class="tabs-left-container">
            <div class="badge-premium text-center d-flex justify-content-center">
                <div>
                    <i class="fas fa-globe mr-2"></i>
                    <span>All Languages</span>
                </div>
            </div>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach ($availableLanguages as $index => $item)
                    <li class="nav-item"><a class="nav-link {{ $loop->first ? 'active' : '' }}"
                           id="tab-{{ $item->id }}"
                           data-toggle="tab"
                           href="#content-{{ $item->id }}"
                           role="tab"
                           aria-controls="content-{{ $item->id }}"
                           aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            <span>{{ $item->name }}</span>
                            <i class="fas fa-chevron-right ml-auto"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Right Side - Content -->
    <div class="col-md-8 col-lg-9 p-0">
        <div class="tab-content-wrapper">
            <div class="tab-content" id="myTabContent">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        {{-- <label for="image">Image</label> --}}
                        <div class="col-md-12 px-0 text-center">
                            <div id="image">

                            </div>
                        </div>
                        <input type="hidden" name="old_image" value="{{ @$admin->image }}">
                    </div>
                </div>
                @foreach ($availableLanguages as $index => $item)
                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                         id="content-{{ $item->id }}"
                         role="tabpanel"
                         aria-labelledby="tab-{{ $item->id }}">
                        <div class="content-card card">
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-12">
                                        <x-forms.textbox
                                            name="title"
                                            labelName="Title"
                                            placeholder="Title"
                                            required="required"
                                            type="text"
                                            value="{{ old('title', @$admin->title) }}">
                                        </x-forms.textbox>
                                    </div>
                                    <div class="col-md-12">
                                        <x-forms.textbox
                                            name="subtitle"
                                            labelName="Subtitle"
                                            placeholder="Subtitle"
                                            required="required"
                                            type="text"
                                            value="{{ old('subtitle', @$admin->subtitle) }}">
                                        </x-forms.textbox>
                                    </div>
                                    <div class="col-md-12">
                                        <x-forms.textbox
                                            name="button_name"
                                            labelName="Button Name"
                                            placeholder="Button Name"
                                            required="required"
                                            type="text"
                                            value="{{ old('button_name', @$admin->button_name) }}">
                                        </x-forms.textbox>
                                    </div>
                                    <div class="col-md-12">
                                        <x-forms.textbox
                                            name="button_link"
                                            labelName="Button Link"
                                            placeholder="Button Link"
                                            required="required"
                                            type="text"
                                            value="{{ old('button_link', @$admin->button_link) }}">
                                        </x-forms.textbox>
                                    </div>





                                    <button class="btn btn-primary mt-3 px-5 py-3" style="border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                                        <i class="fas fa-paper-plane mr-2"></i> Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>



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
