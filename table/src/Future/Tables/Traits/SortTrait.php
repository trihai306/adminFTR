<?php

namespace Future\Table\Future\Tables\Traits;

/**
 * Trait SortTrait
 *
 * This trait is used to handle column sorting in Livewire components.
 */
trait SortTrait {
    /**
     * The column to sort by.
     *
     * @var string
     */
    public $sortColumn = 'id';

    /**
     * The direction to sort by.
     *
     * @var string
     */
    public $sortDirection = 'desc';

    /**
     * Set the sort column and direction.
     *
     * @param  string  $column
     * @return void
     */
    public function sortBy($column) {
        $columns = collect($this->defineColumns());
        $columnConfig = $columns->firstWhere('name', $column);

        if (!$columnConfig || !$columnConfig->sortable) {
            return;
        }

        $this->sortDirection = $this->sortColumn === $column && $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->sortColumn = $column;
    }
}
