<?php


namespace AliyunAcm\Tests\Unit;

use AliyunAcm\Application;
use AliyunAcm\Factory;
use AliyunAcm\Kernel\Config;
use AliyunAcm\Tests\TestCase;

class FactoryTest extends TestCase
{
    public function testStaticCall()
    {
        $app = Factory::make([
            'base_uri' => 'https://acm.aliyun.com',
            'access_key' => 1,
            'secret_key' => 1,
        ]);

        $this->assertInstanceOf(Application::class, $app);
    }
}
