<?php


namespace AliyunAcm\Tests\Unit;

use AliyunAcm\Application;
use AliyunAcm\Configuration\Client;
use AliyunAcm\Kernel\Config;
use AliyunAcm\Tests\TestCase;
use \GuzzleHttp\Client as HttpClient;

class ApplicationTest extends TestCase
{
    public function testProperties()
    {
        $app = new Application();
        $this->assertInstanceOf(Client::class, $app->configuration);
        $this->assertInstanceOf(Config::class, $app->config);
        $this->assertInstanceOf(HttpClient::class, $app->http_client);
    }
}
