<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppBreadcrumbs extends Component
{
    public $page_name;
    public $category_name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($pageName=null, $categoryName=null)
    {
        $this->page_name = $pageName;
        $this->category_name = $categoryName;
//        dd($this->page_name);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $category = ucfirst($this->category_name);

        $removeUnderscore = str_replace('_', ' ', $this->page_name);

        $removeDash = str_replace('-', ' ', $removeUnderscore);

        $page = ucwords($removeDash);

        if ($this->page_name === 'home') :
            $name_c = trans('navbar.'. $category);
            return  '<li class="breadcrumb-item"><a href="javascript:void(0);">'. $name_c  .'</a></li>';
        elseif ($this->page_name === 'about_us') :
            $name_p = trans('navbar.'. $page);
            return  '<li class="breadcrumb-item"><a href="javascript:void(0);">'. $name_p  .'</a></li>';
        else :
            $name_c = trans('navbar.'. $category);

            $name_p = trans('navbar.'. $page);
            return  '<li class="breadcrumb-item"><a href="javascript:void(0);">'. $name_c .'</a></li>
                <li class="breadcrumb-item active" aria-current="page"><span>' . $name_p .'</span></li>';
        endif;

//        return view('components.app-breadcrumbs');
    }
}
