<?php


namespace AliyunAcm\Tests\Unit\Configuration;

use AliyunAcm\Factory;
use AliyunAcm\Tests\TestCase;

class ClientTest extends TestCase
{
    private $conf = [
        'base_uri' => 'https://acm.aliyun.com',
        'access_key' => 1,
        'secret_key' => 1,
    ];

    private $app;

    public function __construct()
    {
        parent::__construct();
        $this->app = Factory::make($this->conf);
    }

    /**
     * @group configuration
     */
    public function testGetConfig()
    {
        $this->assertEquals('https://acm.aliyun.com', $this->app->config->get('base_uri'));
        $this->assertEquals(1, $this->app->config->get('access_key'));
        $this->assertEquals(1, $this->app->config->get('secret_key'));

    }

    /**
     * @group configuration
     */
    public function testGetAccessKey()
    {
        $this->assertEquals(1, $this->app->configuration->getSecretKey());
    }

    /**
     * @group configuration
     */
    public function testGetSecretKey()
    {
        $this->assertEquals(1, $this->app->configuration->getSecretKey());
    }
}
