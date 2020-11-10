<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppTitle extends Component
{
    public $title;
    public $page_name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pageName=null)
    {
        $this->page_name = $pageName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $admin_name = '| SMARTER';

        if ($this->page_name === 'home') :
            echo  trans('navbar.Dashboard');
        elseif ($this->page_name === 'auth_default') :
            echo  trans('navbar.Login');
        else :
            echo  trans('navbar.'. ucfirst($this->page_name)) . $admin_name;
        endif;
    }
}
