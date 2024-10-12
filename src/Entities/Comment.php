<?php

namespace ExampleApi\Entities;

class Comment
{
    private ?int $id = null;
    private string $name;
    private string $text;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): Comment
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Comment
    {
        if ('' === $name) {
            throw new \InvalidArgumentException('Имя не должно быть пустым');
        }

        $this->name = $name;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): Comment
    {
        if ('' === $text) {
            throw new \InvalidArgumentException('Текст не должен быть пустым');
        }

        $this->text = $text;

        return $this;
    }

    public static function toArray(self $comment): array
    {
        $result = [
            'id' => $comment->getId(),
            'name' => $comment->getName(),
            'text' => $comment->getText(),
        ];

        return array_filter($result);
    }

    public static function fromDatum(array $datum): self
    {
        return (new self())
            ->setId($datum['id'])
            ->setName($datum['name'])
            ->setText($datum['text']);
    }
}
