<?php

namespace App\View\Components;

use Illuminate\View\Component;

class paginate_component extends Component
{
    public $list = [];
    public $search = [];

    public function __construct($list = [],$search = [])
    {
      $this->list = $list;
      $this->search = $search;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.paginate_component');
    }
}
