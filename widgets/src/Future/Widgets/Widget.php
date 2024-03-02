<?php
namespace Future\Future\Widgets;

class Widget
{
    public string $title;
    public string $description;
    public string $descriptionIcon;
    public string $col;
    public string $color = "primary";
    public array $extraAttributes = [];
    public function __construct(string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public static function make(string $title, string $description): self
    {
        return new self($title, $description);
    }

    public function title(string $title): void
    {
        $this->title = $title;
    }

    public function description(string $description): void
    {
        $this->description = $description;
    }

    public function descriptionIcon(string $descriptionIcon): void
    {
        $this->descriptionIcon = $descriptionIcon;
    }
    public function color($color):void
    {
         $this->color = $color;
    }

    public function col($col):void
    {
        $this->col = $col;
    }

    public function extraAttributes(array $extraAttributes): void
    {
        $this->extraAttributes = $extraAttributes;
    }
    public function render()
    {
        return view('widget::widget', [
            'title' => $this->title,
            'description' => $this->description,
            'descriptionIcon' => $this->descriptionIcon,
            'color'=>$this->color,
            'extraAttributes' => $this->extraAttributes,
        ]);
    }
}
