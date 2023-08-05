<?php

namespace Ihome\WujieAi\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use Ihome\WujieAi\Exceptions\InvalidHttpException;

Trait HasHttpRequest
{
    /**
     * @var string 请求域名地址
     */
    private $baseUrl;

    /**
     * @var array 请求配置参数
     */
    private $options = [];

    public function setConnectTimeOut($seconds)
    {
        $this->options[RequestOptions::CONNECT_TIMEOUT] = $seconds;
    }

    public function getConnectTimeOut(): int
    {
        return $this->options[RequestOptions::CONNECT_TIMEOUT];
    }

    public function setTimeOut($seconds)
    {
        $this->options[RequestOptions::TIMEOUT] = $seconds;
    }

    public function getTimeOut(): int
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

    public function getHeaders(): string
    {
        return $this->options['headers'];
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function setQuery(array $query)
    {
        $this->options['query'] = $query;
    }

    public function getQuery(): array
    {
        return $this->options['query'];
    }

    public function setData(array $data)
    {
        $this->options['json'] = $data;
    }

    public function getData(): array
    {
        return $this->options['json'];
    }

    /**
     * 统一请求方法
     * User: ❤ CLANNAD ~ After Story By だんご
     * @param string $method
     * @param string $url
     * @return array
     * @throws InvalidHttpException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request(string $method, string $url): array
    {
        $this->options[RequestOptions::CONNECT_TIMEOUT] = $this->options[RequestOptions::CONNECT_TIMEOUT] ?? 5;
        $this->options[RequestOptions::TIMEOUT] = $this->options[RequestOptions::TIMEOUT] ?? 30;

        try{

            $response = $this->getHttpClient()->request($method, sprintf('%s%s',$this->getBaseUrl(), $url), $this->options);
            return $this->handlerResponse($response);

        }catch (\Exception $exception){

            if ($exception instanceof RequestException) {
                if ($exception->hasResponse()) {
                    return $this->handlerResponse($exception->getResponse());
                }
            }

            throw new InvalidHttpException($exception->getMessage());
        }
    }

    private function getHttpClient(): Client
    {
        return new Client();
    }

    /**
     * 处理返回结果
     * @param $response
     * @return array
     */
    private function handlerResponse($response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}