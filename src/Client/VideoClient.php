<?php

namespace Ihome\WujieAi\Client;

use Ihome\WujieAi\Config\Config;

class VideoClient extends BaseClient implements ClientInterface
{
    public function __construct(Config $config)
    {
        parent::__construct($config);
    }

    /**
     * 发起AI视频生视频请求
     * @param array $data
     * @return array
     */
    public function create(array $data): array
    {
        return $this->post('/ai/video/create', $data);
    }

    /**
     * 视频生成成功后的视频详情查询
     * @param array $query
     * @return array
     */
    public function info(array $query): array
    {
        return $this->get('/ai/video/info', $query);
    }

    /**
     * 视频生成结果查询
     * @param array $data
     * @return array
     */
    public function generatingInfo(array $data): array
    {
        return $this->post('/ai/video/generating_info', $data);
    }

    /**
     * 获取视频生视频模型列表及价格表
     * @param array $data
     * @return array
     */
    public function optionMenu(array $query): array
    {
        return $this->get('/ai/video/option_menu', $query);
    }

    /**
     * 视频生视频模型排队情况查询
     * @param array $query
     * @return array
     */
    public function waitTime(array $query): array
    {
        return $this->get('/ai/video/wait_time', $query);
    }
}