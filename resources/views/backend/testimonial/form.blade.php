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
                <form action="{{ route('admin.testimonials.store-or-update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @isset($edit)
                        <input type="hidden" name="update_id" value="{{ $edit->id }}">
                    @endisset
                    <x-forms.inputbox labelName="Full Name" name="full_name" required="required" placeholder="Enter full name" value="{{ $edit->full_name ?? old('full_name') }}"/>
                    <x-forms.inputbox labelName="Position" name="position" required="required" placeholder="Enter position" value="{{ $edit->position ?? old('position') }}"/>
                    <x-forms.inputbox labelName="Company" name="company" required="required" placeholder="Enter company" value="{{ $edit->company ?? old('company') }}"/>
                    <x-forms.textarea labelName="Content" name="content" required="required" placeholder="Enter content" value="{{ $edit->content ?? old('content') }}"></x-forms.textarea>
                    <x-forms.selectbox labelName="Rating" name="rating" required="required">
                        <option value="">-- Select Rating --</option>
                        @foreach (RATING as $id)
                            <option value="{{ $id }}" @isset($edit) {{ $id == $edit->rating ? 'selected' : '' }}@endisset>{{ $id }}</option>
                        @endforeach
                    </x-forms.selectbox>
                    <x-forms.selectbox labelName="Is Social" name="is_social" onchange="isSocial(this.value)">
                        <option value="2" @isset($edit) {{ 2 == $edit->is_social ? 'selected' : '' }}@endisset>No</option>
                        <option value="1" @isset($edit) {{ 1 == $edit->is_social ? 'selected' : '' }}@endisset>Yes</option>
                    </x-forms.selectbox>
                    <div id="social-media" class="d-none">
                        <x-forms.inputbox name="facebook" placeholder="Enter facebook link" value="{{ $edit->facebook ?? old('facebook') }}"/>
                        <x-forms.inputbox name="twitter" placeholder="Enter twitter link" value="{{ $edit->twitter ?? old('twitter') }}"/>
                        <x-forms.inputbox name="linkedin" placeholder="Enter linkedin link" value="{{ $edit->linkedin ?? old('linkedin') }}"/>
                        <x-forms.inputbox name="youtube" placeholder="Enter youtube link" value="{{ $edit->youtube ?? old('youtube') }}"/>
                    </div>
                    <x-forms.selectbox labelName="Status" name="status" required="required">
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

        function isSocial(id){
            if(id == 1){
                $('#social-media').removeClass('d-none');
            }else{
                $('#social-media').addClass('d-none');
            }
        }

        @if(isset($edit) && $edit->is_social == 1)
            isSocial({{ $edit->is_social }});
        @endif

        $(document).on('change','#social-media', function(){

        });

    </script>
@endpush
