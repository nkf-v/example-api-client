<?php

namespace ExampleApi;

class Config
{
    protected $url;

    /**
     * @param $url
     */
    public function __construct($url)
    {
        // TODO add assert
        $this->url = trim($url, '/');
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }
}