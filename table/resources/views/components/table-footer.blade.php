<div class="row mt-2">
    <div
        class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center justify-content-md-start">
        {{ __('future::messages.showing_from_to', ['first' => $data->firstItem(), 'last' => $data->lastItem(), 'total' => $data->total()]) }}
    </div>

    <div
        class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center justify-content-md-center">
        <div class="dataTables_length">
            <label>
                <select class="form-select form-select-solid" wire:model.live.debounce.300ms="perPage">
                    @foreach($this->pages as $page)
                        @if($page == $perPage)
                            <option value="{{ $page }}" selected>{{ $page }}</option>
                        @else
                            <option value="{{ $page }}">{{ $page }}</option>
                        @endif
                    @endforeach
                </select>
            </label>
        </div>
    </div>

    <div class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center justify-content-md-end">
        {{
           $data->links(data: ['scrollTo' => false])
        }}
    </div>
</div>
