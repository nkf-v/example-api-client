# Example API Клиент

Клиент для взаимодействия с http://example.com/

## Установка

```shell
composer require nkf/example-api-client
```

## Comment

Пример использования клиента для работы с комментариями

```php
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use ExampleApi\Config;
use ExampleApi\Clients\CommentClient;

$config = new Config('http://example.com/'); // Можно изменить если используется проксирующий домен

$client = new CommentClient(
  new Client(),
  $config,
  new HttpFactory(),
);

$comments = $client->getAll(); // Получаем все комментарии
```
