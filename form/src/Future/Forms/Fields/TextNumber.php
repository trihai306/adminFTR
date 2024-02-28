<?php

namespace Future\Core\Livewire\Forms\Fields;

use Future\Form\Future\Forms\Field;

class TextNumber extends Field
{
    protected $min = null;
    protected $max = null;
    protected $step = null;

    public function min(int $min)
    {
        $this->min = $min;
        return $this;
    }

    public function max(int $max)
    {
        $this->max = $max;
        return $this;
    }

    public function step(int $step)
    {
        $this->step = $step;
        return $this;
    }

    public function render()
    {
        return view('future::base.form.textnumber', [
            'isRequired' => $this->isRequired,
            'classes' => $this->classes,
            'attributes' => $this->getAttributes(),
            'min' => $this->min,
            'max' => $this->max,
            'step' => $this->step,
            'placeholder' => $this->placeholder,
            'label' => $this->label,
            'name' => $this->name,
            'canHide' => $this->canHide,
        ]);
    }
}
