@extends('cms.layouts.cms-app')

@section('content')
    @include('cms.menus.menu-breadcrumb')
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">
                        @lang('cms-general.countries')
                    </h6>
                    {{$dataTable->table()}}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {!! $dataTable->scripts() !!}
@endsection
