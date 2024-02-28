<?php
namespace Future\Table\Future\Tables\Headers\Actions;

class Action
{
    private string $name;
    private string $label;
    private ?string $icon;
    private ?string $color;
    private ?string $url;
    private ?bool $modal=false;
    private $form;
    private ?string $title = null;
    private ?bool $can=true;

    public function __construct(string $name, string $label, ?string $icon = null, ?string $color = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->icon = $icon;
        $this->color = $color;
    }

    public static function make(string $name, string $label, ?string $icon = null, ?string $color = null): self
    {
        return new static($name, $label, $icon, $color);
    }

    public function to($url): self
    {
        $this->url = $url;

        return $this;
    }

    public function modal($title, $form=null)
    {
        $this->modal = true;
        $this->url = null;
        $this->title = $title;
        $this->form = $form;
        return $this;
    }

    public function can($can)
    {
        $this->can = $can;
        return $this;
    }

    public function render()
    {
        return view('future::table.actions.action', [
            'name' => $this->name,
            'label' => $this->label,
            'icon' => $this->icon,
            'color' => $this->color,
            'url' => $this->url,
            'modal' => $this->modal,
            'form' => $this->form,
            'can' => $this->can,
            'title' => $this->title,
        ]);
    }
}
