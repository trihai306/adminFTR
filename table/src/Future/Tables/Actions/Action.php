<?php

namespace Future\Table\Future\Tables\Actions;

use Future\Form\Future\ModalForm;
use Illuminate\Database\Eloquent\Model;
use Livewire\Livewire;

/**
 * Class Action
 *
 * This is a description for the class
 */
class Action
{
    // Properties
    public string $name;
    public string $label;
    public ?string $icon;
    public ?int $id;
    public $data;
    public ?string $link = null;
    public ?string $form = null;
    public ?string $tooltip=null;
    public bool $disabled = false;
    public array $SweetAlert = [];
    public bool $modal = false;
    private array $postSetDataQueue = [];
    public function __construct(string $name, string $label, ?string $icon = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->icon = $icon;
    }

    /**
     * Static constructor
     *
     * @param string $name
     * @param string $label
     * @param string|null $icon
     */
    public static function make(string $name, string $label, ?string $icon = null,?Model $data = null): self
    {
        return new self($name, $label, $icon,$data);
    }


    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function setData(Model $data) {
        $this->data = $data;
        $this->id = $data->id;
        while (!empty($this->postSetDataQueue)) {
            $function = array_shift($this->postSetDataQueue);
            $function($this);
        }
        return $this;
    }


    public function modal(string $title,string $form): self
    {
        $this->form = $form;
        $this->link = null;
        $this->modal = true;
        return $this;
    }



    public function setLivewireMethod(string $livewireMethod, ?string $livewireParameter = null): self
    {
        $this->livewireMethod = $livewireMethod;
        $this->livewireParameter = $livewireParameter;
        return $this;
    }

    /**
     * Dispatch a Livewire event to show a sweet alert
     *
     * @param string $eventName
     * @param array $options
     * @return $this
     */
    public function SweetAlert(string $eventName, array $options = []): self
    {
        $this->SweetAlert = [
            'eventName' => $eventName,
            'options' => $options
        ];
        return $this;
    }

    public function setConfirm(array|callable $options): self
    {
        if ($this->data === null) {
           if (is_callable($options)) {
               $this->postSetDataQueue[] = function($self) use ($options) {
                   $self->setConfirm($options);
               };
               return $this;
            }
        }
        if (is_callable($options)) {
            $options = $options($this->data);
        }

        $this->sweetAlert = [
            'eventName' => 'swalConfirm',
            'options' => $options
        ];

        return $this;
    }

    public function setLabel(string|callable $label): self
    {
        if ($this->data === null) {
            $this->postSetDataQueue[] = function($self) use ($label) {
                $self->setLabel($label);
            };
            return $this;
        }

        if (is_callable($label)) {
            $label = $label();
        }

        $this->label = $label;

        return $this;
    }

    public function setIcon(string|callable $icon): self
    {
        if ($this->data === null) {
            $this->postSetDataQueue[] = function($self) use ($icon) {
                $self->setIcon($icon);
            };
            return $this;
        }

        if (is_callable($icon)) {
            $icon = $icon();
        }

        $this->icon = $icon;

        return $this;
    }

    public function setDisabled(bool|callable $disabled): self
    {
        if (is_callable($disabled)) {
            $disabled = $disabled();
        }

        $this->disabled = $disabled;

        return $this;
    }

    public function setLink(string|callable $link): self
    {
        if ($this->data === null) {
            $this->postSetDataQueue[] = function($self) use ($link) {
                $self->setLink($link);
            };
            return $this;
        }
        if (is_callable($link)) {
            $link = $link($this->data);
        }
        $this->modal = false;
        $this->link = $link;

        return $this;
    }

    public function setTooltip(string|callable $tooltip): self
    {
        if ($this->data === null) {
            $this->postSetDataQueue[] = function($self) use ($tooltip) {
                $self->setTooltip($tooltip);
            };
            return $this;
        }

        if (is_callable($tooltip)) {
            $tooltip = $tooltip();
        }

        $this->tooltip = $tooltip;

        return $this;
    }

    public function setName(string|callable $name): self
    {
        if (is_callable($name)) {
            $name = $name();
        }

        $this->name = $name;

        return $this;
    }
    public function setRender(callable $renderFunction): self
    {
        $renderFunction($this);
        return $this;
    }

    public function render()
    {
        return view('future::base.actions.action', ['action' => $this]);
    }
}
