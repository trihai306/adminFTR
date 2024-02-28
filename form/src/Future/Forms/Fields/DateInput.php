<?php

namespace Future\Form\Future\Forms\Fields;

use Illuminate\Support\Facades\View;
use Future\Form\Future\Forms\Field;

class DateInput extends Field
{
    protected string $label;
    protected string $format = 'DD/MM/YYYY';
    public function label(string $label): Field
    {
        $this->label = $label;
        return $this;
    }

    public function defaultValue($value): Field
    {
        $this->defaultValue = $value;
        return $this;
    }

    public function format(string $format = 'DD/MM/YYYY'): Field
    {
        $this->format = $format;
        return $this;
    }

    public function render()
    {
        return View::make('future::base.form.dateinput', [
            'name' => $this->name,
            'isRequired' => $this->isRequired,
            'classes' => $this->classes,
            'attributes' => $this->getAttributes(),
            'placeholder' => $this->placeholder,
            'label' => $this->label,
            'canHide' => $this->canHide,
            'format' => $this->format,
        ])->render();
    }
}
