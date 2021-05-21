<?php


namespace AliyunAcm\Configuration;

//use GuzzleHttp\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        !$pimple->offsetExists('configuration') && $pimple->offsetSet('configuration', function ($pimple) {
            return (new Client($pimple))->setBaseUri($pimple->config->get('http')['base_uri'] ?? '');
        });
    }
}
