@if($data)
<tbody id="table-body" class="text-gray-600">
    @foreach($data as $item)
        <tr wire:key="data-{{$item->id}}">
            @if($this->canSelect())
                <td>
                    <div >
                        <label for="check-{{$item->id}}">
                            <input type="checkbox" class="form-check-input checkbox" id="check-{{$item->id}}"
                                   :value="{{$item->id}}"
                                   value="{{$item->id}}"
                                   x-bind:checked="selectAll || selectedRows.includes({{$item->id}})"
                                   x-on:click="
                                if(selectedRows.includes({{$item->id}})) {
                                    selectAll = false;
                                    selectedRows = selectedRows.filter(row => row !== {{$item->id}});
                                } else {
                                    selectedRows.push({{$item->id}});
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
</tbody>
@endif
