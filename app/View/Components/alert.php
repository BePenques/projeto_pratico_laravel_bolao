<?php

namespace App\View\Components;

use Illuminate\View\Component;

class alert extends Component
{
    public $msg;
    public $status; 
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($msg, $status)
    {
          $this->msg = $msg;
          $this->status  = $status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.alert');
    }
}
