<?php

namespace Future\Core\Http\resource;

use App\Http\Controllers\Controller;
use Future\Form\Future\BaseForm;
use Future\Table\Future\BaseTable;
use Illuminate\Http\Request;


abstract class BaseResource extends Controller
{
    public ?BaseTable $table = null;
    public ?BaseForm $form = null;
    protected $routeName = null;

    public function __construct(
        BaseTable $table = null,
        BaseForm $form = null
    ) {
        $this->table = $table;
        $this->form = $form;
    }

    public function getRouteName()
    {
        return $this->routeName;
    }

    public function index(Request $request)
    {
        $table = $this->table;
        return view('future::resource.index',compact('table'));
    }

    public function create()
    {
        $form = $this->form;
        return view('future::resource.create',compact('form'));
    }

    public function edit($id)
    {
        $form = $this->form;
        return view('future::resource.edit',compact('form','id'));
    }
}
