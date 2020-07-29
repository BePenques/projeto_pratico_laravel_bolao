<?php

namespace App\View\Components;

use Illuminate\View\Component;

class table_component extends Component
{

    public $list = [];
    public $columnList = [];

    public function __construct($list = [],$columnList = [])
    {
      $this->list = $list;
      $this->columnList = $columnList;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table_component');
    }
}
