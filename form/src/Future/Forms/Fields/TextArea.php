<?php

namespace Future\Form\Future\Forms\Fields;

use Future\Form\Future\Forms\Field;

class TextArea extends Field
{
    protected string $label;

    public function render()
    {
        return view('future::base.form.textarea', [
            'isRequired' => $this->isRequired,
            'classes' => $this->classes,
            'attributes' => $this->getAttributes(),
            'placeholder' => $this->placeholder,
            'label' => $this->label,
            'name' => $this->name,
            'canHide' => $this->canHide,
        ]);
    }
}
