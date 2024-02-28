<?php

namespace Future\Table\Future\Tables\Headers\Actions;
class ResetAction
{
    protected static string $name = 'reset';
    protected static string $label;
    protected static ?string $icon;
    protected static ?string $color;

    public static function make(string $name = null, string $label = null, ?string $icon = null, ?string $color = null)
    {
        self::$label = $label ?? __('future::messages.reset');
        self::$name = $name ?? self::$name;
        self::$icon = $icon;
        self::$color = $color;
        return new static;
    }

    public function render()
    {
        return view('future::table.actions.reset', [
            'name' => self::$name,
            'label' => self::$label,
            'icon' => self::$icon,
            'color' => self::$color,
        ]);
    }
}
