<?php

namespace Future\Table\Future\Tables\Traits;

/**
 * Trait PaginationTrait
 *
 * This trait is used to handle pagination in Livewire components.
 */
trait PaginationTrait
{
    use \Livewire\WithPagination;

    /**
     * The number of items to be displayed per page.
     *
     * @var int
     */
    public $perPage = 10;

    /**
     * The available options for items per page.
     *
     * @var array
     */
    public $pages = [10, 25, 50, 100];
}
