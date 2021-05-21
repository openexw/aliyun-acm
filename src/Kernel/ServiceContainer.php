<?php


namespace AliyunAcm\Kernel;

use AliyunAcm\Kernel\Providers\ConfigServiceProvider;
use AliyunAcm\Kernel\Providers\HttpClientServiceProvider;
use AliyunAcm\Kernel\Providers\LogServiceProvider;
use GuzzleHttp\Client;
use Pimple\Container;

/**
 * Class ServiceContainer
 * @package AliyunAcm\Kernel
 *
 * @property Config $config
 * @property Client $http_client
 */
class ServiceContainer extends Container
{
    /**
     * @var array
     */
    protected $providers = [];

    /**
     * @var array
     */
    protected $defaultProviders = [
        ConfigServiceProvider::class,
        LogServiceProvider::class,
        HttpClientServiceProvider::class
    ];

    /**
     * @var array
     */
    protected $defaultConfig = [];

    /**
     * @var array
     */
    protected $userConfig = [];

    /**
     * @return array
     */
    public function getProviders(): array
    {
        return array_merge($this->defaultProviders, $this->providers);
    }

    public function __construct(array $config = [], array $prepends = [])
    {
        parent::__construct($prepends);

        $this->userConfig = $config;

        $this->registerProviders($this->getProviders());
    }

    public function getConfig(): array
    {
        return array_merge($this->defaultConfig, $this->userConfig);
    }

    public function registerProviders(array $providers)
    {
        foreach ($providers as $provider) {
            parent::register(new $provider());
        }
    }

    public function __get($id)
    {
//        echo __METHOD__, $id, "-----------";
//        var_dump(__METHOD__, $id);
        return $this->offsetGet($id);
    }

    public function __set($id, $val)
    {
//        var_dump(__METHOD__, $id);
        $this->offsetSet($id, $val);
    }
}
