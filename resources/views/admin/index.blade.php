@extends('admin/layouts/main')

@section('content')
    @php
        $title = 'Главная';
        $breadcrumbs[] = ['url' => '#', 'title' => 'Главная'];
    @endphp
    @include('admin.blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs, $title])

    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$students}}</h3>

                        <p>Студенты</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$teachers}}</h3>

                        <p>Преподаватели</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ribbon-b"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$groups}}</h3>

                        <p>Группы</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-people"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
