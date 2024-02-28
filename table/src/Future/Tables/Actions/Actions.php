<?php

namespace Future\Table\Future\Tables\Actions;


use Illuminate\Database\Eloquent\Model;

class Actions
{
    /**
     * @var Action[]
     */
    public array $actions = [];
    private string $renderMethod = 'renderAsDropdown';

    public $forms = [];
    public ?Model $data = null;


    public function schema()
    {
        $actions = $this->actions;
        foreach ($actions as $action) {
            $action->setData($this->data);
            if ($action->form) {
                $this->setForm($action->form, $action->name, $action->label);
            }
        }
        return $this;
    }

    public function forms()
    {
        $action = $this->actions;
        foreach ($action as $act) {
            if ($act->form) {
                $this->setForm($act->form, $act->name, $act->label);
            }
        }
        return $this->forms;
    }

    protected function renderAsButtons()
    {
        return view('future::base.buttons', ['actions' => $this->actions, 'data' => $this->data]);
    }

    protected function renderAsDropdown()
    {
        return view('future::base.dropdown', ['actions' => $this->actions, 'data' => $this->data]);
    }

    public function render()
    {
        return $this->{$this->renderMethod}();
    }

    public static function create(array $actions, string $renderMethod = 'renderAsDropdown'): self
    {

        $instance = new static();
        $instance->actions = $actions;
        $instance->renderMethod = $renderMethod;
        return $instance;
    }

    public function setForm($form, $name, $label): void
    {
        $this->forms[] = ['form' => $form, 'name' => $name, 'label' => $label];
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    private function setRenderMethod(string $method = 'renderAsDropdown'): void
    {
        if (method_exists($this, $method)) {
            $this->renderMethod = $method;
        }
    }
}
