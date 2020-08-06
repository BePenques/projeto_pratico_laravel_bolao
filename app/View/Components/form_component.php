<?php

namespace App\View\Components;

use Illuminate\View\Component;

class form_component extends Component
{
    public $action;
    public $method;

    public function __construct($action,$method)
    {
      $this->action = $action;
      $this->method  = $method;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form_component');
    }
}
