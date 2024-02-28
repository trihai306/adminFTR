@if($can)
    <a class="btn btn-{{$color ?:'light-primary'}}" @if($url)href="{{$url}}" wire:navigate @endif
       @if($modal)data-bs-toggle="modal" x-on:click="$wire.dispatch('setModel',{id:null})" data-bs-target="#{{$name}}"@endif>
        @if($icon)<i class="{{$icon}}"></i>@endif <span class="ms-2">{{$label}}</span>
    </a>

    @if($modal)
        @livewire($form,[
            'id'=>null,
            'name'=>$name,
            'title'=>$title,
        ])@endif

@endif
