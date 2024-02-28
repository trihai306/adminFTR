<?php

namespace Future\Form\Future\Forms\Fields;

use Future\Form\Future\Forms\Field;

class ColorInput extends Field
{
    public function render(): string
    {
        $required = $this->isRequired ? 'required' : '';
        $classes = !empty($this->classes) ? 'form-control '.$this->classes : 'form-control';
        $placeholder = isset($this->placeholder) ? 'placeholder='.$this->placeholder : '';

        return <<<HTML
            <input type="color" name="{$this->name}" wire:model="data.{$this->name}" {$required} class="{$classes}" {$placeholder}>
        HTML;
    }
}
