<div>
    <form wire:submit.prevent="save">
        <div class="card mb-3 rounded rounded-5 shadow">
            <div class="card-body d-flex justify-content-end">
                <button type="submit" class="btn btn-primary me-2">
                    <span class="indicator-label" wire:target="save" wire:loading.remove> <i class="fas fa-save"></i> {{ __('future::forms.save') }}</span>
                    <span class="indicator-progress" wire:target="save" wire:loading>{{ __('future::forms.please_wait') }}
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <button type="reset" class="btn btn-secondary ">
                    <i class="fas fa-undo"></i> <span class="ms-1">{{ __('future::forms.reset') }}</span>
                </button>
            </div>
        </div>
        @foreach($inputs as $input)
            {!! $input->render() !!}
        @endforeach

    </form>
</div>
