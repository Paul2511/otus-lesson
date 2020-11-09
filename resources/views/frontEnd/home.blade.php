@extends('frontEnd.layouts.app')

@section('content')
    <section id="search_form" class="p-5">
        <div class="container">
            <form action="#" method="GET">
                @csrf
                <div class="input-group simple-form-search">
                    <input type="text" name="q" placeholder="{{trans('search.index_input_placeholder')}}"
                           class="form-control main-input"/>
                    <span class="btn-group ">
						<button type="submit" class="btn btn-primary do-search ">
                            <svg class="" width="20" height="20" fill="#ffffff">
                                    <use xlink:href="#search"></use>
                                </svg>
                        </button>
						<a href="#" class="btn btn-dark">
							<span class="rts-non-mobile">{{ trans('search.index_search_avast') }}</span></a>
					</span>
                </div>
            </form>
        </div>
    </section>
    <section>
        <div class="wrapper-section stripe pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2 class="container-header">
                            {{ trans('base.index_how_it_func') }}
                        </h2>
                        <h4 class="container-subheader">
                            {{ trans('base.index_how_it_func_description') }}
                        </h4>
                    </div>
                    <div class="col-sm-4 work-item text-center">
                        <img src="{{asset('images/howwork1.png')}}" alt="..."/>
                        <h5>{{ trans('base.how_it_func_block.first.title')}}</h5>
                        <h6>{{ trans('base.how_it_func_block.first.description')}}</h6>
                    </div>
                    <div class="col-sm-4 work-item text-center">
                        <img src="{{asset('images/howwork2.png')}}" alt="..."/>
                        <h5>{{ trans('base.how_it_func_block.second.title')}}</h5>
                        <h6>{{ trans('base.how_it_func_block.second.description')}}</h6>
                    </div>
                    <div class="col-sm-4 work-item text-center">
                        <img src="{{asset('images/howwork3.png')}}" alt="..."/>
                        <h5>{{ trans('base.how_it_func_block.third.title')}}</h5>
                        <h6>{{ trans('base.how_it_func_block.third.description')}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="last_news">
        @php $list_news = [
            [
                'title' => 'Last update',
                'description' => '15 october 2020 updatee all company',
                'image' => 'images/1.jpg'
            ],
            [
                'title' => 'And new companies',
                'description' => '20 october 2020 add 214 companies',
                'image' => 'images/2.jpg'
            ],
            [
                'title' => 'Add new price',
                'description' => 'Add new price for B2B',
                'image' => 'images/3.jpg'
            ],
        ];
        @endphp
        <div class="container pt-5 pb-5">
            <h2 class="text-center">@lang('base.last_news')</h2>
            <div class="row justify-content-center">
                @foreach($list_news as $news)
                    <div class="card m-1">
                        <div class="thumbnail">
                            <a href="">
                                <img class="card-img-top" src="{{asset($news['image'])}}" alt="">
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{$news['title']}}</h5>
                            <p class="card-text">{!! $news['description'] !!}</p>
                            <a href="#">@lang('base.read_more')</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="countries">
        <div class="container pt-5 pb-5">
            <h2 class="text-center">@lang('base.countries')</h2>
            <div class="row justify-content-center">
                <a title="" class="card p-2 m-2" href="#">
                    <img alt="" src="{{asset('images/registers/be.png')}}">
                </a>
                <a title="" class="card p-2 m-2" href="#">
                    <img alt="" src="{{asset('images/registers/by.png')}}">
                </a>
                <a title="" class="card p-2 m-2" href="#">
                    <img alt="" src="{{asset('images/registers/cy.png')}}">
                </a>
                <a title="" class="card p-2 m-2" href="#">
                    <img alt="" src="{{asset('images/registers/lv.png')}}">
                </a>
                <a title="" class="card p-2 m-2" href="#">
                    <img alt="" src="{{asset('images/registers/md.png')}}">
                </a>
                <a title="" class="card p-2 m-2" href="#">
                    <img alt="" src="{{asset('images/registers/pl.png')}}">
                </a>
                <a title="" class="card p-2 m-2" href="#">
                    <img alt="" src="{{asset('images/registers/ro.png')}}">
                </a>
                <a title="" class="card p-2 m-2" href="#">
                    <img alt="" src="{{asset('images/registers/ua.png')}}">
                </a>
                <a title="" class="card p-2 m-2" href="#">
                    <img alt="" src="{{asset('images/registers/uk.png')}}">
                </a>
            </div>
        </div>
    </section>
@endsection
