@if(!$canHide)
    @php
        $required = $isRequired ? 'required' : '';
        $classes = !empty($classes) ? 'form-check-input '.$classes : 'form-check-input';
    @endphp

    @if($label)
        <label>{{ $label }}</label>
    @endif

    @foreach($options as $value => $labelOption)
        @php
            $checked = $value == $defaultValue ? 'checked' : '';
        @endphp
        <div class="form-check">
            <input type="radio" name="{{ $name }}" value="{{ $value }}" wire:model="data.{{ $name }}" {{ $required }} class="{{ $classes }}" {{ $attributes }} {{ $checked }}>
            <label class="form-check-label" for="{{ $name }}">{{ $labelOption }}</label>
        </div>
    @endforeach

@endif
