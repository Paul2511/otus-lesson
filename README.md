<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Сервис подбора преподавателей

Сервис обеспечивает механизм подбора преподавателей. Имеется спектр навыков, совокупность студентов, и совокупность преподавателей. У каждого студента есть набор навыков, которые он хочет освоить, у каждого преподавателя набор навыков, которыми он владеет.

Сервис должен решать следующие задачи:

- Организация студентов в группы по заданным ограничениям;
- Для каждой группы подбор преподавателей по заданным ограничениям;
- Подбор для нового студента максимально подходящей ему группы;
- Поиск замены преподавателя из «свободных» преподавателей.

## Установка

1. Перед запуском вам необходимо установить все зависимости и собрать фронт:

   ```console
   npm i
   npm run production
   ```

2. Применить миграций и заполнить справочники:

   ```console
   php artisan migrate --seed
   ```

## Возможности

* Для создания тестовых данных необходимо выполнить следующую команду:

  ```console
  php artisan db:seed --class=DataSeeder
  ```

### Frontend статичные страницы

* О нас(`\about`);
* Политика конф-ти(`\policy`);
* Авторизация(`\login`);
* Регистрация(`\signup`);
* Профиль(`\profile`).

### Панель администрирования

* Красивая тема панели управления с открытым исходным кодом для серверной части AdminLTE 3;
* CRUD для справочников, пользователей и учебных групп.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
