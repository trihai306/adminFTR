<?php

namespace Future\Table\Future\Tables;

use Illuminate\Support\HtmlString;

class FilterInput
{
    protected $name;
    protected $label;
    protected $type;
    protected $options;

    public function __construct(string $name, string $type = 'text', array $options = [])
    {
        $this->name = $name;
        $this->type = $type;
        $this->options = $options;
    }

    public static function make(string $name, string $type = 'text', array $options = [])
    {
        return new static($name, $type, $options);
    }

    public function render()
    {
        switch ($this->type) {
            case 'text':
                return $this->renderTextInput();
            case 'select':
                return $this->renderSelectInput();
            case 'checkbox':
                return $this->renderCheckboxInput();
            case 'radio':
                return $this->renderRadioInput();
            case 'date':
                return $this->renderDateInput();
            case 'number':
                return $this->renderNumberInput();
            case 'email':
                return $this->renderEmailInput();
            default:
                throw new \Exception("Unsupported input type: {$this->type}");
        }
    }

    protected function renderTextInput()
    {
        return new HtmlString("<label class='form-label'>{$this->name}</label> <input type='text' class='form-control' wire:model='filters.{$this->name}' />");
    }

    protected function renderSelectInput()
    {
        $optionsHtml = '';
        foreach ($this->options as $value => $label) {
            $optionsHtml .= "<option value='{$value}'>{$label}</option>";
        }

        return new HtmlString("
            <label class='form-label fw-semibold'>{$this->name}</label>
            <select class='form-select' wire:model='filters.{$this->name}'>
                {$optionsHtml}
            </select>
        ");
    }

    protected function renderCheckboxInput()
    {
        return new HtmlString("<label class='form-label fw-semibold'>{$this->name}</label><input type='checkbox' class='form-check-input' wire:model='filters.{$this->name}' />");
    }

    protected function renderRadioInput()
    {
        $optionsHtml = '';
        foreach ($this->options as $value => $label) {
            $optionsHtml .= "<div class='form-check'><input class='form-check-input' type='radio' value='{$value}' wire:model='filters.{$this->name}' /><label class='form-check-label'>{$label}</label></div>";
        }

        return new HtmlString("<label class='form-label fw-semibold'>{$this->name}</label>" . $optionsHtml);
    }

    protected function renderDateInput()
    {
        return new HtmlString("<label class='form-label fw-semibold'>{$this->name}</label><input type='date' class='form-control' wire:model='filters.{$this->name}' />");
    }

    protected function renderNumberInput()
    {
        return new HtmlString("<label class='form-label fw-semibold'>{$this->name}</label><input type='number' class='form-control' wire:model='filters.{$this->name}' />");
    }

    protected function renderEmailInput()
    {
        return new HtmlString("<label class='form-label fw-semibold'>{$this->name}</label><input type='email' class='form-control' wire:model='filters.{$this->name}' />");
    }
}
