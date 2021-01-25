<?php


namespace App\Http\Controllers\CMS\Countries;

use App\DataTables\CountryDataTable;
use App\Http\Controllers\CMS\Controller;
use App\Http\Controllers\CMS\Countries\Requests\CmsCountryStoreRequest;
use App\Services\Countries\CountryService;
use App\Services\Routes\CMS\CMSRoutes;

class CountryController extends Controller
{
    /**
     * @var CountryService
     */
    private $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index(CountryDataTable $dataTable)
    {
        return $dataTable->render('cms.countries.countries-index');
    }

    public function create()
    {
        return view('cms.countries.countries-create');
    }

    public function store(CmsCountryStoreRequest $request)
    {
        $this->countryService->createByArray($request->getFormData());
        return redirect()->route(CMSRoutes::CMS_COUNTRIES_INDEX);
    }
}
