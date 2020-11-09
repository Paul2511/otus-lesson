@extends('layouts.master')
@section('page_title' , 'Регистрация')

@section('page_content')
    <div class="whole-wrap">
        <div class="container">
            <div class="section-top-border">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="mb-30 title_color">Регистрация</h3>
                        @include('auth.register.blocks.form.index')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
