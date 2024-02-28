<?php

namespace Future\Table\Future\Tables\Traits;

/**
 * Trait ColumnVisibilityTrait
 *
 * This trait is used to handle column visibility in Livewire components.
 */
trait ColumnVisibilityTrait {
    /**
     * The visibility of each column.
     *
     * @var array
     */
    public $columnVisibility = [];

    /**
     * Initialize the column visibility.
     *
     * @return void
     */
    public function mount() {
        foreach ($this->defineColumns() as $column) {
            $this->columnVisibility[$column->name] = $column->visible;
        }
    }
}
