# TinderAPI for PHP

Неофициальная библиотека для доступа к Тиндеру по API на PHP. Пополняю по мере разбора 
новых точек.
Список поддерживаемых сейчас методов - ниже.
Стандартная последовательность для получения токена:
1. Отправка СМС
2. Верификация СМС, получение обновляемого токена
3. Получение токена api с помощью обновляемого токена.

После получения апи токена доступны все остальные методы.

Базовый хост для всех запросов: api.gotinder.com

Структура URL для запроса: api.gotinder.com/{api_version}/{request_uri}

_P.S.> Простите за смесь языков и безумие в оформлении, это моя первая попытка 
что-то в опенсорс выложить._

## Basic usage
Базовый пример использования (авторизация + лайк)

1 шаг. Авторизация через СМС
```php
$client = new Client;
$phone = "xxxxxxxxxxx"; //your phone number without lead "+"
$client->sendSms($phone);
```

2 шаг. После получения СМС его надо подтвердить
```php
$client = new Client;
$phone = "xxxxxxxxxxx"; //your phone number without lead "+"
$otpCode = "xxxxxx"; //message from SMS
$result = $client->loginBySms($phone, $otpCode); 
$apiToken = $result->data->api_token; //this token you should use for subscribe every request
```
Шаг 3. Допустим, лайк
```php
$client = new TinderAPI\Client;
$client->setApiToken($apiToken"); //Api Token from step 2
$result = $client->like($id, $sNumber); // id - идентификатор пользователя, sNumber - внутренний рейтинг пользователя
```

### Endpoints without version
Без версии остался базовый функционал приложения - просмотр профилей, свайпы и суперлайки.
Для каждого действия требуется основной ID пользователя.

| Uri           | Method    | Status    | Comment  |
| :---          | :---      | :---:     | :---     |
| like/{$id}    | POST      |+          | Swipe right |
| pass/{$id}    | POST      |+          | Swipe left |
| like/{$id}/super| POST    |+          | Swipe up |
| user/{$id}    | GET       |+          | Get user info |
| user/recs   | GET       | +          | Get user recommendation |
| updates/{$listOfParams}   | GET       | Not implemented          | ??? |

### Endpoints v2
Базовые вещи для аутентификации через СМС, работы с профилем и, собственно, получение профилей для работы

| Uri           | Method    | Status    | Comment  |
| :---          | :---      | :---:     | :---     |
| auth/sms/send?auth_type=sms | POST | + | Send SMS to number (Post data: `{"phone_number":"70000000000"}`)|
| auth/sms/validate?auth_type=sms | POST | + | Validate OTP code from SMS (Post data: `{"phone_number":"70000000000", "otp_code":"xxxxxx"}`) |
| auth/login/sms | POST | + | get API token from refresh token (Post data: `{"refresh_token":"xxxxxxxxxxxx"}`)|
| profile?include=xxx,xxx,xxx| GET | + | Get profile data (include parameters: user, likes, boost etc.)|
| recs/core | GET | + | Get list of users |
| fast-match/teaser | GET | Not implemented  | Get likes preview (count and main image)|
| fast-match/teasers | GET | + | Получение набора изображений пользователей, лайкнувших авторизованного|
| push/notification | PUT | Not implemented | ??? |
| meta | POST | Not implemented | ??? |
| buckets | POST | Not implemented | ??? |

## Examples
