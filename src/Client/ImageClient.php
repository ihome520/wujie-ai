<?php

namespace Ihome\WujieAi\Client;

class ImageClient extends BaseClient implements ClientInterface
{
    public function __construct($config)
    {
        parent::__construct($config);
    }

    public function create(array $query)
    {
        // TODO: Implement create() method.
        $this->request('/user/info', $query);
    }


}