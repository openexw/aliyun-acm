<?php
/*
 * This file is part of the openexw/aliyun-acm.
 *
 * (c) openexw <openexw@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace AliyunAcm;

/**
 * Class Factory
 * @package AliyunAcm
 *
 */
class Factory
{

    /**
     * @param array $config
     * @return Application
     */
    public static function make(array $config)
    {
        return new Application($config);
    }

//    /**
//     * Dynamically pass methods to the application.
//     *
//     * @param string $name
//     * @param array $arguments
//     *
//     * @return mixed
//     */
//    public static function __callStatic($arguments)
//    {
//        return self::make($app, ...$arguments);
//    }
}
