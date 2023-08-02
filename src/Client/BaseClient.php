<?php

namespace Ihome\WujieAi\Client;

use Ihome\WujieAi\Config\Config;

class BaseClient
{
    /**
     * @var Config
     */
    protected $config;

    public function __construct($config)
    {
        $this->config = $config;
    }
    // 封装请求第三方的公共方法
    public function request($url, $data)
    {

    }

    public function getBaseUrl()
    {
        return $this->config->getUrl();
    }
}