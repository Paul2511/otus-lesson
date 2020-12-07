@extends('layouts.app')
@section('styles')
    <link href="{{asset('assets/css/users/user-profile.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components/cards/card.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/animate/animate.css')}}">
    <style>
        .blockui-growl-message {
            display: none;
            text-align: left;
            padding: 15px;
            background-color: #455a64;
            color: #fff;
            border-radius: 3px;
        }
        .blockui-animation-container { display: none; }
        .multiMessageBlockUi {
            display: none;
            background-color: #455a64;
            color: #fff;
            border-radius: 3px;
            padding: 15px 15px 10px 15px;
        }
        .multiMessageBlockUi i { display: block }
    </style>
@endsection
@section('scripts')
    <script src="{{asset('assets/js/users/user-profile.js')}}"></script>
    <script src="{{asset('plugins/blockui/jquery.blockUI.min.js')}}"></script>
    <script src="{{asset('plugins/blockui/custom-blockui.js')}}"></script>
    <script>
        let user_projects = JSON.parse('{{$projects}}');
    </script>

@endsection
@section('content')

            <div class="layout-px-spacing">

                <div class="row layout-spacing">

                    <!-- Content -->
                    <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area">
                                <div class="d-flex justify-content-between">
                                    <h3 class="">@lang('users.Profile')</h3>
                                </div>
                                <div class="text-center user-info">
                                    <img src="{{asset('storage/img/90x90.jpg')}}" alt="avatar" class="rounded-circle">
                                    <p class="">{{$user->full_name}}</p>
                                </div>
                                <div class="user-info-list">

                                    <div class="">
                                        <ul class="contacts-block list-unstyled">
                                            <li class="contacts-block__item">
                                                <a href="mailto:{{$user->email}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>{{$user->email}}</a>
                                            </li>
                                            <li class="contacts-block__item">
                                                <a href="tel:{{$user->phone}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> {{$user->phone}}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

                        <div class="user-profile layout-spacing">
                            <div class="widget-content widget-content-area" id="user_projects">
                                <div class="d-flex justify-content-between">
                                    <h3 class="">@lang('users.Projects')</h3>
                                </div>
                                <div class="blockui-animation-container" id ="blockui-animation-container">
                                   <span class="text-semibold"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-loader spin no-edge-top"><line x1="12" y1="2" x2="12" y2="6"></line><line x1="12" y1="18" x2="12" y2="22"></line><line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line><line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line><line x1="2" y1="12" x2="6" y2="12"></line><line x1="18" y1="12" x2="22" y2="12"></line><line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line><line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line></svg>
                                   </span>
                                </div>
                                    <div id="projects">

                                    </div>

                            </div>
                        </div>
                    </div>

{{--                    <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">--}}

{{--                        <div class="bio layout-spacing ">--}}
{{--                            <div class="widget-content widget-content-area">--}}
{{--                                <h3 class="">@lang('users.Projects')</h3>--}}
{{--                                <div id="projects">--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                    </div>--}}



                </div>
            </div>

@endsection


