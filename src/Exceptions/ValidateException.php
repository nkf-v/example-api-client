<?php

namespace ExampleApi\Exceptions;

use Psr\Http\Message\RequestInterface;

final class ValidateException extends ClientException
{
    protected function createMessage(RequestInterface $request): string
    {
        return 'Не верные параметры запроса: '.parent::createMessage($request);
    }
}
