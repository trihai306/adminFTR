<?php

namespace Future\Form\Future\Forms\Fields;


use Future\Form\Future\Forms\Field;

class Checkbox extends Field
{
    public function render()
    {
        $required = $this->isRequired ? 'required' : '';
        $classes = !empty($this->classes) ? 'form-check-input ' . $this->classes : 'class="form-check-input"';
        $attributes = $this->getAttributes();
        $checked = $this->defaultValue ? 'checked' : '';
        $name = $this->name;
        $label = $this->label;
        $canHide = $this->canHide;
        return view('future::base.form.checkbox', compact('required', 'classes', 'canHide','attributes', 'checked', 'name', 'label'));
    }
}
