<thead>
<tr class="text-start text-muted fw-bold gs-0">
    @if($this->canSelect())
        <th>
            <div>
                <label>
                    <input type="checkbox" class="form-check-input" x-model="selectAll" x-on:click="updateSelectAll">
                </label>
            </div>
        </th>
    @endif
    @foreach($this->defineColumns() as $column)
        @if($column->visible)
            <th style="
           @if($column->width)
                width: {{ $column->width }};
                @endif
             text-align: {{ $column->textAlign ?? 'left' }};"
                wire:click="sortBy('{{ $column->name }}')" style="cursor: pointer;">
                {{ $column->label }}
                @if($column->sortable)
                    @if($sortColumn == $column->name)
                        {!! $sortDirection == 'asc' ? '&#9650;' : '&#9660;' !!}
                    @endif
                @endif
            </th>
        @endif
    @endforeach
    @if($actions)
        <th class="text-end min-w-100px">
            {{ __('future::messages.actions') }}
        </th>
    @endif
</tr>
</thead>
