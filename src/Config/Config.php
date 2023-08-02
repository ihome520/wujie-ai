<?php

namespace Ihome\WujieAi\Config;

class Config
{
    public $appId;

    public $appSecret;

    public $url;

    public function __construct($config)
    {
        $this->appId = $config['appId'];
        $this->appSecret = $config['appSecret'];
        $this->url = 'http://localhost';
    }

    public function getUrl()
    {
        return $this->url;
    }
}