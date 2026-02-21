@extends('admin.layouts.app')

@section('button-area')
<a href="{{ route('admin.currencies.index') }}" class="btn btn-primary rounded-0 mb-0"><i
        class="fas fa-arrow-left button-icon"></i> Back</a>
@endsection


@push('style')
@endpush

@section('content')
<form id="currency_form" method="POST" action="{{ route('admin.currencies.update') }}" enctype="multipart/form-data">
    @csrf

    <input type="hidden" name="target" value="{{ $currency->id }}">

    <div class="row">
        <div class="col-xl-8">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <x-forms.textbox
                                    name="country"
                                    labelName="Country"
                                    placeholder="e.g. United States"
                                    required="required"
                                    value="{{ old('country', $currency->country) }}">
                                </x-forms.textbox>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <x-forms.textbox
                                name="name"
                                labelName="Currency Name"
                                placeholder="e.g. US Dollar"
                                required="required"
                                value="{{ old('name', $currency->name) }}">
                            </x-forms.textbox>
                        </div>
                        <div class="col-md-6">
                            <x-forms.textbox
                                name="code"
                                labelName="Code"
                                placeholder="e.g. USD"
                                required="required"
                                value="{{ old('code', $currency->code) }}">
                            </x-forms.textbox>
                        </div>
                        <div class="col-md-6">
                            <x-forms.textbox
                                name="symbol"
                                labelName="Symbol"
                                placeholder="e.g. $"
                                required="required"
                                value="{{ old('symbol', $currency->symbol) }}">
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
                                value="{{ old('rate', display_amount($currency->rate)) }}">
                            </x-forms.textbox>
                        </div>
                        <div class="col-md-6">
                            <x-forms.select name="option" required="required" labelName="Currency Type">
                                <option value="default" {{ old('option', ($currency->default ? 'default' : 'optional')) == 'default' ? 'selected' : '' }}>Default</option>
                                <option value="optional" {{ old('option', ($currency->default ? 'default' : 'optional')) == 'optional' ? 'selected' : '' }}>Optional</option>
                            </x-forms.select>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <button type="submit" class="btn btn-primary rounded-0 mb-0">
                            <i class="fas fa-check"></i>
                            Update Changes
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
                                <input type="hidden" name="old_flag" value="{{ $currency->flag }}">
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
    // Flag image picker
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

    @if($currency->flag)
    $('#flag img.spartan_image_placeholder').css('display', 'none');
    $('#flag .spartan_remove_row').css('display', 'none');
    $('#flag .img_').css('display', 'block');
    $('#flag .img_').attr('src', '{{ getImagePath($currency->flag, "flag") }}');
    $('#flag input[name="flag"]').attr('required', false);
    @endif
</script>
@endpush