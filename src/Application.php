<?php


namespace AliyunAcm;

use AliyunAcm\Configuration\Client;
use AliyunAcm\Configuration\ServiceProvider;
use AliyunAcm\Kernel\ServiceContainer;

/**
 * Class Application
 * @package AliyunAcm`
 * @property Client $configuration
 */
class Application extends ServiceContainer
{
    public $providers = [
        ServiceProvider::class
    ];

    public $defaultConfig = [
        'http' => [
            'base_uri' => 'https://acm.aliyun.com',
            'timeout' => 2.0
        ],
        // Endpoint list
        'acm_endpoint_list' => [
            'https://acm.aliyun.com',
            'https://addr-hz-internal.edas.aliyun.com',
            'https://addr-qd-internal.edas.aliyun.com',
            'https://addr-sh-internal.edas.aliyun.com',
            'https://addr-bj-internal.edas.aliyun.com',
            'https://addr-sz-internal.edas.aliyun.com',
            'https://addr-hk-internal.edas.aliyuncs.com',
            'https://addr-singapore-internal.edas.aliyun.com',
            'https://addr-ap-southeast-2-internal.edas.aliyun.com',
            'https://addr-us-west-1-internal.acm.aliyun.com',
            'https://addr-us-east-1-internal.acm.aliyun.com',
            'https://addr-cn-shanghai-finance-1-internal.edas.aliyun.com',
        ]
    ];
}