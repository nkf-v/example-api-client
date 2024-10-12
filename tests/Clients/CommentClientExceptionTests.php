<?php

namespace Tests\Clients;

use ExampleApi\Clients\CommentClient;
use ExampleApi\Exceptions\ClientException;
use ExampleApi\Exceptions\NotFoundMethodException;
use ExampleApi\Exceptions\ServerErrorException;
use ExampleApi\Exceptions\ValidateException;
use GuzzleHttp\Psr7\HttpFactory;
use GuzzleHttp\Psr7\Response;
use Tests\TestCase;

/**
 * @testdox Тесты проверки возникновения исключений
 */
final class CommentClientExceptionTests extends TestCase
{
    private CommentClient $commentClient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->commentClient = new CommentClient(
            $this->createClient(),
            $this->createConfig(),
            new HttpFactory()
        );
    }

    /**
     * @testdox Тест проверки возникновения исключения 500 InternalServerError
     */
    public function testExceptionServerError(): void
    {
        $this->getMock()->append(
            new Response(500)
        );

        $this->expectException(ServerErrorException::class);

        $this->commentClient->getAll();
    }

    /**
     * @testdox Тест проверки возникновения исключения 404 NotFound
     */
    public function testExceptionNoFound(): void
    {
        $this->getMock()->append(
            new Response(404)
        );

        $this->expectException(NotFoundMethodException::class);

        $this->commentClient->getAll();
    }

    /**
     * @testdox Тест проверки возникновения исключения 400 BadRequest
     */
    public function testExceptionValidate(): void
    {
        $this->getMock()->append(
            new Response(400)
        );

        $this->expectException(ValidateException::class);

        $this->commentClient->getAll();
    }

    /**
     * @testdox Тест проверки возникновения исключения клиента
     */
    public function testExceptionClient(): void
    {
        $this->getMock()->append(
            new Response(504)
        );

        $this->expectException(ClientException::class);

        $this->commentClient->getAll();
    }
}
