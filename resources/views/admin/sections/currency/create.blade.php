@extends('admin.layouts.app')

@section('button-area')
<a href="{{ route('admin.currencies.index') }}" class="btn btn-primary rounded-0 mb-0"><i
        class="fas fa-arrow-left button-icon"></i> Back</a>
@endsection


@push('style')
@endpush

@section('content')
<form id="currency_form" method="POST" action="{{ route('admin.currencies.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xl-8">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <x-forms.textbox
                                name="country"
                                labelName="Country"
                                placeholder="e.g. United States"
                                required="required"
                                value="{{ old('country') }}">
                            </x-forms.textbox>
                        </div>
                        <div class="col-md-6">
                            <x-forms.textbox
                                name="name"
                                labelName="Name"
                                placeholder="e.g. US Dollar"
                                required="required"
                                value="{{ old('name') }}">
                            </x-forms.textbox>
                        </div>
                        <div class="col-md-6">
                            <x-forms.textbox
                                name="code"
                                labelName="Code"
                                placeholder="e.g. USD"
                                required="required"
                                value="{{ old('code') }}">
                            </x-forms.textbox>
                        </div>
                        <div class="col-md-6">
                            <x-forms.textbox
                                name="symbol"
                                labelName="Symbol"
                                placeholder="e.g. $"
                                required="required"
                                value="{{ old('symbol') }}">
                            </x-forms.textbox>
                        </div>
                        <div class="col-md-6">
                            <x-forms.textbox
                                name="rate"
                                labelName="Rate"
                                placeholder="e.g. 1.00"
                                required="required"
                                type="number"
                                step="any"
                                value="{{ old('rate') }}">
                            </x-forms.textbox>
                        </div>
                        <div class="col-md-6">
                            <x-forms.select name="option" required="required" labelName="Currency Type">
                                <option value="default" {{ old('option') == 'default' ? 'selected' : '' }}>Default</option>
                                <option value="optional" {{ old('option') == 'optional' ? 'selected' : '' }}>Optional</option>
                            </x-forms.select>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <button type="submit" class="btn btn-primary rounded-0 mb-0">
                            <i class="fas fa-check"></i>
                            Save Changes
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
                                <label for="flag">Flag</label>
                                <div class="col-md-12 px-0 text-center">
                                    <div id="flag">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.card -->
        </div>
    </div>
</form>
@endsection


@push('script')
<script>
    $('#flag').spartanMultiImagePicker({
        fieldName: 'flag',
        maxCount: 1,
        rowHeight: '150px',
        groupClassName: 'col-md-12 com-sm-12 com-xs-12',
        maxFileSize: '',
        dropFileLabel: 'Drop Here',
        allowExt: 'png|jpg|jpeg|svg|webp',
        onExtensionErr: function(index, file) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Only png,jpg,jpeg,svg,webp file format allowed!'
            });
        }
    });
</script>
@endpush