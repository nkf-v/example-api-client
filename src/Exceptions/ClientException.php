<?php

namespace ExampleApi\Exceptions;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ClientException extends \Exception implements ClientExceptionInterface
{
    public function __construct(
        protected readonly RequestInterface $request,
        protected readonly ?ResponseInterface $response,
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        parent::__construct($this->createMessage($request), $code, $previous);
    }

    protected function createMessage(RequestInterface $request): string
    {
        return $request->getMethod().' '.$request->getUri();
    }
}
