<div class="modal modal-blur fade" wire:ignore id="{{$name}}" tabindex="-1" aria-labelledby="{{$name}}Label" aria-hidden="true">
    <form wire:submit.prevent="save">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="{{$name}}Label">{{$title}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @foreach($inputs as $input)
                        {!! $input->render() !!}
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('future::forms.close')}}</button>
                    <button type="submit" class="btn btn-primary" data-bs-dismiss="modal" >{{__('future::forms.save')}}</button>
                </div>
            </div>
        </div>
    </form>
</div>
