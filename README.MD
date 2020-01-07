# TinderAPI for PHP

Unofficial PHP library for Tinder API. 
Full list of founded endpoints. 
Supports basic usage for auth, pass/likes and superlikes, getting profile info.

## Basic usage
Basic usage example: 

```
$client = new TinderAPI\Client;
$client->setApiToken("string_api_token");
$result = $client->like($id, $sNumber);
```

### Endpoints without version
| Uri  | Method |
| :--- | :--- |
| like/{$id}  | POST  |
| pass/{$id}  | POST  |
| like/{$id}/super  | POST  |
| user/{$id}  | GET  |
### Endpoints v1
### Endpoints v2

### Endpoints v3
### Endpoints v4
## Examples