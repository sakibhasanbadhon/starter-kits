@extends('admin.layouts.app')


@push('style')
    <style>
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-section {
            margin-bottom: 30px;
        }
        .logo-upload {
            text-align: center;
        }
        .logo-upload img {
            width: 100px;
            height: auto;
        }
        .logo-upload button {
            margin-top: 10px;
        }

    </style>
@endpush



@section('content')

<div class="container my-5">
    <div class="form-container">
        <h2 class="text-center mb-4">Site Setting</h2>
        <form action="{{ route('admin.web.settings.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row text-center form-section">

                <div class="col-md-4 logo-upload">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <div class="col-md-12 px-0 text-center">
                            <div class="image">
                                @if(isset($websettiongs->logo))
                                    <img src="{{ getImagePath($websettiongs->logo, 'admin-profile') }}" class="img-fluid img-preview" alt="Logo">
                                @else
                                    <img src="" class="img-fluid img-preview d-none" alt="Logo">
                                @endif
                            </div>
                        </div>
                        <input type="hidden" name="old_image" value="{{ $websettiongs->logo ?? '' }}">
                    </div>
                    <small class="text-muted d-block mt-2">Suggested: 200x55</small>
                </div>
            </div>

            <div class="mb-3">
                <label for="siteName" class="form-label">Site name</label>
                <input type="text" name="sitename" class="form-control" id="siteName" value="{{ $websettiongs->sitename }}" placeholder="Ishop">
            </div>

            <div class="mb-3">
                <label for="siteUrl" class="form-label">Site URL</label>
                <input type="url" class="form-control" name="siteurl" id="siteUrl" value="{{ $websettiongs->siteurl }}" placeholder="http://ishop.clickoshop.com">
            </div>

            <div class="mb-3">
                <label for="metaTitle" class="form-label">Meta title</label>
                <input type="text" class="form-control" name="metatitle" id="metaTitle" value="{{ $websettiongs->metatitle }}" placeholder="Online Shopping for Men, Electronics, Apparel, Computers, Books, DVDs & more">
            </div>

            <div class="mb-3">
                <label for="metaDescription" class="form-label">Meta description</label>
                <textarea class="form-control" name="metadescription" id="metaDescription" rows="3" placeholder="Ishop is shopping platform for baby & kids essentials..."> {{ $websettiongs->metadescription }}</textarea>
            </div>

            <div class="mb-3">
                <label for="copyrightText" class="form-label">Copyright text</label>
                <input type="text" class="form-control" name="copyright_text" value="{{ $websettiongs->copyright_text }}" id="copyrightText" placeholder="All rights reserved by Ishop">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="primaryColor" class="form-label">Primary color</label>
                    <input type="text" name="primary_color" class="form-control" value="{{ $websettiongs->primary_color }}" id="primaryColor" placeholder="Primary color">
                </div>

            </div>

            <div class="d-flex justify-content-end">

                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('script')
    <script>
        $('.image').spartanMultiImagePicker({
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
                text: 'Only png, jpg, jpeg file format allowed!'
            });
        },
        onAddRow: function (index, file) {
            // Hide the previous image preview when a new image is added
            $('.img-preview').hide();
        },
    });

    @if(isset($websettiongs->logo))
        $('.spartan_image_placeholder').hide();
        $('.spartan_remove_row').hide();
        $('.img-preview').show();
    @endif

    $('.remove-files').on('click', function () {
        $(this).parents('.col-md-12').remove();
    });

    </script>
@endpush

