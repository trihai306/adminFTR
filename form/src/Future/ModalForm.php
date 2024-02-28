<?php

namespace Future\Form\Future;


use Exception;
use Future\Form\Future\Forms\Form;
use Livewire\Attributes\On;

abstract class ModalForm extends BaseForm
{
    protected $form;
    public $title;
    public $name;


    public function mount(string $id = null,$title=null,$name=null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->name = $name;
        if ($this->id) {
            $this->model = $this->model::find($this->id);
            $this->data = $this->model->toArray();
        }
    }
    #[On('setModel')]
    public function setData($id)
    {
        $this->id = $id;
        if ($this->id) {
            $this->model = $this->model::find($this->id);
            $this->data = $this->model->toArray();
        }
        else{
            $this->data = [];
        }
    }

    public function save()
    {
        if (method_exists($this, 'rules')) {
            $this->validate();
        }
        try {
            if (method_exists($this, 'beforeSave')) {
                $this->data = $this->beforeSave($this->data);
            }
            if ($this->id) {
                $model = $this->model::updateOrCreate(['id' => $this->id], $this->data);
                $this->data = $model->toArray();
                $this->id = null;
            } else {
                $this->model::create($this->data);
                $this->data = [];
            }
            if (method_exists($this, 'afterSave')) {
                $this->afterSave($this->data);
            }
            $this->notificationOk('Save success');
        } catch (Exception $e) {
            $this->notificationError($e);
        }
        $this->dispatch('refreshTable');
    }


    public function render()
    {
        $this->form = $this->form(new Form());
        return view('future::modal-form', ['inputs' => $this->form->render()]);
    }

}
