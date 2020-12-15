{{-- Orders card starts --}}
<div class="col-xl-6 xl-100">
  <div class="card">
    <div class="card-header">
      <h5>{{ Str::upper(trans_choice('messages.pages.dashboard.orders', 4)) }}</h5>
      <div class="card-header-right">
        <ul class="list-unstyled card-option">
          <li><i class="icofont icofont-simple-left"></i></li>
          <li><i class="icofont icofont-maximize full-card"></i></li>
          <li><i class="icofont icofont-minus minimize-card"></i></li>
          <li><i class="icofont icofont-refresh reload-card"></i></li>
          <li><i class="icofont icofont-error close-card"></i></li>
        </ul>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordernone">
          <thead>
            <tr>
              <th scope="col">{{ Str::upper(__('messages.pages.dashboard.details')) }}</th>
              <th scope="col">{{ Str::upper(__('messages.pages.dashboard.quantity')) }}</th>
              <th scope="col">{{ Str::upper(__('messages.pages.dashboard.status')) }}</th>
            </tr>
          </thead>
          <tbody>
            @for ($i = 0; $i < 4; $i++)
            <tr>
              <td class="fit">{{ __('messages.pages.dashboard.lorem') }}</td>
              <td class="fit digits text-center">1</td>
              <td class="fit font-primary">{{ __('messages.pages.dashboard.pending') }}</td>
            </tr>
            @endfor
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
{{-- Orders card ends --}}
