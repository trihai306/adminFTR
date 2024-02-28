<a class='dropdown-item'
   @if($action->link) wire:navigate  href='{{ $action->link }}' @else href="#" @endif
   @if($action->modal) data-bs-toggle="modal" x-on:click="$wire.dispatch('setModel',{id:{{$action->id}}})" data-bs-target="#{{ $action->name }}" @endif
   @if(!empty($action->sweetAlert))
       wire:click.prevent="$dispatch('{{$action->sweetAlert['eventName']}}', {
                    message: '{{$action->sweetAlert['options']['message']}}',
                    id: {{$action->sweetAlert['options']['id']}},
                    nameMethod: '{{$action->sweetAlert['options']['nameMethod']}}'
                })" @endif
   data-action='{{ $action->name }}'>
    <i class='{{ $action->icon }}'></i> <span class="ms-2">{{ $action->label }}</span>
</a>
