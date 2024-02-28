<?php

namespace Future\Table\Future;

use Future\Table\Future\Tables\Actions\Actions;
use Future\Table\Future\Tables\Traits\Can;
use Future\Table\Future\Tables\Traits\ColumnVisibilityTrait;
use Future\Table\Future\Tables\Traits\Exportable;
use Future\Table\Future\Tables\Traits\FilterColumnsTrait;
use Future\Table\Future\Tables\Traits\Functions;
use Future\Table\Future\Tables\Traits\Importable;
use Future\Table\Future\Tables\Traits\PaginationTrait;
use Future\Table\Future\Tables\Traits\SearchTrait;
use Future\Table\Future\Tables\Traits\SelectTrait;
use Future\Table\Future\Tables\Traits\SortTrait;
use Illuminate\Database\Eloquent\Model;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;



abstract class BaseTable extends Component
{
    use WithPagination, FilterColumnsTrait, PaginationTrait, ColumnVisibilityTrait, SortTrait, SearchTrait, SelectTrait;
    use Functions,Can;
    use WithFileUploads;
    protected string $view = 'future::base-table';
    protected array $select = [];
    protected string $model;
    public string $urlCreate = '';
    public $forms = [];

    public function placeholder()
    {
        return view('future::livewire.placeholder');
    }

    public function setModel(string $model) : void
    {
        $this->model = $model;
    }

    abstract protected function columns() : array;

    protected function defineColumns() : array
    {
        $columns = $this->columns();

        foreach ($columns as $column) {
            $column->visible = $this->columnVisibility[$column->name] ?? $column->visible;
        }

        return $columns;
    }

    protected function headerActions() : array
    {
        return [];
    }

    abstract protected function filters() : array;


    protected function defineFilters() : array
    {
        return $this->filters();
    }

    abstract protected function actions(Actions $actions);

    protected function defineActions(Model $data = null)
    {
        return $this->actions(new Actions())->setData($data)->schema()->render();
    }

    protected function getActions()
    {
        return $this->actions(new Actions());
    }

    #[Computed]
    protected function query()  : \Illuminate\Database\Eloquent\Builder
    {
        if (is_null($this->model)) {
            throw new \Exception("Model must be set for the query.");
        }
        if (empty($this->select)) {
            $this->select = ['*'];
        }
        $this->model::select($this->select);
        return $this->model::query();
    }

    protected function affterQuery($query) : \Illuminate\Database\Eloquent\Builder
    {
        return $query;
    }

    #[Computed]
    protected function applyTableQuery()    : \Illuminate\Database\Eloquent\Builder
    {
        $query = $this->query();
        // Implement search logic
        if (!empty(array_filter($this->filters))) {
            $query = $this->applyFilters();
        }
        if ($this->search !== '') {
            $query = $this->applySearch($query);
        }

        // Apply sorting
        if ($this->sortColumn && $this->sortDirection) {
            $query = $query->orderBy($this->sortColumn, $this->sortDirection);
        }
        $query = $this->affterQuery($query);
        return $query;
    }

    public function resetTable() : void
    {
        $this->resetFilters();
        $this->resetPage();
    }

    public function perPage()
    {
        return $this->perPage;
    }

    #[On('refreshTable')]
    public function render()
    {
        $this->forms = $this->actions(new Actions())->forms();
        $actions = $this->getActions();
        $actions = $actions->actions;
        $data = $this->applyTableQuery()->fastPaginate($this->perPage, pageName: 'page')->onEachSide(1);
        return view($this->view, [
            'columns' => $this->defineColumns(),
            'actions' => $actions,
            'headerActions' => $this->headerActions(),
            'Input_filters' => $this->defineFilters(),
            'data' => $data,
        ]);
    }
}
