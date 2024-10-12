<?php

namespace ExampleApi\Clients;

use ExampleApi\BaseClient;
use ExampleApi\Entities\Comment;
use GuzzleHttp\Psr7\Utils;

final class CommentClient extends BaseClient
{
    /**
     * @return Comment[]
     */
    public function getAll(): array
    {
        $request = $this->createRequest('GET', '/comments');

        $response = $this->send($request);

        $data = $this->getDataFromResponse($response);

        return $this->fromData($data);
    }

    public function add(Comment $comment): Comment
    {
        $request = $this->createRequest('POST', '/comments')
            ->withBody(Utils::streamFor(json_encode(Comment::toArray($comment))))
        ;

        $response = $this->send($request);

        $data = $this->getDataFromResponse($response);

        return $comment->setId($data['id']);
    }

    public function update(Comment $comment): void
    {
        if (null === $comment->getId()) {
            throw new \InvalidArgumentException('Комментарий не содержит ID');
        }

        $request = $this->createRequest('PUT', "/comments/{$comment->getId()}")
            ->withBody(Utils::streamFor(json_encode(Comment::toArray($comment))))
        ;

        $this->send($request);
    }

    /**
     * @return Comment[]
     */
    private function fromData(array $data): array
    {
        $result = [];

        foreach ($data as $datum) {
            $result[] = Comment::fromDatum($datum);
        }

        return $result;
    }
}
