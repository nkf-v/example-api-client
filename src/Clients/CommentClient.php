<?php

namespace ExampleApi\Clients;

use ExampleApi\BaseClient;
use ExampleApi\Entities\Comment;
use ExampleApi\Exceptions\ClientException;

final class CommentClient extends BaseClient
{
    /**
     * @throws ClientException
     */
    public function getAll(): array
    {
        $request = $this->createRequest('GET', '/comments');

        $response = $this->send($request);

        $data = $this->getDataFromResponse($response);

        return $data;
    }

    /**
     * @throws ClientException
     */
    public function add(Comment $comment): Comment
    {
        $request = $this->createRequest('POST', '/comments');

        $response = $this->send($request);

        $data = $this->getDataFromResponse($response);

        return $comment->setId($data['id']);
    }

    /**
     * @throws ClientException
     */
    public function update(Comment $comment): void
    {
        $request = $this->createRequest('PUT', "/comments/{$comment->getId()}");

        $this->send($request);
    }
}