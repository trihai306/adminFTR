@php
    $required = $isRequired ? 'required' : '';
    $classes = !empty($classes) ? 'form-control '.$classes : 'form-control';
    $placeholder = isset($placeholder) ? 'placeholder='.$placeholder : '';
@endphp

@if(!$canHide)

    <div wire:ignore>
        @if($label)
            <label for="{{ $name }}" class="mb-2">{{ $label }}</label>
        @endif
        <textarea name="{{ $name }}" id="{{$name}}" wire:model="data.{{ $name }}"
                  {{ $required }} class="{{ $classes }} @error('data.'.$name) is-invalid @enderror" {{ $attributes }} {{ $placeholder }}></textarea>
    </div>
    @error('data.'.$name)
    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
        <div data-field="{{$name}}" data-validator="notEmpty">{{$message}}</div>
    </div>
    @enderror
@endif

@script
<script>
    if (localStorage.getItem("tablerTheme") === 'dark') {
        var skin = 'oxide-dark';
        var content_css = 'dark';
    }
    {{--tinymce.init({--}}
    {{--    selector: '#{{$name}}',--}}
    {{--    skin: skin,--}}
    {{--    promotion: false,--}}
    {{--    statusbar: false,--}}
    {{--    content_css: content_css,--}}
    {{--    forced_root_block: false,--}}
    {{--    setup: function (editor) {--}}
    {{--        editor.on('init change', function () {--}}
    {{--            editor.save();--}}
    {{--        });--}}
    {{--        editor.on('change', function (e) {--}}
    {{--            var content = editor.getContent();--}}
    {{--            @this.set('data.{{$name}}', content);--}}
    {{--        });--}}
    {{--    }--}}
    {{--});--}}
</script>
@endscript
