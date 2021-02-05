<?php

namespace App\Http\Middleware;

use App\Models\Pet;
use App\Models\PetType;
use App\Models\User;
use App\Services\Localise\Locale;
use App\Services\PetTypes\PetTypeService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\App;
use App\Services\Files\Helpers\SrcHelper;
class WebApplicationData
{
    /**
     * Посредник формирует массив с необходимыми данными для web части приложения
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        $data = [
            'locale' => App::currentLocale(),
            'locales' => Locale::$availableLocales,
            'defaultAvatar' => SrcHelper::getUserDefaultAvatar(),
        ];

        $userStatuses = [];
        User::getStatesFor('status')->each(function (string $status) use (&$userStatuses) {
            $userStatuses[$status] = trans('user.status.'.$status);
        });
        $data['userStatuses'] = $userStatuses;

        $petTypes = $this->getPetTypeService()->getAll();
        $data['petTypes'] = $petTypes;

        $petSexes = [];
        Pet::getStatesFor('sex')->each(function (string $sex) use (&$petSexes) {
            $petSexes[$sex] = trans('pet.sex.'.$sex);
        });
        $data['petSexes'] = $petSexes;

        View::share('data', $data);

        return $next($request);
    }

    private function getPetTypeService(): PetTypeService
    {
        return app(PetTypeService::class);
    }
}
