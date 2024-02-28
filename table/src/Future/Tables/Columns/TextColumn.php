<?php
namespace Future\Table\Future\Tables\Columns;


use Future\Table\Future\Tables\Column;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\HtmlString;

class TextColumn extends Column
{
    public $default;
    public $words;
    public $iconCallback;
    public $descriptionCallback;

    public $copy=false;
    public $tooltip;

    public static function make(string $name,string $label = null,bool $sortable = false)
    {
        return new static($name, $label, $sortable);
    }
    public function default($value)
    {
        $this->default = $value;
        return $this;
    }

    public function description(callable $callback)
    {
        $this->descriptionCallback = $callback;
        return $this;
    }
    public function hideMiddle($start = 3, $end = 3)
    {
        $this->renderCallback = function($model,$value) use ($start, $end) {
            $length = strlen($value);
            if ($length > $start + $end) {
                $startString = substr($value, 0, $start);
                $endString = substr($value, $length - $end, $end);
                return $startString . "*****" . $endString;
            }
            return $value;
        };
        return $this;
    }
    public function badge(array $colorMap, array $labelMap = [])
    {
        $this->renderCallback = function($model,$value) use ($colorMap,$labelMap) {
            $color = $colorMap[$value] ?? 'secondary'; // Mặc định là màu 'secondary' nếu không khớp
            $label = $labelMap[$value] ?? $value; // Mặc định là giá trị nếu không khớp
            return "<span class='badge text-white bg-{$color}'>{$label}</span>";
        };
        return $this;
    }

    public function renderHtml(callable $callback)
    {
        $this->renderCallback = $callback;
        return $this;
    }

    public function copy()
    {
        $this->copy = true;
        return $this;
    }

    public function icon(callable $callback)
    {
        $this->iconCallback = $callback;
        return $this;
    }

    public function fontWeight(string $class)
    {
        $this->fontWeightClass = $class;
        return $this;
    }

    public function words($words = 10)
    {
        $this->words = $words;
        return $this;
    }

    public function tooltip($tooltip = null, $placement = 'top')
    {
        $this->tooltip = [
            'tooltip' => $tooltip,
            'placement' => $placement
        ];
        return $this;
    }

    public function render(Model $model)
    {
        $path = explode('.', $this->name);
        $value = count($path) > 1 ? data_get($model, $this->name) : $model->{$this->name};

        // Xử lý đặc biệt cho collection từ relationship
        if ($value instanceof Collection) {
            $value = $value->pluck('name')->join(', '); // Ví dụ cho role names
        }
        $iconHtml = '';
        $descriptionHtml = '';
        $iconCopy = '';

        if ($this->words) {
            $value = implode(' ', array_slice(explode(' ', $value), 0, $this->words));
        }

        if ($this->iconCallback) {
            $iconHtml = call_user_func($this->iconCallback, $model);
        }
        if ($this->descriptionCallback) {
            $descriptionHtml = call_user_func($this->descriptionCallback, $model);
        }

        if ($this->copy) {
            $iconCopy = new HtmlString("
                <button class='btn btn-sm btn-icon btn-soft-primary btn-copy' data-clipboard-text='{$value}' data-bs-toggle='tooltip' data-bs-placement='top' title='Copy'>
                    <i class='far fa-copy'></i>
                </button>
            ");
        }

        $renderedValue = new HtmlString($this->renderCallback ? call_user_func($this->renderCallback, $model, $value) : $value);
        return view('future::base.table.column', [
            'value' => $renderedValue,
            'iconHtml' => $iconHtml,
            'iconCopy' => $iconCopy,
            'tooltip' => $this->tooltip,
            'fontWeightClass' => $this->fontWeightClass,
            'descriptionHtml' => $descriptionHtml
        ]);
    }
}
