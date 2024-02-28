<?php
namespace Future\Form\Future\Forms\Layouts;

class Card{
    protected $title;
    protected $fields = [];
    protected $classes = '';
    protected $headerClasses = '';
    protected $bodyClasses = '';
    protected $footer;
    protected $attributes = [];

    public static function make(string $title=null)
    {
        $instance = new static;
        $instance->title = $title;
        return $instance;
    }

    public function classes(string $classes)
    {
        $this->classes = $classes;
        return $this;
    }

    public function headerClasses(string $classes)
    {
        $this->headerClasses = $classes;
        return $this;
    }

    public function bodyClasses(string $classes)
    {
        $this->bodyClasses = $classes;
        return $this;
    }

    public function footer(string $footer)
    {
        $this->footer = $footer;
        return $this;
    }

    public function addField($field)
    {
        $this->fields[] = $field;
        return $this;
    }

    public function addAttribute(string $name, string $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    public function schema(array $rows)
    {
        foreach ($rows as $row) {
            $this->addField($row);
        }
        return $this;
    }

    public function render()
    {
        return view('future::layouts.card', [
            'title' => $this->title,
            'fields' => $this->fields,
            'classes' => $this->classes,
            'headerClasses' => $this->headerClasses,
            'bodyClasses' => $this->bodyClasses,
            'footer' => $this->footer,
            'attributes' => $this->attributes,
        ])->render();
    }

}
