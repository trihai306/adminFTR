<?php
namespace Future\Table\Future\Tables;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

class Column
{
    public string $name;
    public string $label;
    public bool $sortable;
    public bool $searchable;
    public bool $visible;
    public string $fontWeightClass = '';
    public $renderCallback;
    public ?string $width = null;
    public ?string $textAlign;


    public function __construct(string $name, string $label = null, bool $sortable = false,  bool $searchable = false, bool $visible = true, callable $renderCallback = null)
    {
        $this->name = $name;
        $this->label = $label ?? $name;
        $this->sortable = $sortable;
        $this->searchable = $searchable;
        $this->visible = $visible;
        $this->renderCallback = $renderCallback;
    }



    public function sortable()
    {
        $this->sortable = true;
        return $this;
    }

    public function searchable()
    {
        $this->searchable = true;
        return $this;
    }

    public function hide()
    {
        $this->visible = false;
        return $this;
    }

    public function renderLink(callable $urlCallback)
    {
        $this->renderCallback = function($model) use ($urlCallback) {
            $url = call_user_func($urlCallback, $model);
            return new HtmlString("<a href='{$url}'>{$model->{$this->name}}</a>");
        };
        return $this;
    }

    public function dateTime($format = 'Y-m-d H:i:s')
    {
        $this->renderCallback = function($model,$value) use ($format) {
            return (new \DateTime($value))->format($format);
        };
        return $this;
    }

    public function since()
    {
        $this->renderCallback = function($model,$value) {
            $date = new \DateTime($value);
            $now = new \DateTime();
            $interval = $now->diff($date);
            return $interval->format('%y years, %m months, %d days');
        };
        return $this;
    }

    public function numeric($decimalPlaces = 0, $decimalSeparator = '.', $thousandsSeparator = ',')
    {
        $this->renderCallback = function($value) use ($decimalPlaces, $decimalSeparator, $thousandsSeparator) {
            return number_format($value, $decimalPlaces, $decimalSeparator, $thousandsSeparator);
        };
        return $this;
    }

    public function money($currencySymbol)
    {
        $this->renderCallback = function($value) use ($currencySymbol) {
            return $currencySymbol . ' ' . number_format($value, 2);
        };
        return $this;
    }



    public function width($width='100px')
    {
        $this->width = $width;
        return $this;
    }

    public function textAlign($textAlign = 'left')
    {
        $this->textAlign = $textAlign;
        return $this;
    }

}
