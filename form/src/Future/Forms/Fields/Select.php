<?php

namespace Future\Form\Future\Forms\Fields;

use Future\Form\Future\Forms\Field;

class Select extends Field
{
    protected $options = [];
    protected string $label;

    public function options(array $options)
    {
        $this->options = $options;
        return $this;
    }

    public function model(string $modelClass, \Closure $transform)
    {
        $models = $modelClass::all();
        $this->options = $models->mapWithKeys($transform)->toArray();
        return $this;
    }

    public function relation(callable $callback)
    {
        $callback($this);
        return $this;
    }

    public function multiple()
    {
        $this->StyleAttributes['multiple'] = 'multiple';
        return $this;
    }

    public function render()
    {
        return view('future::base.form.select', [
            'isRequired' => $this->isRequired,
            'classes' => $this->classes,
            'attributes' => $this->getAttributes(),
            'options' => $this->options,
            'defaultValue' => $this->defaultValue,
            'label' => $this->label,
            'canHide' => $this->canHide,
            'name' => $this->name,
        ]);
    }
}
