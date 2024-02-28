<?php

namespace Future\Form\Future\Forms;

class Field
{
    protected string $name;
    protected bool $isRequired = false;
    protected string $classes = '';
    protected array $StyleAttributes = [];
    protected array $rules = [];
    protected mixed $defaultValue = null;
    protected string $label = '';
    protected string $helpText = '';
    protected bool $canHide = false;
    protected array $col = [];
    protected string $placeholder = '';

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function make($name): self
    {
        return new static($name);
    }


    public function required(): self
    {
        $this->isRequired = true;
        return $this;
    }

    public function classes(string $classes): self
    {
        $this->classes = $classes;
        return $this;
    }

    public function addAttribute(string $name, string $value): self
    {
        $this->StyleAttributes[$name] = $value;
        return $this;
    }

    public function addRules(array $rules): self
    {
        $this->rules = array_merge($this->rules, $rules);
        return $this;
    }

    public function defaultValue(mixed $value): self
    {
        $this->defaultValue = $value;
        return $this;
    }

    public function label(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function helpText(string $helpText): self
    {
        $this->helpText = $helpText;
        return $this;
    }

    public function getAttributes(): string
    {
        $StyleAttributes = '';
        foreach ($this->StyleAttributes as $name => $value) {
            $StyleAttributes .= " {$name}=\"{$value}\"";
        }
        return $StyleAttributes;
    }

    public function hide(callable $callback): self
    {
        if ($callback()) {
            $this->canHide = true;
        }
        return $this;
    }

    public function canStore($hide = false): self
    {
        $currentRouteName = request()->route()->getName();
        if (str_contains($currentRouteName, 'edit')) {
            $this->canHide = $hide;
        }
        return $this;
    }

    public function canCreate($hide = false): self
    {
        $currentRouteName = request()->route()->getName();
        if (str_contains($currentRouteName, 'edit')) {
            $this->canHide = $hide;
        }
        return $this;
    }

    public function getRules(): array
    {
        return $this->rules;
    }

    public function getDefaultValue(): mixed
    {
        return $this->defaultValue;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getHelpText(): string
    {
        return $this->helpText;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function placeholder(string $placeholder) : self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function live()
    {
        return $this;
    }
}
