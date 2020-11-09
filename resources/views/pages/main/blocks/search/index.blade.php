<div class="search-area">
    <div class="search-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    {!! Form::open(['enctype' => 'multipart/form-data', 'class'=>'d-md-flex justify-content-between']) !!}
                        {{Form::select('category',  ['Category1' => 'Category1', 'Category2' => 'Category2'], 'Category2')}}
                        {{Form::select('region',  ['region1' => 'region1', 'region2' => 'region2'], 'region1')}}
                        {{Form::text('text', 'Что ищем')}}
                        {{Form::submit('Найти', ['class' => 'template-btn'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
