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
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * 获取应用私钥
     * User: ❤ CLANNAD ~ After Story By だんご
     * @return mixed
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * 获取版本号
     * User: ❤ CLANNAD ~ After Story By だんご
     * @return int
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * 获取请求地址
     * User: ❤ CLANNAD ~ After Story By だんご
     * @return mixed|string
     */
    public function getUrl()
    {
        return $this->url;
    }
}