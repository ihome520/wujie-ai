<?php

namespace Ihome\WujieAi\Client;

class VideoClient extends BaseClient implements ClientInterface
{
    public $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function create(array $query)
    {
        // TODO: Implement create() method.
    }
}