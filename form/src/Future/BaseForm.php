<?php

namespace Future\Form\Future;


use Exception;
use Future\Form\Future\Forms\Form;
use Future\Form\Future\Forms\UrlHelper;
use Future\Form\Future\Traits\NotificationTrait;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Component;

abstract class BaseForm extends Component
{
    use NotificationTrait;
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
        $this->validate();
        DB::beginTransaction();
        try {
            if (method_exists($this, 'beforeSave')) {
                $this->data = $this->beforeSave($this->data);
            }

            if ($this->id) {
                $model = $this->model::find($this->id);
                if ($model) {
                    $model->update($this->data);
                    $this->data = $model->toArray();
                } else {
                    throw new Exception("Record not found.");
                }
            } else {
                $this->model::create($this->data);
            }

            if (method_exists($this, 'afterSave')) {
                $this->afterSave($this->data);
            }

            DB::commit(); // Hoàn thành transaction

            $this->notificationOk('Save success');
        } catch (Exception $e) {
            DB::rollBack(); // Hoàn tác các thay đổi nếu có lỗi
            $this->notificationError($e);
        }

    }
}
