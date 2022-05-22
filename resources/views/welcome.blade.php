<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            /* vertical-align: middle */
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
            @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Войти</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Зарегистрироваться</a>
            @endif
            @endauth
        </div>
        @endif
<style>
.lead p{
    padding: 0;
    margin: 0;
}
</style>
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <img src="/media/index.png" alt="" sizes="" srcset="">
            </div>

            <div class="pt-8 sm:justify-start sm:pt-0 lead">
                <h2>Общее описание:</h2>
                <hr>
<p>Реализована система принятия и обработки заявок пользователей с сайта. </p>

<p>Любой (Зарегистрировавшийся) пользователь может отправить данные по публичному API, реализованному мной, оставив заявку с каким-то текстом,. </p>

<p>Затем заявка рассматривается Пользователем с ролью Администратор и назначается ответственный за ее выполнение Менеджер</p>

<p>
    Затем заявка рассматривается Менеджером и ей устанавливается статус Завершено.
    Чтобы установить этот статус, ответственное лицо должно оставить комментарий.
    Пользователь получает свой ответ по email.
    При этом, Менеджер  имеет возможность получить список заявок, отфильтровать их по статусу и по дате, периоду.
</p>

<h2>Установка</h2><hr>
<p>Должно быть установлено:</p>
<ul>
    <li>- php 7.3 и выше</li>
    <li>- Mysql 8 и выше</li>
    <li>- composer,nodejs,npm</li>
</ul>

инсталяция:
<ul>
    <li>- git clone https://github.com/andymab/orders_example.git you-domain</li>
    <li>- cd you-domain</li>
    <li>- composer all</li>
    <li>- npm install && npm run dev</li>
    <li>- cp .env.example .env</li>
    <li>- В .env установить базу данных, пароль, логин, MAIL_MAILER=log</li>
    <li>- php artisan migrate --seed</li>
    <li>- php artisan serve</li>
</ul>
<h2>Пароли</h2><hr>


<p>*Управляющий* role.admin:</p>
<ul>
    <li>- распределяет заявки менеджерам (ответственным лицам)</li>
    <li>- Видит все заявки</li>
    <li>login: admin@localhost password: admin</li>
</ul>



<p>*Менеджер* role.manager</p>

<ul>
    <li>- Видит только свои заявки,</li>
    <li>- Закрывает,</li>
    <li>- Отвечает и отправляет письма заказчикам</li>
    <li>login: manager@localhost password: manager</li>
</ul>

<p>*Пользователь* role.user: </p>
<ul>
    <li>- Создает заявку и отправляется письмо</li>
    <li>- видит только свои заявки</li>
    <li>- удаляет</li>
    
    <li>login: user@localhost password: user</li>
</ul>

<h2>Сущности</h2><hr>
<pre>
    Users | Пользователи
    --- |---
    id|Уникальный идентификатор
    name | string
    email |Уникальный идентификатор
    email_verified_at| верификация дата
    role| enum ['user','admin','manager'] default('user')
    password| hash
    created_at | Время создания
    updated_at | Время обновленя
    
    
     Orders |(заявки)
    ---|---
     id | Уникальный идентификатор |
    | user_id | bigint ссылка на user->id автор заявки |
    | manager_id | bigint ссылка на user->id ответственное лицо |
    | status | Статус - enum(“Active”, “Resolved”) Resolved если есть comment |
    | message | Сообщение пользователя - текст, обязательный |
    | comment | Ответ ответственного лица - текст, обязательный, если статус Resolved |
    | created_at | Время создания заявки - timestamp или datetime |
    | updated_at | Время ответа на заявку |
</pre>

<h2>Контроллеры</h2><hr>
<pre>
    OrderController | Обработка заявок (Основной REST контроллер)
    ---|---
    index| GET/HEAD показ заявок включая фильтрацию
    create| GET/HEAD показ пустой новой формы заявки
    store| POST запись новой заявки
    show|  GET/HEAD показ одной заявки
    edit| GET/HEAD показ заполненой формы для одной заявки
    update| PUT/PATCH изменение существующей заявки
    destroy| DELETE удаление одной заявки
</pre>
         
<h2>Дополнение</h2><hr>
<p>
    Безопасность входящих запросов, чтобы избежать кроссдоменных запросов регулируется @csrf laravel
    проверяются пользователи, роли, возмжности на уровне сервера и на уровне html
</p>

<p>Для большего объема заявок используется paginate() в дальнейшем cursorpaginate возможно использование datatables.js с server-side механизмом объемы данных при этом не ограничены, но необходимо а индексировать все фильтруемые поля и использовать специализированную базу даннных</p>

<h2>Пути развития</h2><hr>
<pre>
    (или на что времени не хватило)
    При большом объеме заявок
    - вместо paginate() необхлодимо использовать cursorPaginate
    - отправка Почты должна вестись через постановку в очередь и обработку событий
    - не написаны тесты
    - не создана документация подключил бы плагин чтобы документация формировалась автоматически
    - не переведены lang
    - отсутствует дизайн
    - и хорошо бы пробежать и все почистить
</pre>

            </div>

            <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
            </div>
        </div>
    </div>
</body>

</html>