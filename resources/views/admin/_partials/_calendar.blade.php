{{-- Calendar widget starts --}}
<div class="col-xl-6 xl-100">
  <div class="card">
    <div class="cal-date-widget card-body">
      <div class="row">
        <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
          <div class="cal-info text-center">
            <h2>{{ Date::createFromDate(2020, 11, 28)->format('d') }}</h2>
            <div class="d-inline-block mt-2">
              <span class="b-r-dark pr-3">{{ Date::createFromDate(2020, 11, 28)->format('M') }}</span>
              <span class="pl-3">{{ Date::createFromDate(2020, 11, 28)->format('Y') }}</span>
            </div>
            <p class="mt-4 f-16 text-muted">{{ __('messages.pages.dashboard.estimated')}}</p>
          </div>
        </div>
        <div class="col-xl-6 col-xs-12 col-md-6 col-sm-6">
          <div class="cal-datepicker">
            <div class="datepicker-here float-sm-right" data-language="{{app()->getLocale()}}"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{-- Calendar widget ends--}}
