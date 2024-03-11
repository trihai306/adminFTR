<?php

namespace Future\Form\Future;


use Exception;
use Future\Form\Future\Forms\Form;
use Future\Form\Future\Forms\UrlHelper;
use Livewire\Attributes\Locked;
use Livewire\Component;

abstract class BaseForm extends Component
{
    #[Locked]
    public $id;
    public array $data = [];
    protected $form;
    protected $model;
    #[Locked]
    public $url;

    public function mount(string $id = null, string $url = null)
    {
        $this->id = $id;
        $this->url = $url;
        UrlHelper::setUrl($this->url);
        if ($this->id) {
            $this->model = $this->model::find($this->id);
            $this->data = $this->model->toArray();
        }

    }

    public function boot()
    {
        UrlHelper::setUrl($this->url);
    }
    abstract public function form(Form $form);


    public function render()
    {
        $this->form = $this->form(new Form());
        return view('future::base-form', ['inputs' => $this->form->render()]);
    }


    public function rules()
    {
        if(method_exists($this, 'form')){
            return  $this->form(new Form())->getRules();
        }
        return [];
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
            } else {
                $this->model::create($this->data);
            }
            if (!$this->id) {
                $this->data = [];
            }
            if (method_exists($this, 'afterSave')) {
                $this->afterSave($this->data);
            }
            $this->notificationOk('Save success');
        } catch (Exception $e) {
            $this->notificationError($e->getMessage());
        }
        $this->dispatch('refreshTable');
    }

    protected function notificationOk($message)
    {
        $this->dispatch('swalSuccess', ['message' => $message]);
    }

    protected function notificationError($message)
    {
        $this->dispatch('swalError', ['message' => $message]);
    }
}
