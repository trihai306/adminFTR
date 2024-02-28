<?php
namespace Future\Table\Future\Tables\Traits;

trait Can
{
    public bool $canCreate = true;
    public bool $canSelect = true;
    public function canSelect()
    {
        return $this->canSelect;
    }
    public function canCreate()
    {
        return $this->canCreate;
    }
}
