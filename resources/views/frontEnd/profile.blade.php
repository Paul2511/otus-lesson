@extends('frontEnd.layouts.app')

@section('content')
    <div class="container pt-5 pb-5">
        <h2>@lang('profile.header')</h2>
        <div class="row profil_heder">
            <div class="col-md-3 col-sm-4 col-lg-2">
                <div id="files" class="profile_photo center-block files">
                    <img src="{{asset('images/user-male.png')}}" class="img-circle center-block">
                </div>
            </div>
            <div class="col-sm-8 col-md-9 col-lg-10 row">
                <div class="col-sm-12">
                    <div class="col-sm-6">
                        <h2 class="page-title">
                            Alexand Lam
                            <span>/@lang('base.user')/</span>
                        </h2>
                    </div>
                </div>
                <div class="col-6">
                    <ul class="list-unstyled">
                        <li>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
                            </svg>
                            <span>@lang('base.phone'):</span>
                            <span>88878878</span>
                        </li>
                        <li>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
                            </svg>
                            <span>@lang('base.email'):</span>
                            <span>test@admin.admin</span>
                        </li>
                        <li>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calendar3"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z"/>
                                <path fill-rule="evenodd"
                                      d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                            </svg>
                            <i class="ion-ios-calendar-outline"></i>
                            <span>@lang('profile.register_date'):</span>
                            <span>18.04.2020</span>
                        </li>
                    </ul>
                </div>
                <div class="col-6 ">
                    <ul class="list-unstyled">
                        <li>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trophy" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M2.5.5A.5.5 0 0 1 3 0h10a.5.5 0 0 1 .5.5c0 .538-.012 1.05-.034 1.536a3 3 0 1 1-1.133 5.89c-.79 1.865-1.878 2.777-2.833 3.011v2.173l1.425.356c.194.048.377.135.537.255L13.3 15.1a.5.5 0 0 1-.3.9H3a.5.5 0 0 1-.3-.9l1.838-1.379c.16-.12.343-.207.537-.255L6.5 13.11v-2.173c-.955-.234-2.043-1.146-2.833-3.012a3 3 0 1 1-1.132-5.89A33.076 33.076 0 0 1 2.5.5zm.099 2.54a2 2 0 0 0 .72 3.935c-.333-1.05-.588-2.346-.72-3.935zm10.083 3.935a2 2 0 0 0 .72-3.935c-.133 1.59-.388 2.885-.72 3.935zM3.504 1c.007.517.026 1.006.056 1.469.13 2.028.457 3.546.87 4.667C5.294 9.48 6.484 10 7 10a.5.5 0 0 1 .5.5v2.61a1 1 0 0 1-.757.97l-1.426.356a.5.5 0 0 0-.179.085L4.5 15h7l-.638-.479a.501.501 0 0 0-.18-.085l-1.425-.356a1 1 0 0 1-.757-.97V10.5A.5.5 0 0 1 9 10c.516 0 1.706-.52 2.57-2.864.413-1.12.74-2.64.87-4.667.03-.463.049-.952.056-1.469H3.504z"/>
                            </svg>
                            <span>@lang('profile.premium'):</span>
                            <span>@lang('profile.yes')</span>
                        </li>
                        <li>
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-check"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                      d="M8 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10zm4.854-7.85a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                            </svg>
                            <span>@lang('profile.checked'):</span>
                            <span>@lang('profile.yes')</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#settings">@lang('profile.setting')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#chases">@lang('profile.chases')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#subscriptions">@lang('profile.subscriptions')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#notifications">@lang('profile.notifications')</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active mt-2" id="settings">
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li class="p-1">
                                    <span class="text-dark">@lang('profile.first_name'): </span><span> Alexandr</span>
                                    <a href="">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="p-1">
                                    <span class="text-dark">@lang('profile.last_name'): </span><span>Lam</span>
                                    <a href="">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="p-1">
                                    <span class="text-dark">@lang('profile.sex'): </span><span> Mail</span>
                                    <a href="">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled">
                                <li class="p-1">
                                    <span class="text-dark">@lang('profile.birthday'): </span><span>  10.08.1980</span>
                                    <a href="">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="p-1">
                                    <span class="text-dark">@lang('profile.email'): </span><span>test@admin.admin</span>
                                    <a href="">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </a>
                                </li>
                                <li class="p-1">
                                    <span class="text-dark">@lang('profile.password'): </span><span> *** </span>
                                    <a href="">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil"
                                             fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade mt-2" id="chases">
                    <table class="table">
                        <tr>
                            <th>@lang('profile.nr')</th>
                            <th>@lang('profile.name')</th>
                            <th>@lang('profile.idno')</th>
                            <th>@lang('profile.link')</th>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>SRL IONEL</td>
                            <td>1234123221</td>
                            <td><a href="#">@lang('profile.read_more')</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>SRL Venic</td>
                            <td>546123324</td>
                            <td><a href="#">@lang('profile.read_more')</a></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>II Roga i Kopita</td>
                            <td>65846456</td>
                            <td><a href="#">@lang('profile.read_more')</a></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>IS Tutun</td>
                            <td>435457567657</td>
                            <td><a href="#">@lang('profile.read_more')</a></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>SRL Dez</td>
                            <td>9435040084</td>
                            <td><a href="#">@lang('profile.read_more')</a></td>
                        </tr>
                    </table>
                </div>
                <div class="tab-pane fade mt-2" id="subscriptions">
                    @forelse($subscriptions??[] as $subscription)
                        <div class="card">
                            <div class="card-body">
                                <h5>{{$subscription->title}}</h5>
                                <p class="card-text">{!!  $subscription->text !!}</p>
                            </div>
                        </div>
                    @empty
                        <h4 class="text-center">@lang('profile.empty')</h4>
                    @endforelse
                </div>
                <div class="tab-pane fade mt-2" id="notifications">
                    @forelse($notifications??[] as $notification)
                        <div class="card">
                            <div class="card-body">
                                <h5>{{$notification->title}}</h5>
                                <p class="card-text">{!!  $notification->text !!}</p>
                            </div>
                        </div>
                    @empty
                        <h4 class="text-center">@lang('profile.empty')</h4>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
