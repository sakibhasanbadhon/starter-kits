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
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? 'active' : '' }}"
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

            <form action="{{ route('admin.ui-content.save',$pageKey) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6 mx-auto">
                        <div class="col-md-12 px-0 text-center">
                            <div id="image"></div>
                        </div>
                        <input type="hidden" name="old_image" value="{{ @$contentData->value->image }}">
                    </div>
                </div>

                <div class="tab-content" id="myTabContent">
                    @foreach ($availableLanguages as $index => $item)
                        @php
                            $lang_code = $item->code;
                        @endphp
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                            id="content-{{ $item->id }}"
                            role="tabpanel"
                            aria-labelledby="tab-{{ $item->id }}">

                            <div class="content-card card">
                                <div class="card-body">
                                    <div class="row">


                                        <div class="col-md-12">
                                            <x-forms.textbox
                                                name="{{ $item->code }}_title"
                                                labelName="Title ({{ $item->name }})"
                                                placeholder="Enter title"
                                                required="required"
                                                type="text"
                                                value="{{ old($item->code . '_title', $contentData->value->lang->$lang_code->title ?? '') }}">
                                            </x-forms.textbox>
                                        </div>

                                        <div class="col-md-12">
                                            <x-forms.textbox
                                                name="{{ $item->code }}_subtitle"
                                                labelName="Subtitle ({{ $item->name }})"
                                                placeholder="Enter subtitle"
                                                required="required"
                                                type="text"
                                                value="{{ old($item->code . '_subtitle', $contentData->value->lang->$lang_code->subtitle ?? '') }}">
                                            </x-forms.textbox>
                                        </div>

                                        <div class="col-md-12">
                                            <x-forms.textbox
                                                name="{{ $item->code }}_button_name"
                                                labelName="Button Name ({{ $item->name }})"
                                                placeholder="Enter button name"
                                                required="required"
                                                type="text"
                                                value="{{ old($item->code . '_button_name', $contentData->value->lang->$lang_code->button_name ?? '') }}">
                                            </x-forms.textbox>
                                        </div>

                                        <div class="col-md-12">
                                            <x-forms.textbox
                                                name="{{ $item->code }}_button_link"
                                                labelName="Button Link ({{ $item->name }})"
                                                placeholder="Enter button link"
                                                required="required"
                                                type="text"
                                                value="{{ old($item->code . '_button_link', $contentData->value->lang->$lang_code->button_link ?? '') }}">
                                            </x-forms.textbox>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary px-5 py-3"
                                style="border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                            <i class="fas fa-paper-plane mr-2"></i> Submit
                        </button>
                    </div>
                </div>

            </form>

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



        @if(isset($contentData->value->image))
            $('#image img.spartan_image_placeholder').css('display','none');
            $('#image .spartan_remove_row').css('display','none');
            $('#image .img_').css('display','block');
            $('#image .img_').attr('src','{{ getImagePath($contentData->value->image, "ui-section") }}');
            $('#image input[name="image"]').attr('required',false);
        @endif

        $('.remove-files').on('click', function () {
            $(this).parents('.col-md-12').remove();
        });



    </script>
@endpush
