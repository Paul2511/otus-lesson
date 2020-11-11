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
