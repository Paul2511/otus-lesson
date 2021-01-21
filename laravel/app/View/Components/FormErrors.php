<?php

namespace App\View\Components;

use Illuminate\Support\ViewErrorBag;
use Illuminate\View\Component;

class FormErrors extends Component
{

    /**
     * @var array|null
     */
    private $errors;

    public function __construct(?ViewErrorBag $errors)
    {
        $this->errors = $errors;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('dashboard.formErrors',[
            'errors' => $this->errors
        ]);
    }
}
