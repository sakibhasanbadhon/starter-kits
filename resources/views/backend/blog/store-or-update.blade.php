@extends('backend.layouts.app')
@section('title', $title)
@push('styles')

@endpush
@section('content')
<form action="{{ route('admin.posts.store-or-update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @isset($edit)
        <input type="hidden" name="update_id" value="{{ $edit->id }}">
    @endisset
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-2">
                    <h4 class="mb-0 cd-title">{{ $title }}</h4>
                </div>
                <div class="card-body">
                    <x-forms.inputbox labelName="Title" name="title" required="required" placeholder="Enter title" value="{{ $edit->title ?? old('title') }}"/>
                    <x-forms.textarea labelName="Excerpt" name="excerpt" required="required" placeholder="Enter post excerpt" value="{{ $edit->excerpt ?? old('excerpt') }}"/>
                    <x-forms.textarea labelName="Content" name="body" required="required" value="{{ isset($edit) ? $edit->body : old('body') }}"/>
                    <x-forms.inputbox labelName="Meta Title" name="meta_title" placeholder="Enter meta title" value="{{ $edit->meta_title ?? old('meta_title') }}"/>
                    <x-forms.textarea labelName="Meta Description" name="meta_description" value="{{ isset($edit) ? $edit->meta_description : old('meta_description') }}" placeholder="Enter meta description"/>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header py-2">
                    <button type="submit" class="btn btn-sm btn-primary shadow-none px-2"><i class="fa fa-save fa-sm"></i> Save</button>
                </div>
                <div class="card-body">
                    <x-forms.selectbox labelName="Category" name="category_id" required="required">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $id=>$name)
                        <option value="{{ $id }}" @isset($edit) {{ $edit->category_id == $id ? 'selected' : '' }} @endisset>{{ $name }}</option>
                        @endforeach
                    </x-forms.selectbox>
                    <x-forms.selectbox labelName="Is Featured" name="is_featured" required="required">
                        <option value="">-- Select Option --</option>
                        @foreach (IS_FEATURED as $id=>$name)
                        <option value="{{ $id }}" @isset($edit) {{ $edit->is_featured == $id ? 'selected' : '' }} @endisset>{{ $name }}</option>
                        @endforeach
                    </x-forms.selectbox>
                    <x-forms.selectbox labelName="Status" name="status" required="required">
                        @foreach (POST_STATUS as $id=>$name)
                        <option value="{{ $id }}" @isset($edit) {{ $edit->status == $id ? 'selected' : '' }} @endisset>{{ $name }}</option>
                        @endforeach
                    </x-forms.selectbox>
                    <div id="image">
                        <label for="feature_image" class="required">Feature Image</label>
                    </div>
                    <input type="hidden" name="old_feature_image" value="{{ $edit->feature_image ?? '' }}">
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
    <script src="{{ asset('backend/js/spartan-multi-image-picker-min.js') }}"></script>
    <script>
        $('#image').spartanMultiImagePicker({
            fieldName: 'feature_image',
            maxCount: 1,
            rowHeight: '200px',
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
    </script>
@endpush
