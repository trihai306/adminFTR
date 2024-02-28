<?php
namespace Future\Table\Future\Tables\Columns;

use Future\Table\Future\Tables\Column;
use Illuminate\Database\Eloquent\Model;

class IconColumn extends Column
{
    public $iconCallback;
    public $colorCallback;
    public $sizeCallback;
    public $tooltipCallback;
    public $classCallback;
    public $ariaHiddenCallback;
    public $roleCallback;

    public static function make(string $name, string $label = null)
    {
        return new static($name, $label);
    }
    public function icon(callable $callback)
    {
        $this->iconCallback = $callback;
        return $this;
    }

    public function color(callable $callback)
    {
        $this->colorCallback = $callback;
        return $this;
    }

    public function size(callable $callback)
    {
        $this->sizeCallback = $callback;
        return $this;
    }

    public function tooltip(callable $callback)
    {
        $this->tooltipCallback = $callback;
        return $this;
    }

    public function class(callable $callback)
    {
        $this->classCallback = $callback;
        return $this;
    }

    public function ariaHidden(callable $callback)
    {
        $this->ariaHiddenCallback = $callback;
        return $this;
    }

    public function role(callable $callback)
    {
        $this->roleCallback = $callback;
        return $this;
    }

    public function render(Model $model)
    {
        $icon = call_user_func($this->iconCallback, $model);
        $color = call_user_func($this->colorCallback, $model);
        $size = $this->sizeCallback ? call_user_func($this->sizeCallback, $model) : '1em';
        $tooltip = $this->tooltipCallback ? call_user_func($this->tooltipCallback, $model) : '';
        $class = $this->classCallback ? call_user_func($this->classCallback, $model) : '';
        $ariaHidden = $this->ariaHiddenCallback ? call_user_func($this->ariaHiddenCallback, $model) : 'true';
        $role = $this->roleCallback ? call_user_func($this->roleCallback, $model) : 'presentation';
        return view('future::base.table.icon', compact('icon', 'color', 'size', 'tooltip', 'class', 'ariaHidden', 'role'));
    }
}
