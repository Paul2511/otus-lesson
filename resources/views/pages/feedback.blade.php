@extends('layouts.index')

@section('title',__('feedback.feedback'))

@section('content')
    {{ Breadcrumbs::render('feedback') }}
    <div class="container">
        <div class="row">
            <form class="form">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Email</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                </div><div class="form-group">
                    <label for="exampleFormControlInput1">@lang('feedback.name')</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">@lang('feedback.text')</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">@lang('button.send')</button>
            </form>
        </div>
    </div>
@endsection
