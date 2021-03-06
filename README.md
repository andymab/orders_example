# Общее описание:
Реализована система принятия и обработки заявок пользователей с сайта. 

Любой (Зарегистрировавшийся) пользователь может отправить данные по публичному API, реализованному мной, оставив заявку с каким-то текстом,. 

Затем заявка рассматривается Пользователем с ролью Администратор и назначается ответственный за ее выполнение Менеджер

Затем заявка рассматривается Менеджером и ей устанавливается статус Завершено. 
Чтобы установить этот статус, ответственное лицо должно оставить комментарий. 
Пользователь получает свой ответ по email.
При этом, Менеджер  имеет возможность получить список заявок, отфильтровать их по статусу и по дате, периоду.

# Установка
Должно быть установлено:
- php 7.3 и выше
- Mysql 8 и выше
- composer,nodejs,npm

инсталяция:
- git clone https://github.com/andymab/orders_example.git you-domain
- cd you-domain
- composer all
- npm install && npm run dev
- cp .env.example .env
- В .env установить базу данных, пароль, логин, MAIL_MAILER=log
- php artisan migrate --seed
- php artisan serve
# Пароли


*Управляющий* role.admin:
- распределяет заявки менеджерам (ответственным лицам) 
- Видит все заявки

*login: admin@localhost password: admin*

*Менеджер* role.manager
- Видит только свои заявки, 
- Закрывает, 
- Отвечает и отправляет письма заказчикам

*login: manager@localhost password: manager*

*Пользователь* role.user: 
- Создает заявку и отправляется письмо
- видит только свои заявки
- удаляет

*login: user@localhost password: user*

# Сущности
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

# Контроллеры
OrderController | Обработка заявок (Основной REST контроллер)
---|---
index| GET/HEAD показ заявок включая фильтрацию
create| GET/HEAD показ пустой новой формы заявки
store| POST запись новой заявки
show|  GET/HEAD показ одной заявки
edit| GET/HEAD показ заполненой формы для одной заявки
update| PUT/PATCH изменение существующей заявки
destroy| DELETE удаление одной заявки
         
# Дополнение
Безопасность входящих запросов, чтобы избежать кроссдоменных запросов регулируется @csrf laravel
проверяются пользователи, роли, возмжности на уровне сервера и на уровне html

Для большего объема заявок используется paginate() в дальнейшем cursorpaginate возможно использование datatables.js с server-side механизмом объемы данных при этом не ограничены, но необходимо а индексировать все фильтруемые поля и использовать специализированную базу даннных

# Пути развития
(или на что времени не хватило)
При большом объеме заявок 
- вместо paginate() необхлодимо использовать cursorPaginate
- отправка Почты должна вестись через постановку в очередь и обработку событий
- не написаны тесты
- не создана документация подключил бы плагин чтобы документация формировалась автоматически
- не переведены lang
- отсутствует дизайн
- и хорошо бы пробежать и все почистить
