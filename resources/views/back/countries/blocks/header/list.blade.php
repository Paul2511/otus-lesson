@component('blocks.header.index')
    @slot('title', __('messages.countries'))
    @slot('description', __('messages.countries_header_description'))
    <a class="whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700"
       href="{{ route(\App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_COUNTRIES_CREATE) }}"
       role="button">@lang('messages.add_country')</a>
@endcomponent
