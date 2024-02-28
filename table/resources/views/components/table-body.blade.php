<tbody id="table-body" class="text-gray-600">
@if($data)
    @foreach($data as $item)
        <tr wire:key="data-{{$item->id}}">
            @if($this->canSelect())
                <td>
                    <div >
                        <label>
                            <input type="checkbox" class="form-check-input" :value="item.id"
                                   x-bind:checked="selectAll || selectedRows.includes(item.id)"
                                   x-on:click="
                                  if(selectedRows.includes(item.id)) {
                                    selectAll = false;
                                    selectedRows = selectedRows.filter((id) => id !== item.id);
                                } else {
                                    selectedRows.push(item.id);
                                }
                                if(data.length == selectedRows.length) {
                                    selectAll = true;
                                    return;
                                }
                                ">
                        </label>
                    </div>
                </td>
            @endif
            @foreach($this->defineColumns() as $column)
                @if($column->visible)
                    <td>{!! $column->render($item) !!}</td>
                @endif
            @endforeach
            @if($actions)
                @if($this->defineActions($item))
                    <td class="text-end">
                        {{ $this->defineActions($item) }}
                    </td>
                @endif
            @endif
        </tr>
    @endforeach
@endif
</tbody>
