<?php

namespace Tests\Entities;

use ExampleApi\Entities\Comment;
use PHPUnit\Framework\TestCase;

/**
 * @testdox тесты проверки формирования сущности "Комментарий"
 */
final class CommentTests extends TestCase
{
    /**
     * @testdox Тест проверки успешного создания комментария
     */
    public function testSuccessCreate(): void
    {
        $comment = (new Comment())
            ->setId(1)
            ->setName('Name')
            ->setText('Text');

        $this->assertNotNull($comment);
        $this->assertNotNull($comment->getId());
        $this->assertNotEmpty($comment->getName());
        $this->assertNotEmpty($comment->getText());
    }

    /**
     * @testdox Тест проверки что нельзя создать комментарий с пустым именем
     */
    public function testExceptionEmptyName(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        (new Comment())->setName('');
    }

    /**
     * @testdox Тест проверки что нельзя создать комментарий с пустым текстом
     */
    public function testExceptionEmptyText(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        (new Comment())->setText('');
    }
}
