<?php

namespace Ihome\WujieAi\Client;

use Ihome\WujieAi\Config\Config;
use Ihome\WujieAi\Exceptions\InvalidRequestMethodException;
use Ihome\WujieAi\Traits\HasHttpRequest;

/**
 * Class BaseClient
 * @package Ihome\WujieAi\Client
 * @method get($url, $data = [], $query = [], $headers = [])
 * @method post($url, $data = [], $query = [], $headers = [])
 * @method put($url, $data = [], $query = [], $headers = [])
 * @method delete($url, $data = [], $query = [], $headers = [])
 */
class BaseClient
{
    use HasHttpRequest;

    /**
     * @var Config
     */
    protected $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * 动态调用请求方法
     * @param $method
     * @param $args
     * @return array
     * @throws InvalidRequestMethodException
     */
    public function __call($method, $args): array
    {
        $httpMethods = ['get', 'post', 'put', 'delete'];

        if (in_array($method, $httpMethods)) {
            $url = $args[0];
            $queryData = $args[1] ?? [];
            $headers = $args[2] ?? [];

            $method == 'get' || $method == 'delete' ? $this->setQuery($queryData) : $this->setData($queryData);

            $this->setBaseUrl($this->getBaseUrl());
            $this->setHeaders($this->headerHandler($url, $headers, $method));

            return $this->request(strtoupper($method), $url);
        } else {
            throw new InvalidRequestMethodException("The {$method} method is not exists.");
        }
    }

    /**
     * 获取请求URL
     * @return mixed|string
     */
    private function getBaseUrl(): string
    {
        return $this->config->getUrl();
    }

    /**
     * 获取签名
     * User: ❤ CLANNAD ~ After Story By だんご
     * @return array
     */
    private function getSign(): array
    {
        $str = chunk_split($this->config->getPrivateKey(), 64, "\n");
        $privateKeyString = "-----BEGIN RSA PRIVATE KEY-----\n$str-----END RSA PRIVATE KEY-----\n";

        $appid = $this->config->getAppId();
        $timestamp = time();  // 当前时间戳

        // 生成签名原文
        $originalData = array(
            "appId" => $appid,
            "timestamp" => $timestamp
        );

        $signature = $this->_sign($originalData, $privateKeyString);

        // 需要添加签名到请求头部中
        return [
            "Authorization" => json_encode([
                "secretKeyVersion" => $this->config->getVersion(),
                "appId" => $appid,
                "sign" => $signature,
                "original" => json_encode($originalData, JSON_UNESCAPED_UNICODE)
            ], JSON_UNESCAPED_UNICODE)
        ];
    }

    /**
     * 处理请求头部
     * @param $url
     * @param $headers
     * @param $method
     * @return array
     */
    private function headerHandler($url, $headers, $method): array
    {
        if ( ! in_array(ltrim($url, '/'), $this->getOpenUrl())) {
            $signature = $this->getSign();
            $headers = array_merge($headers, $signature);
        }

        if ($method == 'post' && ! isset($headers['Content-Type'])){
            $headers['Content-Type'] = 'application/json'; // 默认请求头部
        }

        return $headers;
    }

    /**
     * 开放接口集 不需要鉴权的域名
     * @return array
     */
    private function getOpenUrl(): array
    {
        return [
            '/ai/models'
        ];
    }

    /**
     * 生成签名
     * @param array $originalData
     * @param string $privateKeyString
     * @return string
     */
    private function _sign(array $originalData, string $privateKeyString): string
    {
        ksort($originalData);  // 按照字母顺序排序
        $originalText = json_encode($originalData, JSON_UNESCAPED_UNICODE);

        $privateKey = openssl_pkey_get_private($privateKeyString);
        openssl_sign($originalText, $signature, $privateKey, OPENSSL_ALGO_SHA256);

        return base64_encode($signature);
    }
}