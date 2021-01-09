<?php

namespace App\View\Components;

use Illuminate\View\Component;

class table_site_component extends Component
{

    public $list = [];
    public $columnList = [];
    public $routeName;
    public $tipo;

    public function __construct($list = [],$columnList = [], $routeName, $tipo)
    {
      $this->list = $list;
      $this->columnList = $columnList;
      $this->routeName = $routeName;
      $this->tipo = $tipo;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table_site_component');
    }
}
