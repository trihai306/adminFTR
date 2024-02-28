<div class="card-header border-0 pt-3 pb-0 d-flex justify-content-between">
    <div class="card-title">
        <div class="d-flex align-items-center position-relative my-1">
            @include('future::components.search')
        </div>
    </div>
    <div class="card-toolbar">
        <div class="d-flex flex-column flex-md-row justify-content-end ">
            <div x-show="selectedRows.length > 0" class="btn-group" style="display: none">
                <button x-on:click="
                $wire.SelectedRows(selectedRows,'deletes','bạn có chắc chắn muốn xóa?');
                " class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                    <span class="ms-2">{{ __('future::messages.delete_all') }}</span>
                </button>
            </div>
        </div>
    </div>
</div>
