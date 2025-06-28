<div class="form-group {{ $groupClass ?? '' }}">
    <label for="{{ $name }}" class="{{ $required ?? '' }}">{{ $labelName }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-control form-control-sm {{ $class ?? '' }}" @if(!empty($onchange)) onchange="{{ $onchange }}" @endif @if(!empty($multiple)) multiple @endif>
        {{ $slot }}
    </select>
    @isset($name)
        @error($name)
            <small class="text-danger d-block">{{ $message }}</small>
        @enderror
    @endisset
</div>
