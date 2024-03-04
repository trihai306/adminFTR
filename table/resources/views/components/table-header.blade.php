<div class="card-header border-0 pt-3 pb-0 d-flex justify-content-between">
    <div class="card-title">
        <div class="d-flex align-items-center position-relative my-1">
            @include('future::components.search')
        </div>
    </div>
    <div class="card-toolbar">
        <div class="d-flex flex-column flex-md-row justify-content-end ">
            @if($bulkActions)
            <div x-show="selectedRows.length > 0" class="dropdown" style="display: none">
                <button class='btn align-text-top btn-outline-danger dropdown-toggle' type='button'
                        data-bs-auto-close="outside"
                        data-bs-toggle='dropdown'>{{__('future::messages.bulk-action')}}</button>
                <div class='dropdown-menu'>
                    @foreach($bulkActions as $bulkAction)
                        <a x-on:click="
                                $wire.SelectedRows(selectedRows,'deletes','bạn có chắc chắn muốn xóa?');
                                " class="dropdown-item">
                            <i class="fa fa-trash"></i>
                            <span class="ms-2">{{ __('future::messages.delete_all') }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
