<?php

namespace Future\Table\Future\Tables\Traits;

use Livewire\Attributes\Url;
use Livewire\Attributes\Session;
/**
 * Trait SearchTrait
 *
 * This trait is used to handle search functionality in Livewire components.
 */
trait SearchTrait {
    /**
     * The search query.
     *
     * @var string
     */
    #[Url(as: 's')]
    public $search = '';
    /**
     * Apply the search query to the given query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function applySearch($query) {
        if ($this->search !== '') {
            $searchColumns = collect($this->defineColumns())
                ->filter->searchable
                ->pluck('name');

            $query->where(function($subQuery) use ($searchColumns) {
                foreach ($searchColumns as $column) {
                    $subQuery->orWhere($column, 'like', '%' . $this->search . '%');
                }
            });

        }


        return $query;
    }
}
