<?php

namespace Future\Table\Future\Tables\Traits;

trait Functions
{
    public function getListeners()
    {
        return array_merge($this->setListeners(), [
            "delete" => 'delete',
            "deletes" => 'deletes',
        ]);
    }

    /**
     * Set the listeners for the component.
     *
     * @return array
     */
    protected function setListeners() : array
    {
        return [];
    }

    protected function resetSelect()
    {
        $this->selectAll = false;
        $this->selectedRows = [];
        $this->dispatch('reset-select');
    }
    public function delete(int $id) : void
    {
        try {
            $this->model::destroy($id);
            $this->dispatch('swalSuccess', [
                'message' => 'Xóa thành công',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('swalError', [
                'message' => 'Xóa thất bại',
            ]);
        }
    }

    public function deletes()
    {
        try {
            $this->model::destroy($this->selectedRows);
            $this->dispatch('swalSuccess', [
                'message' => 'Xóa thành công',
            ]);
            $this->resetSelect();
        } catch (\Exception $e) {
            $this->dispatch('swalError', [
                'message' => 'Xóa thất bại',
            ]);
        }
    }
}
