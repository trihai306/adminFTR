<div class="card-header border-0 pt-3 pb-0 d-flex justify-content-between">
    <div class="card-title">
        <div class="d-flex align-items-center position-relative my-1">
            @include('future::components.search')
        </div>
    </div>
    <span class="bg bg-outline-primary mt-2 me-3" x-show="selectedRows.length > 0" style="width: 60%">
                    Selected <span class="badge bg-danger ms-1 me-1 text-white" x-text="length"></span> records
    </span>
    <div class="card-toolbar" x-show="selectedRows.length > 0">
        <div class="d-flex flex-column flex-md-row justify-content-end">

            <div class="dropdown">
                <button class='btn align-text-top btn-outline-danger dropdown-toggle' type='button'
                        data-bs-auto-close="outside"
                        data-bs-toggle='dropdown'>{{__('future::messages.bulk-action')}}</button>
                @if($bulkActions)
                <div class='dropdown-menu'>
                    <a x-on:click="
                                $wire.SelectedRows(selectedRows,'deletes','bạn có chắc chắn muốn xóa?');
                                " class="dropdown-item">
                        <i class="fa fa-trash"></i>
                        <span class="ms-2">{{ __('future::messages.delete_all') }}</span>
                    </a>
                    @foreach($bulkActions as $bulkAction)

                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
