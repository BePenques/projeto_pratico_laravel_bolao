<?php

namespace App\View\Components;

use Illuminate\View\Component;

class search_component extends Component
{
    public $search;
    public $titleAdd;
    public $routeName;

    public function __construct($search,$titleAdd,$routeName)
    {
      $this->search = $search;
      $this->titleAdd = $titleAdd;
      $this->routeName = $routeName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.search_component');
    }
}
