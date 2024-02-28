<?php

namespace Future\Form\Future\Forms\Fields;

use Future\Form\Future\Forms\Field;

class SelectGroup extends Field
{
    protected array $options = [];

    public function options(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    public function render(): string
    {
        $required = $this->isRequired ? 'required' : '';
        $classes = !empty($this->classes) ? 'form-control '.$this->classes : 'form-control';

        return view('future::base.form.select_group', [
            'name' => $this->name,
            'required' => $required,
            'classes' => $classes,
            'canHide' => $this->canHide,
            'options' => $this->options,
            'defaultValue' => $this->defaultValue,
        ])->render();
    }

    protected function renderOptions(): string
    {
        $html = '';
        foreach ($this->options as $value => $label) {
            $selected = $value == $this->defaultValue ? 'selected' : '';
            $html .= "<option value=\"{$value}\" {$selected}>{$label}</option>";
        }
        return $html;
    }
}
