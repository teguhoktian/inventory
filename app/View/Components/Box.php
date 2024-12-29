<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Box extends Component
{
    public $type; // Tipe box: success, danger, info, etc.
    
    public $flat;
    
    public $shadow;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type = 'success', $flat = true, $shadow = true)
    {
        $this->type = $type;

        $this->flat = $flat;
        
        $this->shadow = $shadow;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.box');
    }
}
