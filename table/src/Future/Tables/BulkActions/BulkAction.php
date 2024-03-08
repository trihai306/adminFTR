<?php
namespace Future\Table\Future\Tables\BulkActions;

class BulkAction
{
    public string $name;
    public string $title;
    public ?string $icon;
    public string $method;
    public string $question;

    public function __construct(string $name, string $title, ?string $icon, string $method, string $question)
    {
        $this->name = $name;
        $this->title = $title;
        $this->icon = $icon;
        $this->method = $method;
        $this->question = $question;
    }

    public static function make(string $name, string $title, ?string $icon, string $method, string $question): self
    {
        return new self($name, $title, $icon, $method, $question);
    }
}
