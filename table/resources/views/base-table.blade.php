<div x-data="tableData" @reset-select.window="selectAll = false; selectedRows = [];">
    <div class="container-fluid mb-5">
        <div class="d-flex flex-column flex-md-row justify-content-end ">
            <div  class="btn-group">
                @foreach($headerActions as $headerAction)
                    {{ $headerAction->render()}}
                @endforeach
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="ki-duotone ki-abstract-30 fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </button>
                <div class="dropdown-menu">
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
    <div class="card rounded rounded-5" >
        @include('future::components.table-header')
        <div class="card-body table-responsive table-loading py-4">
            <table class="table align-middle table-row-dashed gy-5">
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
            @livewire($form['form'],[
    'id' => null,
    'title' => $form['label'],
    'name' => $form['name'],
])
        @endforeach
    @endif
    @include('future::table.filter')
</div>

@script
<script>
    Alpine.data('tableData', () => ({
        selectAll: false,
        selectedRows: [],
        data: @json($data->toArray()['data']),
        updateSelectAll() {

            this.selectAll = !this.selectAll;
            if (this.selectAll) {
                this.selectedRows = this.data.map(item => item.id);
            } else {
                this.selectedRows = [];
            }
        },

        watchSelectedRows() {
            this.$watch('data', () => {
                this.selectedRows = [];
                this.selectAll = false;
            });
            this.$watch('selectedRows', () => {
                this.selectAll = this.data.length === this.selectedRows.length;
            });
        },

        init() {
            this.watchSelectedRows();
        }
    }));

</script>
@endscript
