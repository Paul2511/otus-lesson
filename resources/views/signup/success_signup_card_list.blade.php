@extends('privacy')
@section('signup_card')
    @if(isset($each_check_card_info) && $each_check_card_info!=='')
        <div class="site-section  block-14 bg-light nav-direction-white">
            <div class="container">
                <div class="row  mb-3">
                    <div class="col-md-12">
                        <h2 class="site-section-heading text-center">Мои клубные карты</h2>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
