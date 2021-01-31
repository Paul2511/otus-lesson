<div class="bg-white mx-auto my-5 rounded-lg shadow overflow-hidden">
    <div class="m-6">
        {{ Form::open(['url' => route(\App\Services\Routes\Providers\Admin\AdminRoutes::ADMIN_COUNTRIES_UPDATE, $country), 'method' => 'put']) }}
        @include('blocks.forms.errors')
        @include('back.countries.blocks.form.fields', $country)
        <div class="form-group">
            {{ Form::submit(trans('navs.update'),
                array('class' => 'hitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700')) }}
        </div>
        {{ Form::close() }}

    </div>
</div>
