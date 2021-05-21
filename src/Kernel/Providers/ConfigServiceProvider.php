<?php


namespace AliyunAcm\Kernel\Providers;

use AliyunAcm\Kernel\Config;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ConfigServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        !isset($pimple['config']) && $pimple['config'] = function ($pimple) {
            return new Config($pimple->getConfig());
        };
    }
}
