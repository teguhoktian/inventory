<?php

namespace App\View\Components;

use Illuminate\View\Component;

class UserPanelSidebar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public string $userAvatar,
        public string $userName,
        public string $userEmail,
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-panel-sidebar');
    }
}
