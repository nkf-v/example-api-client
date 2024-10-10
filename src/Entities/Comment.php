<?php

namespace ExampleApi\Entities;

class Comment
{

    public function __construct(
        private int    $id,
        private string $name,
        private string $text,
    )
    {
    }

    public function getId(): int
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
        $this->name = $name;
        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): Comment
    {
        $this->text = $text;
        return $this;
    }
}