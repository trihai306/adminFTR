<div class="card {{ $classes }}  rounded rounded-4 shadow"
@if($attributes)
    @foreach ($this->attributes as $name => $value)
        {{ $name }}="{{ $value }}"
    @endforeach
    @endif
>
    @if($title)
        <div class="card-header {{ $headerClasses }} h4 mt-3">{{ $title }}</div>
    @endif
    <div class="card-body {{ $bodyClasses }}">
        @foreach($fields as $field)
            {!! $field->render() !!}
        @endforeach
    </div>
    @if($footer)
        <div class="card-footer text-muted">{{ $footer }}</div>
    @endif
</div>
