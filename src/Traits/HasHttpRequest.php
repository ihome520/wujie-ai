<?php

namespace Ihome\WujieAi\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Ihome\WujieAi\Exceptions\InvalidHttpException;

Trait HasHttpRequest
{
    private $baseUrl;

    private $options = [];

    private $query;


    public function setConnectTimeOut($seconds)
    {
        $this->options[RequestOptions::CONNECT_TIMEOUT] = $seconds;
    }

    public function getConnectTimeOut()
    {
        return $this->options[RequestOptions::CONNECT_TIMEOUT];
    }

    public function setTimeOut($seconds)
    {
        $this->options[RequestOptions::TIMEOUT] = $seconds;
    }

    public function getTimeOut()
    {
        return $this->options[RequestOptions::TIMEOUT];
    }

    public function setHeaders(array $headers)
    {
        $this->options['headers'] = $headers;
    }

    public function addHeaders(string $key, string $value)
    {
        $this->options['headers'][$key] = $value;
    }

    public function getHeaders()
    {
        return $this->options['headers'];
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function setQuery(array $query)
    {
        $this->options['query'] = $query;
    }

    public function getQuery()
    {
        return $this->options['query'];
    }

    public function setData(array $data)
    {
        $this->options['json'] = $data;
    }

    public function getData()
    {
        return $this->options['json'];
    }

    /**
     * 统一请求方法
     * User: ❤ CLANNAD ~ After Story By だんご
     * @param string $method
     * @param string $url
     * @return mixed
     * @throws InvalidHttpException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $method, string $url): array
    {
        $this->options[RequestOptions::CONNECT_TIMEOUT] = $this->options[RequestOptions::CONNECT_TIMEOUT] ?? 5;
        $this->options[RequestOptions::TIMEOUT] = $this->options[RequestOptions::TIMEOUT] ?? 30;

        try{
            $response = $this->getHttpClient()->request($method, sprintf('%s%s',$this->getBaseUrl(), $url), $this->options);

            return json_decode($response->getBody()->getContents(), true);
        }catch (\Exception $exception){
            throw new InvalidHttpException($exception->getMessage());
        }
    }

    public function getHttpClient(): Client
    {
        return new Client();
    }
}