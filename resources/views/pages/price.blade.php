@extends('layouts.index')

@section('title', __('price.prices'))

@section('content')
    {{ Breadcrumbs::render('price') }}
    <div class="container">
        <div class="row ">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">@lang('price.options')</th>
                    <th scope="col">@lang('price.free')</th>
                    <th scope="col">@lang('price.business')</th>
                    <th scope="col">@lang('price.enterprise')</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">@lang('price.сreate your own columns')</th>
                    <td>@lang('price.no')</td>
                    <td>@lang('price.yes')</td>
                    <td>@lang('price.yes')</td>
                </tr>
                <tr>
                    <th scope="row">@lang('price.number of participants')</th>
                    <td>5</td>
                    <td>15</td>
                    <td> >50 </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
