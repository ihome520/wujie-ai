<?php

namespace Ihome\WujieAi;

use Ihome\WujieAi\Client\ImageClient;
use Ihome\WujieAi\Client\VideoClient;
use Ihome\WujieAi\Config\Config;

class WujieFactory
{
    /**
     * @var Config
     */
    protected $config;

    public function __construct($config)
    {
        $this->config = $this->getConfig($config);
    }

    public static function create($config)
    {
        return new self($config);
    }

    public function getConfig($config)
    {
        return new Config($config);
    }

    public function image()
    {
        return new ImageClient($this->config);
    }

    public function video()
    {
        return new VideoClient($this->config);
    }
}