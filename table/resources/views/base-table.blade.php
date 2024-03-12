<div x-data="tableData" @data="updateData()" @reset-select.window="selectAll = false; selectedRows = [];">
    <div class="container-xl mb-5">
        <div class="row g-2 align-items-center">
            <div class="col">
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    @foreach($headerActions as $headerAction)
                        {{ $headerAction->render()}}
                    @endforeach
                    <div>
                        <button type="button" class="btn btn-primary h-100"
                                data-bs-toggle="dropdown" data-bs-auto-close="outside">
                            <i class="fa fa-filter"></i>
                        </button>
                        <div class="dropdown-menu p-0" wire:ignore>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title fw-bold">Filter</h3>
                                </div>
                                <div class="card-body">
                                    <form wire:submit.prevent="applyFilters">
                                        <div class="fv-row mb-10">
                                            <div class="mb-3">
                                                @foreach($Input_filters as $filter)
                                                    <br>
                                                    {!! $filter->render() !!}
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                                                Discard
                                            </button>
                                            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                                                <span class="indicator-label"
                                                      wire:loading.class="hidden">Tìm kiếm</span>
                                                <span class="indicator-progress" wire:loading>Please wait...
                                      <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div x-data="{ isToggled: false }">
                        <button type="button" class="btn btn-primary h-100"
                                data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                @click="isToggled = !isToggled">
                            <i x-bind:class="isToggled ? 'fa fa-toggle-on' : 'fa fa-toggle-off'"></i>
                        </button>
                        <div class="dropdown-menu" wire:ignore>
                            @foreach($this->defineColumns() as $column)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox"
                                           wire:model.live.debounce.300ms="columnVisibility.{{ $column->name }}"
                                        {{ $column->visible ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $column->name }}">
                                        {{ $column->label }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="card rounded rounded-5">
        @include('future::components.table-header')
        <div class="card-body table-responsive  table-loading py-4">
            <table class="table card-table table-vcenter align-middle table-row-dashed gy-5">
                <div class="table-loading-message bg-light text-dark" wire:loading>
                    <i class="fa fa-spinner fa-spin"></i> {{ __('future::messages.loading') }}...
                </div>
                @include('future::components.table-head')
                @include('future::components.table-body')
            </table>
            @include('future::components.table-footer')
        </div>
    </div>
    @if($forms)
        @foreach($forms as $form)
            @livewire($form['form'],['id' => null,'title' => $form['label'],'name' => $form['name']])
        @endforeach
    @endif
    @include('future::table.filter')
</div>

@script
<script>
    Alpine.data('tableData', () => ({
        selectAll: false,
        selectedRows: [],
        data: [],
        length: 0,
        updateSelectAll() {
            this.updateData()
            this.selectAll = !this.selectAll;
            if (this.selectAll) {
                this.selectedRows = this.data.map(item => item);
            } else {
                this.selectedRows = [];
            }

        },
        updateData() {
            var checkboxes = document.querySelectorAll('.checkbox');
            this.data = Array.from(checkboxes).map(checkbox => checkbox.value);
        },
        watchSelectedRows() {
            this.$watch('selectedRows', () => {
                this.selectAll = this.data.length === this.selectedRows.length;
                this.length = this.selectedRows.length;
            });
        },

        init() {
            this.watchSelectedRows();
            this.updateData();
        }
    }));
</script>
@endscript
