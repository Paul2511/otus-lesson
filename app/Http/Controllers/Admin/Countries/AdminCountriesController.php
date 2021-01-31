<?php


namespace App\Http\Controllers\Admin\Countries;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Admin\Countries\Requests\StoreCountryRequest;
use App\Http\Controllers\Admin\Countries\Requests\UpdateCountryRequest;
use App\Models\Country;
use App\Services\Countries\CountriesService;
use App\Services\Routes\Providers\Admin\AdminRoutes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use View;

class AdminCountriesController extends AdminBaseController
{

    private CountriesService $countriesService;

    public function __construct(
        CountriesService $countriesService
    )
    {
        $this->countriesService = $countriesService;
    }

    public function index(Request $request)
    {
        $countries = DB::table('countries')->orderByDesc('id')->paginate(self::LIST_PER_PAGE);
        View::share([
            'countries' => ['countries' => $countries],
        ]);
        return view('back.countries.index');
    }

    public function create(Request $request)
    {
        return view('back.countries.create');
    }

    public function show(Country $country)
    {
        View::share([
            'country' => $country
        ]);
        return view('back.countries.show');
    }

    public function store(StoreCountryRequest $request)
    {
        $country = $this->countriesService->createCountry($request->generateCreateCountryDTO());
        return redirect()->route(\App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_COUNTRIES_SHOW, $country);
    }

    public function edit(int $id)
    {
        View::share([
            'country' => Country::findOrFail($id),
        ]);
        return view('back.countries.edit');
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $this->countriesService->updateCountry($country, $request->generateUpdateCountryDTO());

        return redirect()->route(\App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_COUNTRIES_SHOW, $country);
    }
}
