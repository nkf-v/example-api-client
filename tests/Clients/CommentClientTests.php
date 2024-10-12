<?php

namespace Tests\Clients;

use ExampleApi\Clients\CommentClient;
use ExampleApi\Entities\Comment;
use GuzzleHttp\Psr7\HttpFactory;
use Tests\TestCase;

/**
 * @testdox Тесты проверки методов клиента комментариев
 */
final class CommentClientTests extends TestCase
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

    public static function provideCommentsData(): array
    {
        return [
            'Пустой список' => [[]],
            'Один комментарий' => [
                [
                    ['id' => 1, 'name' => 'Test', 'text' => 'Hello world!'],
                ],
            ],
            'Несколько комментариев' => [
                [
                    ['id' => 1, 'name' => 'Test', 'text' => 'Hello world!'],
                    ['id' => 2, 'name' => 'Test', 'text' => 'Hello world!'],
                ],
            ],
        ];
    }

    /**
     * @testdox Тест метода получения всех комментариев
     *
     * @dataProvider provideCommentsData
     */
    public function testGetAll(array $data): void
    {
        $this->getMock()->append(
            $this->createSuccessResponse($data)
        );

        $result = $this->commentClient->getAll();

        $this->assertCount(count($data), $result);
    }

    public static function provideCommentId(): array
    {
        return [
            [1],
            [2],
        ];
    }

    /**
     * @testdox Тест проверки метода добавления комментария
     *
     * @dataProvider provideCommentId
     */
    public function testAdd(int $id): void
    {
        $comment = (new Comment())
            ->setText('Hello world!')
            ->setName('Test')
        ;

        $this->getMock()->append(
            $this->createSuccessResponse(['id' => $id])
        );

        $comment = $this->commentClient->add($comment);

        $this->assertEquals($id, $comment->getId());
    }

    public static function provideComment(): array
    {
        return [
            [1, 'test', 'Hello world!'],
        ];
    }

    /**
     * @testdox Тест проверки метода обновления комментария
     *
     * @dataProvider provideComment
     */
    public function testUpdate(int $id, string $name, string $text): void
    {
        $comment = (new Comment())
            ->setId($id)
            ->setText($text)
            ->setName($name)
        ;

        $this->getMock()->append(
            $this->createSuccessResponse()
        );

        $this->commentClient->update($comment);

        $this->assertTrue(true);
    }
}
