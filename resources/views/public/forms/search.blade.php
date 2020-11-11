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
