<?php

namespace Ihome\WujieAi\Config;

class Config
{
    /**
     * @var mixed 应用ID
     */
    private $appId;

    /**
     * @var mixed 应用密钥
     */
    private $privateKey;

    /**
     * @var int 版本号
     */
    private $version;

    /**
     * @var mixed 请求地址
     */
    private $url;

    public function __construct($config)
    {
        $this->appId = $config['appId'];
        $this->privateKey = $config['privateKey'];
        $this->url = $config['baseUrl'];
        $this->version = 1;
    }

    /**
     * 获取APPID
     * User: ❤ CLANNAD ~ After Story By だんご
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * 获取应用私钥
     * User: ❤ CLANNAD ~ After Story By だんご
     * @return array
     */
    public function getPrivateKey(): string
    {
        return $this->privateKey;
    }

    /**
     * 获取版本号
     * User: ❤ CLANNAD ~ After Story By だんご
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * 获取请求地址
     * User: ❤ CLANNAD ~ After Story By だんご
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}