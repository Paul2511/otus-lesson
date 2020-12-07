@extends('main/layout/main')

@section('title')Профиль пользователя@endsection

@section('content')
    <main class="profile-section">
        <div class="container">
            <section>
                <div class="row mt-5">
                    <div class="col-lg-4 col-md-12">
                        <section class="card profile-card mb-4 text-center">
                            <div class="avatar z-depth-1-half">
                                <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(8).jpg" alt="" class="img-fluid">
                            </div>

                            <div class="card-body">
                                <h4 class="card-title"><strong>John Doe</strong></h4>

                                <h5>Backend-разработчик</h5>

                                <p class="dark-grey-text">Россия, Москва</p>

                                <p class="card-text mt-3"></p>
                            </div>
                        </section>

                        <section class="card mb-4">
                            <div class="card-body text-center">

                                <h5><strong>Навыки</strong></h5>

                                <hr class="my-3">

                                <button type="button" class="btn primary-color-dark text-white btn-sm">PHP</button>
                                <button type="button" class="btn warning-color-dark text-white btn-sm">Python</button>
                                <button type="button" class="btn amber text-white btn-sm">Yii2</button>
                                <button type="button" class="btn green darken-4 text-white btn-sm">Flask</button>
                                <button type="button" class="btn teal darken-4 text-white btn-sm">Django</button>
                                <button type="button" class="btn light-blue accent-4 text-white btn-sm">MySQL</button>
                            </div>
                        </section>
                    </div>

                    <div class="col-lg-8 col-md-12 text-center">
                        <div class="text-center mt-3 mb-5">
                            <h4><strong>Группы</strong></h4>
                        </div>

                        <div class="card-deck">
                            <div class="card card-cascade narrower card-ecommerce mb-5">
                                <div class="view view-cascade overlay">
                                    <img src="https://mdbootstrap.com/img/Mockups/Horizontal/6-col/pro-profile-page.jpg" class="img-fluid"
                                         alt="">
                                    <a href="#">
                                        <div class="mask"></div>
                                    </a>
                                </div>

                                <div class="card-body card-body-cascade">
                                    <h4 class="card-title">Группа 101</h4>

                                    <p class="card-text">PHP </p>
                                </div>

                                <div class="card-footer links-light">
                                    <span class="float-left pt-2">
                                        <a><i class="fas fa-users mr-2"></i></a>
                                        <a><i class="fas fa-heart-o mr-2"></i>10</a>
                                    </span>
                                    <span class="float-right">
                                        <a href="" class="waves-effect p-2">Посмотреть</a>
                                    </span>
                                </div>
                            </div>

                            <div class="card card-cascade narrower card-ecommerce d-flex mb-5">
                                <div class="view view-cascade overlay">
                                    <img src="https://mdbootstrap.com/img/Mockups/Horizontal/6-col/pro-profile-page.jpg" class="img-fluid"
                                         alt="">
                                    <a href="#">
                                        <div class="mask"></div>
                                    </a>
                                </div>

                                <div class="card-body card-body-cascade">
                                    <h4 class="card-title">Группа 102</h4>

                                    <p class="card-text">Python</p>
                                </div>

                                <div class="card-footer links-light">
                                    <span class="float-left pt-2">
                                        <a><i class="fas fa-users mr-2"></i></a>
                                        <a><i class="fas fa-heart-o mr-2"></i>7</a>
                                    </span>
                                    <span class="float-right">
                                        <a href="" class="waves-effect p-2">Посмотреть</a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card-deck">
                            <div class="card card-cascade narrower card-ecommerce mb-5">
                                <div class="view view-cascade overlay">
                                    <img src="https://mdbootstrap.com/img/Mockups/Horizontal/6-col/pro-profile-page.jpg" class="img-fluid"
                                         alt="">
                                    <a href="#">
                                        <div class="mask"></div>
                                    </a>
                                </div>

                                <div class="card-body card-body-cascade">
                                    <h4 class="card-title">Группа 103</h4>

                                    <p class="card-text">Laravel</p>
                                </div>

                                <div class="card-footer links-light">
                                    <span class="float-left pt-2">
                                        <a><i class="fas fa-users mr-2"></i></a>
                                        <a><i class="fas fa-heart-o mr-2"></i>10</a>
                                    </span>
                                    <span class="float-right">
                                        <a href="" class="waves-effect p-2">Посмотреть</a>
                                    </span>
                                </div>
                            </div>

                            <div class="card card-cascade narrower card-ecommerce d-flex mb-5">
                                <div class="view view-cascade overlay">
                                    <img src="https://mdbootstrap.com/img/Mockups/Horizontal/6-col/pro-profile-page.jpg" class="img-fluid"
                                         alt="">
                                    <a href="#">
                                        <div class="mask"></div>
                                    </a>
                                </div>

                                <div class="card-body card-body-cascade">
                                    <h4 class="card-title">Группа 104</h4>

                                    <p class="card-text">Django</p>
                                </div>

                                <div class="card-footer links-light">
                                    <span class="float-left pt-2">
                                        <a><i class="fas fa-users mr-2"></i></a>
                                        <a><i class="fas fa-heart-o mr-2"></i>7</a>
                                    </span>
                                    <span class="float-right">
                                        <a href="" class="waves-effect p-2">Посмотреть</a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <nav class="my-4 d-flex justify-content-center">
                            <ul class="pagination pagination-circle pg-blue mb-0">
                                <li class="page-item disabled clearfix d-none d-md-block"><a class="page-link">First</a></li>

                                <li class="page-item disabled">
                                    <a class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>

                                <li class="page-item active"><a class="page-link">1</a></li>
                                <li class="page-item"><a class="page-link">2</a></li>
                                <li class="page-item"><a class="page-link">3</a></li>
                                <li class="page-item"><a class="page-link">4</a></li>
                                <li class="page-item"><a class="page-link">5</a></li>

                                <li class="page-item">
                                    <a class="page-link" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>

                                <li class="page-item clearfix d-none d-md-block"><a class="page-link">Last</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
