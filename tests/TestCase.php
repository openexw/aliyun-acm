<?php


namespace AliyunAcm\Tests;

use AliyunAcm\Kernel\ServiceContainer;
use \PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    public function mockApiClient($name, $methods = [], ServiceContainer $app = null): \Mockery\Mock
    {
        $methods = implode(',', array_merge([
            'httpGet', 'httpPost', 'httpPostJson', 'httpUpload',
            'request', 'requestRaw', 'requestArray', 'registerMiddlewares',
        ], (array) $methods));

        $client = \Mockery::mock(
            $name."[{$methods}]",
            [
                $app ?? \Mockery::mock(ServiceContainer::class),
                \Mockery::mock(AccessToken::class), ]
        )->shouldAllowMockingProtectedMethods();
//        $client->allows()->registerHttpMiddlewares()->andReturnNull();

        return $client;
    }
}
