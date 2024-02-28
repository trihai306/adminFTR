<?php
namespace Future\Table\Future\Widgets\Charts;

use Livewire\Component;

class widget extends Component
{
    protected $icon;
    protected $title;
    protected $data;

    public static function make(string $icon, string $title, array $data): self
    {
        return new self($icon, $title, $data);
    }
    public function render()
    {
        return view('future::widgets.charts.index',[
            'icon' => $this->icon,
            'title' => $this->title,
            'data' => $this->data,
        ]);
    }
}
