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
