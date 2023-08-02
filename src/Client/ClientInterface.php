<?php

namespace Ihome\WujieAi\Client;

interface ClientInterface
{
    /**
     * @return mixed
     */
    public function create(array $query);
}