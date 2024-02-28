<?php

namespace Future\Table\Future\Tables\Traits;

/**
 * Trait SelectTrait
 *
 * This trait is used to handle row selection in Livewire components.
 */
trait SelectTrait {
    /**
     * Indicates if all rows are selected.
     *
     * @var bool
     */
    public $selectAll = false;

    /**
     * The selected rows.
     *
     * @var array
     */
    public $selectedRows = [];

    public function SelectedRows($selectedRows,$nameMethod=null,$message = null){
        $this->selectedRows = $selectedRows;
        $this->dispatch('swalConfirm',message: $message, nameMethod: $nameMethod);
    }
}
