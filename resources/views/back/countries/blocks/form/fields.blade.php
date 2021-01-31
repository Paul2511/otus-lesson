<div class="mt-2">
    <div class="flex flex-col md:flex-row border-b border-gray-200 pb-4 mb-4">
        <div class="w-64 font-bold h-6 mx-2 mt-3 text-gray-800">@lang('messages.add_country')</div>
        <div class="flex-1 flex flex-col md:flex-row">
            <div class="w-full flex-1 mx-2">
                <div class="my-2 p-1 bg-white flex border border-gray-200 rounded">
                    {{ Form::text('name',
                        $country->name ?? null,
                        [
                            'placeholder'=>trans('messages.title'),
                            'class'=>'p-1 px-2 appearance-none outline-none w-full text-gray-800'
                        ]) }}
                </div>
            </div>
            <div class="w-full flex-1 mx-2">
                <div class="my-2 p-1 bg-white flex border border-gray-200 rounded">
                    {{ Form::text('continent_name',
                        $country->continent_name ?? null,
                        [
                            'placeholder'=>trans('messages.continent_name'),
                            'class'=>'p-1 px-2 appearance-none outline-none w-full text-gray-800'
                        ]) }}
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row pb-4 mb-4">
        <div class="w-64 font-bold h-6 mx-2 mt-3 text-gray-800">@lang('messages.additional_info')
        </div>
        <div class="flex-1 flex flex-col mx-2">
            <div class="flex-shrink w-full block relative">
                {{ Form::select('status',
                    [
                        \App\Models\Country::STATUS_INACTIVE=>"Не активно",
                        \App\Models\Country::STATUS_ACTIVE=>"Активно"
                    ],
                    $country->status ?? \App\Models\Country::STATUS_ACTIVE,
                    [
                        'placeholder'=>trans('messages.status'),
                        'class'=>'block appearance-none text-gray-800 w-full bg-white border border-gray-200 shadow-inner px-4 py-2 pr-8 rounded'
                    ]) }}
                <div class="pointer-events-none absolute top-0 mt-3  right-0 flex items-center px-2 text-gray-600">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
            <div class="flex-shrink w-full block mt-4">
                {{ Form::textarea('description',
                    $country->description ?? null,
                    [
                        'placeholder' => trans('messages.description'),
                        'class'=>'py-2 px-4 appearance-none outline-none w-full text-gray-800 border border-gray-200 rounded'
                    ]) }}
            </div>
        </div>
    </div>
</div>
