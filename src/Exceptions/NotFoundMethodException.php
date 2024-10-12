<?php

namespace ExampleApi\Exceptions;

use Psr\Http\Message\RequestInterface;

final class NotFoundMethodException extends ClientException
{
    protected function createMessage(RequestInterface $request): string
    {
        return 'API метод не найден: '.parent::createMessage($request);
    }
}
