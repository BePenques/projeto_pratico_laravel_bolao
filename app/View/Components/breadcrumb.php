<?php

namespace App\View\Components;

use Illuminate\View\Component;

class breadcrumb extends Component
{
    public $page;
    public $breadcrumb = [];

    public function __construct($page,$breadcrumb = [])
    {
        $this->page = $page;
        $this->breadcrumb = $breadcrumb;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
