<?php

namespace Tests;

use ExampleApi\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase as BaseTestCase;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

abstract class TestCase extends BaseTestCase
{
    private MockHandler $mock;

    protected function createConfig(): Config
    {
        return new Config('https://example.com');
    }

    private function createMockHandler(): MockHandler
    {
        $this->mock = new MockHandler();

        return $this->mock;
    }

    protected function getMock(): MockHandler
    {
        return $this->mock;
    }

    protected function createClient(): ClientInterface
    {
        $handler = HandlerStack::create($this->createMockHandler());

        return new Client(['handler' => $handler]);
    }

    protected function createSuccessResponse(array $data = []): ResponseInterface
    {
        return new Response(200, [], json_encode($data));
    }
}
