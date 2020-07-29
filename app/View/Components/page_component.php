<?php

namespace App\View\Components;

use Illuminate\View\Component;

class page_component extends Component
{
    public $page;
    public $col;
    public $breadcrumb;


    public function __construct($page,$col,$breadcrumb)
    {
        $this->page = $page;
        $this->col = $col;
        $this->breadcrumb = $breadcrumb;
      
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.page_component');
    }
}
