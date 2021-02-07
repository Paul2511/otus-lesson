<?php


namespace App\View\Components;


use App\Services\Localise\LocaliseService;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;
use Illuminate\View\View;

class LocaleSelect extends Component
{
    const DEFAULT_VIEW = 'components.locale-select';

    private LocaliseService $localiseService;
    private ?string $view;

    public function __construct(LocaliseService $localiseService, ?string $customView = null)
    {
        $this->localiseService = $localiseService;
        $this->view = $customView ?? static::DEFAULT_VIEW;
    }

    public function render(): View
    {
        $route = Route::getCurrentRoute();

        $routes = $route ? $this->localiseService->getLocaleVersionsForRoute($route) : [];

        return view($this->view,[
            'routes' => $routes
        ]);
    }

}
