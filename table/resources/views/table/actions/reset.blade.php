<a wire:click.prevent="resetTable" wire:target="resetTable"  wire:loading.remove class="btn btn-{{$color ?:'primary'}}">
    <i class="{{$icon ?:"fa fa-redo-alt"}}"></i> <span class="ms-2">{{ __('future::messages.reset') }}</span>
</a>
<a wire:loading wire:target="resetTable"  class="btn btn-{{$color ?:'primary'}}">
   <span class="ms-2">loading ....</span>
</a>
