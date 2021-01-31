<div class="flex flex-col sm:flex-row my-10">

    <div class="sm:w-1/4 p-2">
        <div class="bg-white px-6 py-8 rounded-lg shadow-lg text-center">

            <h1 class="text-2xl font-bold text-gray-700">@lang('messages.countries')</h1>
            <p class="text-sm font-base text-gray-500">@lang('messages.countries_header_description')</p>
            <div class="my-5">
                <a class="whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
                   href="{{ route(\App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_COUNTRIES_INDEX) }}"
                   role="button">@lang('messages.countries')</a>
                <br>
                <a class="text-blue-700 focus:text-gray-700 inline-block mt-2"
                   href="{{ route(\App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_COUNTRIES_CREATE) }}">
                    @lang('messages.add_country')
                </a>
            </div>

        </div>
    </div>

    <div class="sm:w-1/4 p-2">
        <div class="bg-white px-6 py-8 rounded-lg shadow-lg text-center">

            <h1 class="text-2xl font-bold text-gray-700">@lang('messages.cities')</h1>
            <p class="text-sm font-base text-gray-500">@lang('messages.cities_header_description')</p>
            <div class="my-5">
                <a class="whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
                   href="{{ route(\App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_COUNTRIES_INDEX) }}"
                   role="button">@lang('messages.cities')</a>
            </div>

        </div>
    </div>

</div>
