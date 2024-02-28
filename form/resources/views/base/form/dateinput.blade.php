@php
    $required = $isRequired ? 'required' : '';
    $classes = !empty($classes) ? 'form-control form-control-rounded '.$classes : 'form-control form-control-rounded';
    $placeholder = isset($placeholder) ? 'placeholder='.$placeholder : '';
@endphp

@if($label)
    <label class="mt-2" for="{{ $name }}">{{ $label }}</label>
@endif
<input type="text" name="{{ $name }}" id="{{$name}}" wire:model="data.{{ $name }}"
       {{ $required }} class="{{ $classes }}" {{ $attributes }} {{ $placeholder }}>
@error('data.'.$name)
<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
    <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
</div>
@enderror
@script
<script>
    let input = document.getElementById('{{$name}}');
    new Pikaday({
        field: input,
        format: '{{$format}}',
        onSelect: function() {
            @this.set('data.{{$name}}', input.value);
        },
    });

</script>
@endscript
