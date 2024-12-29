<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $id;

    public $size;

    public $headerClass;

    /**
     * Create a new component instance.
     *
     * @param string $id
     * @param string|null $size
     */
     public function __construct($id, $size = null, $headerClass = '')
    {
        $this->id = $id;
        $this->size = $size;
        $this->headerClass = $headerClass;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
