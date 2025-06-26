<div class="form-group {{ $groupClass ?? '' }}">
    <label for="{{ $name }}" class="{{ $required ?? '' }}">{{ $labelName }}</label>
    <input type="{{ $type ?? 'text' }}" class="form-control form-control-sm {{ $class ?? '' }}"  name="{{ $name }}" id="{{ $name }}" placeholder="{{ $placeholder ?? '' }}" value="{{ $value ?? '' }}">
    @isset($error)
        @error($error)
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    @endisset
</div>
