<?php
namespace Future\Table\Future\Tables\Columns;

use Future\Table\Future\Tables\Column;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Storage;

class ImageColumn extends Column
{
    protected int $height=60;
    protected string $disk = 'public';
    protected bool $circular = false;
    protected  $stacked;
    protected string $defaultImageUrl = '';

    public static function make(string $name, string $label = null)
    {
        return new static($name, $label);
    }

    public function height(int $height)
    {
        $this->height = $height;
        return $this;
    }

    public function stacked(callable $callback)
    {
        $this->stacked = $callback;
        return $this;
    }

    public function disk(string $disk)
    {
        $this->disk = $disk;
        return $this;
    }

    public function square(int $size)
    {
        $this->height = $size;
        $this->width = $size;
        return $this;
    }

    public function circular()
    {
        $this->circular = true;
        return $this;
    }

    // Method to set default image URL
    public function defaultImage(string $url)
    {
        $this->defaultImageUrl = $url;
        return $this;
    }

    public function render(Model $model)
    {
        if (!filter_var($model->{$this->name}, FILTER_VALIDATE_URL)) {
            $model->{$this->name} = Storage::disk($this->disk)->url($model->{$this->name});
        }
        $url = $this->renderCallback ? call_user_func($this->renderCallback, $model) : $model->{$this->name};

        $circularClass = $this->circular ? 'rounded-circle' : 'rounded';

        return new HtmlString("<img src='{$url}' class='img-fluid {$circularClass}' style='height: {$this->height}px;width: {$this->width}px' />" );
    }
}
