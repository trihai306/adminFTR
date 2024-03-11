<?php

namespace Future\Form\Future;


use Exception;
use Future\Form\Future\Forms\Form;
use Future\Form\Future\Traits\NotificationTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
abstract class ModalForm extends Component
{
    use NotificationTrait;
    protected $form;
    public $title;
    public $name;
    #[Locked]
    public $id;
    public array $data = [];
    protected $model;

    public function mount(string $id = null,string $title=null,string $name=null)
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

        DB::beginTransaction(); // Bắt đầu transaction

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

        $this->dispatch('refreshTable');
    }
    abstract public function form(Form $form);

    protected function notificationOk($message)
    {
        $this->dispatch('swalSuccess', ['message' => $message]);
    }

    protected function notificationError($message)
    {
        $this->dispatch('swalError', ['message' => $message]);
    }
    public function rules()
    {
        if(method_exists($this, 'form')){
            return  $this->form(new Form())->getRules();
        }
        return [];
    }
    public function render()
    {
        $this->form = $this->form(new Form());
        return view('future::modal-form', ['inputs' => $this->form->render()]);
    }

}
