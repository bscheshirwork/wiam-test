API для подачи и обработки заявки на займ
-


Требования к технической составляющей и используемым технологиям: 
фреймворк Yii2, веб-сервер – Nginx, база данных – PostgreSQL, инструмент для контейнеризации – docker compose.

Оформление кода: представьте, что ваш код отправится в продакшн. 

Придерживайтесь стандартов качества. Код должен быть хорошо структурирован, документирован и легко поддерживаем.

В итоговом проекте должен быть файл README.md с информацией о запуске проекта и о затраченном времени на выполнение задания. 
Код проекта должен быть выложен на Github.

После запуска, сервер приложения должен быть доступен по адресу localhost на 80 порту.

База данных должна быть создана со следующими данными:
```
host: localhost
порт: 5432
название БД: loans
пользователь: user
пароль: password
```

Требования к именованию хостнейма, параметрам подключения к БД и названиям эндпоинтов строго обязательны 
(будут запускаться автоматические тесты).

Для упрощения задачи проверки прав доступа не требуются.

Эндпоинты API:

·   `POST /requests`: подача заявки на займ
·   `GET /processor`: обработка заявок

1. Подача заявки на займ

Эндпоинт: `POST /requests`

Описание: Подача новой заявки на займ. Поданная заявка сохраняется в базе данных.

Тело запроса:
```
{
    "user_id": 1,
    "amount": 3000,
    "term": 30
}
```

Параметры:

·   `user_id` (целое число): идентификатор пользователя, подающего заявку.
·   `amount` (целое число): сумма займа, которую пользователь запрашивает.
·   `term` (целое число): срок займа в днях.

Дополнительное условие проверки: пользователь не имеет одобренных заявок.

Ответ успешный:
```
HTTP Code 201
{
    "result": true,
    "id": 42,
}
```
`result` (boolean): результат выполнения операции.
`id` (целое число): идентификатор созданной заявки.

Ответ неуспешный (не пройдена валидация):
```
HTTP Code 400
{
    "result": false
}
```

`result` (boolean): результат выполнения операции.



2. Запуск обработки заявок

Эндпоинт: `GET /processor?delay=5`

Параметры:
·   `delay` (целое число): время задержки используемое для принятия решения.

Описание: Запуск обработки заявок на займ. По результату обработки каждой заявки, ей должен быть установлен 
один из статусов “approved” или ”declined”. Принятие решения должно происходить рандомно. 
Вероятность аппрува заявки – 10%. У одного пользователя не может быть более одной одобренной заявки. 
Нужно эмулировать продолжительное время принятия решения каждой заявки с помощью функции sleep(), 
в которую в качестве аргумента передать значение delay из запроса. 
Этот эндпоинт может быть запрошен несколько раз одновременно. 
Заявки одного пользователя могут обрабатываться параллельно.

Ответ:
```
HTTP Code 200
{
    "result": true
}
```

`result` (boolean): результат выполнения операции.




Информация о запуске проекта
-

1. Скопировать `.env` из примера, уточнить переменные среды

т.к. предполагается какая-то автоматическая обработка, стоит обратить внимание на:
- разделение конфигов `docker compose` - верхние строчки в `.env` служат именно для этого;
- параметры базы. Для [docker-compose.dev.yml](docker-compose.dev.yml) локально поднятая `postgres`. Для "прода" есть
практика использовать базу вне композиции, в таком случае не будет ни `volumes` как использовал, ни `named volumes`.
Соответственно, сервис `postgres` не будет описан за ненадобностью. Если в тестовой среде нужно использовать базу 
в чёрном ящике, стоит завернуть в `named volumes` - с необходимостью чистить хвосты.
  (Не проблема, если тестовая среда создаётся с нуля и дропается по завершении)
- Нет прямого доступа к источникам либо не пускает трафик напрямую из соображений безопасности - настроить proxy 
для этапов сборки контейнера, для этапов получения образов с docker.hub - для демона. 


3. Запустить композицию `wiam-test$ docker compose up -d --build`.

3. Установить зависимости `composer` `wiam-test$ docker compose exec php composer install`. 

4. Выполнить миграции `wiam-test$ docker compose exec php yii migrate/up`.

Проверка
```
wiam-test$ curl -X 'POST'   'http://0.0.0.0/requests'   -H 'accept: */*'   -H 'Content-Type: application/json'   -d '{
  "user_id": 2,
  "amount": 2,
  "term": 2
}'
{"result":true,"id":4}
```
```
wiam-test$ curl -X 'GET'   'http://0.0.0.0/processor?delay=1'   -H 'accept: */*'
{"result":true}
```

Информация о трудозатратах, треки
- 

Начал 07.06.25 после 14:00

Анализ, подбор сервисов, проверка последних версий и практик ~ 14-17

Создание readme, первый коммит ~ 17-18

Приведение композиции к работоспособному состоянию, поиск решения возникаюзи проблем ~19-21.

Проверка корректности работы контейнера базы, соединения ~21-22

Добавление частей базового функционала, структуры модулей, настроек ~15-16.

Подгрузка вендоров, определение актуальных версий, решение проблем ~16-17 

Структура контроллеров, моделей запроса ~18-20

Структура слоёв, логика, оформление ~10-14