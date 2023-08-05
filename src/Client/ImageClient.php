<?php

namespace Ihome\WujieAi\Client;

use Ihome\WujieAi\Config\Config;

class ImageClient extends BaseClient implements ClientInterface
{
    public function __construct(Config $config)
    {
        parent::__construct($config);
    }

    /**
     * 发起AI作画请求
     * @param array $daat
     * @return array
     */
    public function create(array $daat = []): array
    {
        return $this->post('/ai/create', $daat);
    }

    /**
     * 获取基础模型列表
     * @param array $query
     * @return array
     */
    public function baseModelInfos(array $query = []): array
    {
        return $this->get('/ai/model_base_infos', $query);
    }

    /**
     * 获取模型的预设资源
     * @param array $query
     * @return array
     */
    public function defaultResource(array $query = []): array
    {
        return $this->get('/ai/default_resource', $query);
    }

    /**
     * 获取风格模型的预设资源
     * @param array $query
     * @return array
     */
    public function styleModelDefaultResource(array $query = []): array
    {
        return $this->get('/ai/default_resource_style_model', $query);
    }

    /**
     * 计算作画成本
     * @param array $data
     * @return array
     */
    public function priceInfos(array $data = []): array
    {
        return $this->post('/ai/price_info', $data);
    }

    /**
     * 作画结果查询
     * @param array $data
     * @return array
     */
    public function generatingInfo(array $data = []): array
    {
        return $this->post('/ai/generating_info', $data);
    }

    /**
     * 作画成功后的图片详情查询
     * @param array $query
     * @return array
     */
    public function info(array $query = []): array
    {
        return $this->get('/ai/info', $query);
    }
}