@extends('main/layout/main')

@section('title')О нас@endsection

@section('content')
    <main style="margin-top: 120px;">
        <div class="container">
            <section>
                <h3 class="h3 text-center mb-5">О сервисе</h3>

                <div class="row wow fadeIn">
                    <div class="col-lg-12 px-4 text-center">
                        <i class="fas fa-code fa-2x indigo-text"></i>

                        <h5 class="feature-title">Сервис обеспечивает механизм подбора преподавателей.</h5>

                        <p class="grey-text"> Имеется спектр навыков, совокупность студентов, и совокупность преподавателей.
                            <br> У каждого студента есть набор навыков, которые он хочет освоить,<br> у каждого преподавателя набор навыков, которыми он владеет.</p>
                    </div>
                </div>
            </section>

            <hr class="my-5">

            <section>
                <h2 class="my-5 h3 text-center">Задачи</h2>

                <div class="row features-small mb-5 mt-3 wow fadeIn">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-2">
                                <i class="fas fa-check-circle fa-2x indigo-text"></i>
                            </div>
                            <div class="col-10">
                                <p class="grey-text">Организация студентов в группы по заданным ограничениям</p>
                                <div style="height:15px"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <i class="fas fa-check-circle fa-2x indigo-text"></i>
                            </div>
                            <div class="col-10">
                                <p class="grey-text">Для каждой группы подбор преподавателей по заданным ограничениям</p>
                                <div style="height:15px"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 flex-center">
                        <img src="https://mdbootstrap.com/img/Others/screens.png" alt="MDB Magazine Template displayed on iPhone" class="z-depth-0 img-fluid">
                    </div>

                    <div class="col-md-4 mt-2">
                        <!--First row-->
                        <div class="row">
                            <div class="col-2">
                                <i class="fas fa-check-circle fa-2x indigo-text"></i>
                            </div>
                            <div class="col-10">
                                <p class="grey-text">Подбор для нового студента максимально подходящей ему группы</p>
                                <div style="height:15px"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-2">
                                <i class="fas fa-check-circle fa-2x indigo-text"></i>
                            </div>
                            <div class="col-10">
                                <p class="grey-text">Поиск замены преподавателя из «свободных» преподавателей</p>
                                <div style="height:15px"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <hr class="mb-5">

            <section>

                <h2 class="my-5 h3 text-center">Технологии</h2>

                <div class="row features-small mt-5 wow fadeIn">
                    <div class="col-xl-3 col-lg-6">
                        <div class="row">
                            <div class="col-2">
                                <i class="fab fa-firefox fa-2x mb-1 indigo-text" aria-hidden="true"></i>
                            </div>
                            <div class="col-10 mb-2 pl-3">
                                <h5 class="feature-title font-bold mb-1">Кроссбраузерная совместимость</h5>
                                <p class="grey-text mt-2">Chrome, Firefox, IE, Safari, Opera, Microsoft Edge</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="row">
                            <div class="col-2">
                                <i class="fab fa-laravel fa-2x mb-1 indigo-text" aria-hidden="true"></i>
                            </div>
                            <div class="col-10 mb-2">
                                <h5 class="feature-title font-bold mb-1">Laravel</h5>
                                <p class="grey-text mt-2">Бесплатный веб-фреймворк с открытым кодом, предназначенный для разработки с использованием архитектурной модели MVC.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="row">
                            <div class="col-2">
                                <i class="fab fa-docker fa-2x mb-1 indigo-text" aria-hidden="true"></i>
                            </div>
                            <div class="col-10 mb-2">
                                <h5 class="feature-title font-bold mb-1">Laradock</h5>
                                <p class="grey-text mt-2">Готовая сборка образов Docker для разаработки php-приложений на Laravel.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-6">
                        <div class="row">
                            <div class="col-2">
                                <i class="fab fa-mdb fa-2x mb-1 indigo-text" aria-hidden="true"></i>
                            </div>
                            <div class="col-10 mb-2">
                                <h5 class="feature-title font-bold mb-1">MDBootstrap</h5>
                                <p class="grey-text mt-2">Фреймворк для создания адаптивных мобильных сайтов и приложений в стиле Material Design</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row features-small mt-4 wow fadeIn">
                    <div class="col-xl-3 col-lg-6">
                        <div class="row">
                            <div class="col-2">
                                <i class="fab fa-github fa-2x mb-1 indigo-text" aria-hidden="true"></i>
                            </div>
                            <div class="col-10 mb-2">
                                <h5 class="feature-title font-bold mb-1">Github</h5>
                                <p class="grey-text mt-2">Крупнейший веб-сервис для хостинга IT-проектов и их совместной разработки.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
