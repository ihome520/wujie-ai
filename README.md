<h1 align="center"> Wujie-Ai </h1>

<div style="text-align: center">
<span style="border-bottom:1px solid #b1bebf;"> 无界AI 文生图，图生图，视频生视频相关接口SDK扩展包</span>
</div>


### 安装

```shell
$ composer require ihome/wujie-ai -vvv
```

### 配置文件
* 建议在使用的框架中，如ThinkPHP、Laravel等对应的config目录下新增 wujie.php 内容如下：

```php
<?php

return [
    'app_id' => env('WUJIE_AI_APP_ID', ''),
    'private_key' => env('WUJIE_AI_PRIVATE_KEY', ''),
    'base_url' => env('WUJIE_AI_BASE_URL', ''),
];

?>
```
 * 在 `.env` 文件上，新增
```
WUJIE_AI_APP_ID=xxxxxxxxxxxx
WUJIE_AI_PRIVATE_KEY=xxxxxxxxxxxxx
WUJIE_AI_BASE_URL=https://www.abc.com # 注意地址不含最后的斜杠
```

### 如何使用
> 使用前，请向无界AI官方申请相关APPID 秘钥，这里假设你已经申请过了

```php
$config = [
    'appId' => config('wujie.app_id'),
    'privateKey' => config('wujie.private_key'),
    'baseUrl' => config('wujie.base_url'),
];

// 获取无界AI工厂实例
$wujie = WujieAiFactory::create($config);

// 获取数据 如果你使用了全局错误异常处理，此处可以不包 try-catch
try {
    // 文生图 & 图生图
    $result = $wujie->image->create([
                    'model_code' => 22,
                    'prompt' => '一个漂亮的年轻女孩，洛丽塔服装，长头发，瓜子脸，在原野上，手持法杖'
                ]); // 文生图，图生图根据官网参数传递
    $result = $wujie->image->baseModelInfos(); // 获取基础模型列表
    $result = $wujie->image->styleModelDefaultResource(); // 获取基础风格模型列表
    $result = $wujie->image->defaultResource(['model' => 22]); // 获取模型的预设资源
    $result = $wujie->image->priceInfos(['model' => 22,'uc_prompt' => '模糊，混乱', 'prompt' => '一个精致的现代风格女孩']); // 计算作画成本
    $result = $wujie->image->generatingInfo(['2C633CD85DW0D869AXSYYCDADE3CWXAA']);// 作画结果查询
    $result = $wujie->image->info(['key' => '2C633CD85DW0D869AXSYYCDADE3CWXAA']);// 作画成功后的图片详情查询
    
    // 视频生视频
    $result = $wujie->video->create([
                    'origin_video_url' => 'http://www.google.com/youtube/abc.mp4',
                    'video_duration' => 10,
                    'model_code' => 22,
              ]);  // 用视频生成另外一个风格的视频
    $result = $wujie->video->info(['key' => '2C633CD85DW0D869AXSYYCDADE3CWXAA']);// 视频生成成功后的视频详情查询
    $result = $wujie->image->generatingInfo(['2C633CD85DW0D869AXSYYCDADE3CWXAA']);// 视频生成结果查询
    $result = $wujie->video->optionMenu(); // 获取视频生视频模型列表及价格表
    $result = $wujie->video->waitTime(['modelCode' => 22]); // 视频生视频模型排队情况查询
    
    var_dump($result);
} catch (\Exception $e) {
    logger()->error('wujie', ['error' => $e->getMessage()]);
    // 其他业务逻辑处理
}
```

如有任何问题或者建议，欢迎在`Issues`中留言提出。。。

### License

MIT