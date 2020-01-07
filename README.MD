# Tinder API for PHP (2020)
This library implements all of founded endpoints - from login to logout.

**Important! Requires enabled http/2 module!**

|||
|:---|:---|
| base URL | api.tinder.com |
|API version|2|

| path | method | data | comment | implementation |
|:---|:---|:---|:---|:---|
|auth/sms/send?auth_type=sms | POST | {"phone_number":"xxx"} |Отправляет СМС на указанный номер | look here |
|auth/sms/validate?auth_type=sms | POST | {"phone_number":"xxx","otp_code":"xxxxxx", "is_update":true/false} | Верифицирует полученный номер | look here |
|auth/login/sms|POST|{"refresh_token":"xxxxxx"}|||
|meta|POST||||
|fast-match/teaser|GET||||
|recs/core|GET||||
|profile?include=xxx,yyy|GET||||
---
|||
|:---|:---|
| base URL | api.tinder.com |
|API version|1|

| path | method | data | comment | implementation |
|:---|:---|:---|:---|:---|
|superlikeable|GET||||
---
|||
|:---|:---|
| base URL | api.tinder.com |
|API version|none|

| path | method | data | comment | implementation |
|:---|:---|:---|:---|:---|
|updates?|POST||||
|like/_id|POST||||
|pass/_id|GET||||