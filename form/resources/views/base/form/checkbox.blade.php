@if(!$canHide)
    <div class="form-check">
        <input type="checkbox" name="{{ $name }}" wire:model="data.{{ $name }}" {{ $required }} class="form-check-input {{ $classes }}" {{ $attributes }} {{ $checked }}>
        <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>
    </div>
    @error('data.'.$name)
    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
        <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
    </div>
    @enderror

@endif
