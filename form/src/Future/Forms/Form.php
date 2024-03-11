<?php

namespace Future\Form\Future\Forms;

class Form
{
    protected $inputs = [];
    public $request;
    public $rules = [];
    public function schema(array $inputs)
    {
        $this->inputs = $inputs;
        return $this;
    }


    public function getRules()
    {
       return $this->rules;
    }

    public function setRules($rules)
    {
        $this->rules = $rules;
        return $this;
    }

    public function editRules($rules)
    {
        $currentRouteName = UrlHelper::getUrl();
        if (str_contains($currentRouteName, 'edit')) {
            $this->rules = $rules;
        }
        return $this;
    }

    public function createRules($rules)
    {
        $currentRouteName = UrlHelper::getUrl();
        if (str_contains($currentRouteName, 'create')) {
            $this->rules = $rules;
        }
        return $this;
    }

    public function render()
    {
        return $this->inputs;
    }

}
