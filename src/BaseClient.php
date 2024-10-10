<?php

namespace ExampleApi;

use ExampleApi\Exceptions\ClientException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class BaseClient
{
    /**
     * @param ClientInterface $httpClient
     */
    public function __construct(
        private readonly ClientInterface $httpClient,
        private readonly Config $config,
        private readonly RequestFactoryInterface $requestFactory,
    )
    {
    }

    public function createRequest(string $method, string $url): RequestInterface
    {
        return $this->requestFactory->createRequest($method, $this->config->getUrl() . $url);
    }

    protected function handle(RequestInterface $request, ResponseInterface $response): void
    {
        switch ($response->getStatusCode()) {
            case 400:
                throw new ValidateException($request, $response);

            case 404:
                throw new NotFoundMethodException($request, $response);

            case 500:
                throw new ServerErrorException($request, $response);

            default:
                if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
                    throw new ClientException($request, $response);
                }
                break;
        }
    }

    /**
     * @throws ClientException
     */
    protected function send(RequestInterface $request): ResponseInterface
    {
        $response = null;

        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            throw new ClientException($request, $response, $e->getCode(), $e);
        }

        $this->handle($request, $response);

        return $response;
    }

    protected function getDataFromResponse(ResponseInterface $response): array
    {

    }
}