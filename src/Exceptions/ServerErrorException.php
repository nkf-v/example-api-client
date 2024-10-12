<?php

namespace ExampleApi\Exceptions;

use Psr\Http\Message\RequestInterface;

final class ServerErrorException extends ClientException
{
    protected function createMessage(RequestInterface $request): string
    {
        return 'Ошибка на стороне сервера при выполнение запроса: '.parent::createMessage($request);
    }
}
