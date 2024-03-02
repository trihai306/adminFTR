<?php
namespace Future\Future;

use Livewire\Component;

abstract class BaseWidget extends Component
{
    protected static ?string $pollingInterval;
    protected static bool $isLazy = false;
    abstract protected static function getStats():array;

    public function render()
    {
        return view('widget::base-widget', [
            'stats' => static::getStats(),
            'pollingInterval' => static::$pollingInterval,
        ]);
    }
}
