<?php

namespace Ihome\WujieAi;

use Ihome\WujieAi\Config\Config;

/*
 * Class WujieFactory
 * @property \Ihome\WujieAi\Client\VideoClient $video
 * @property \Ihome\WujieAi\Client\ImageClient $image
 */
class WujieAiFactory
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var array ClientInterface
     */
    private $clients;

    public function __construct(array $config)
    {
        $this->config = $this->createConfig($config);
    }

    /**
     * 创建工厂
     * User: ❤ CLANNAD ~ After Story By だんご
     * @param array $config
     * @return WujieAiFactory
     */
    public static function create(array $config)
    {
        return new self($config);
    }

    private function createConfig(array $config)
    {
        return new Config($config);
    }

    public function __get($name)
    {
        if ( ! isset($this->clients[$name])){
            $clientName = sprintf("%sClient", "Ihome\\WujieAi\\Client\\" . ucfirst($name));

            try {
                $this->clients[$name] = new $clientName($this->config);
            }catch (\InvalidArgumentException $e) {
                throw new \InvalidArgumentException(sprintf("Client %s not found", $name));
            }
        }

        return $this->clients[$name];
    }
}