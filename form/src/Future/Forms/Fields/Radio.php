<?php

namespace Future\Form\Future\Forms\Fields;

use Future\Form\Future\Forms\Field;

class Radio extends Field
{
    protected $options = [];
    protected string $label;

    public function options(array $options)
    {
        $this->options = $options;
        return $this;
    }

    public function label(string $label): Field
    {
        $this->label = $label;
        return $this;
    }

    public function render()
    {
        return view('future::base.form.radio', [
            'isRequired' => $this->isRequired,
            'classes' => $this->classes,
            'attributes' => $this->getAttributes(),
            'options' => $this->options,
            'defaultValue' => $this->defaultValue,
            'name' => $this->name,
            'label' => $this->label,
            'canHide' => $this->canHide,
        ]);
    }
}
