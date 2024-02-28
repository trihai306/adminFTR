<?php
namespace Future\Form\Future\Forms\Layouts;

use Future\Form\Future\Forms\Layouts\Tab\TabItem;

class Tab
{
    protected $classes = '';
    protected $attributes = [];
    protected $tabs = [];
    protected $defaultTabClasses = '';

    public static function make()
    {
        $instance = new static;
        return $instance;
    }

    public function classes(string $classes)
    {
        $this->classes = $classes;
        return $this;
    }

    public function addAttribute(string $name, string $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    public function addTab($tab)
    {
        if (!($tab instanceof TabItem)) {
            $tab = TabItem::make()->schema([$tab]);
        }
        $tab->addClasses($this->defaultTabClasses);
        $this->tabs[] = $tab;
        return $this;
    }

    public function schema(array $tabs)
    {
        foreach ($tabs as $tab) {
            $this->addTab($tab);
        }
        return $this;
    }

    public function render()
    {
        $html = '<div class="tab-content '.$this->classes.'"';
        foreach ($this->attributes as $name => $value) {
            $html .= ' '.$name.'="'.$value.'"';
        }
        $html .= '>';
        foreach ($this->tabs as $tab) {
            $html .= $tab->render();
        }
        $html .= '</div>';
        return $html;
    }
}
