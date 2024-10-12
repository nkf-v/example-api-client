<?php

namespace ExampleApi;

class Config
{
    protected string $url;

    public function __construct($url)
    {
        // TODO add assert
        $this->url = trim($url, ' /');
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}
