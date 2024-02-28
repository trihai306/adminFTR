@php
    $required = $isRequired ? 'required' : '';
    $classes = !empty($classes) ? 'form-control '.$classes : 'form-control';
    $min = isset($min) ? 'min='.$min : '';
    $max = isset($max) ? 'max='.$max : '';
    $step = isset($step) ? 'step='.$step : '';
    $placeholder = isset($placeholder) ? 'placeholder='.$placeholder : '';
@endphp

@if($label)
    <label for="{{ $name }}">{{ $label }}</label>
@endif

<input type="number" name="{{ $name }}" wire:model="data.{{ $name }}" {{ $required }} class="{{ $classes }} @error('data.'.$name) is-invalid @enderror" {{ $attributes }} {{ $min }} {{ $max }} {{ $step }} {{ $placeholder }}>

@error('data.'.$name)
<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
    <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
</div>
@enderror
