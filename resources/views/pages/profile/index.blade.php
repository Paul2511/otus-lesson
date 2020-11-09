@extends('layouts.master')
@section('page_title' , 'Мой профиль')

@section('page_content')
    <div class="whole-wrap">
        <div class="container">
            <div class="row">
                @include('pages.profile.blocks.menu.index')

                @include('pages.profile.blocks.adverts.noAdverts')

                @include('pages.profile.blocks.adverts.index')
            </div>
        </div>
    </div>

@endsection
