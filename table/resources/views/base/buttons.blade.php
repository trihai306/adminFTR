@foreach($actions as $action)
    <a class='btn btn-primary action-button' data-action='{{ $action->name }}'
            @if($action->link) href='{{ $action->link }}' @endif
            @if($action->modalId) data-bs-toggle="modal" data-bs-target="#{{ $action->modalId }}" @endif>
        <i class='{{ $action->icon }}'></i> {{ $action->label }}
    </a>
@endforeach
