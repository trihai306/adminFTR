@if(!$canHide)
    @if(!is_null($label))
        <label class="mb-2" for="{{ $name }}">{{ $label }}</label>
    @endif
    <input  type="{{ $type }}" name="{{ $name }}"  id="{{$name}}" {{ $required ? 'required' : '' }}
    wire:model="data.{{$name}}" class="form-control form-control-rounded text-gray-800 fw-bold @error('data.'.$name) is-invalid @enderror {{ $classes }}"
            {{ $attributes }} {{ !is_null($defaultValue) ? 'value='.$defaultValue : '' }}
            {{ !empty($placeholder) ? 'placeholder='.$placeholder : '' }}
            {{ !is_null($maxLength) ? 'maxlength='.$maxLength : '' }}
            {{ !is_null($pattern) ? 'pattern='.$pattern : '' }}
            autocomplete="{{ $autocomplete }}" {{ $readOnly ? 'readonly' : '' }}
        {{ $disabled ? 'disabled' : '' }} {{ !is_null($size) ? 'size='.$size : '' }}
        {{ !is_null($step) ? 'step='.$step : '' }}>
    @error('data.'.$name)
    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
        <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
    </div>
    @enderror
@endif

