<?php

namespace App;


class Autoload
{
    const CLASSES = [
        'post' => 'App\Configurations\PostConfigurationImpl',
        'customer' => 'App\Configurations\CustomerConfigurationImpl',
        'hobbie' => 'App\Configurations\HobbieConfigurationImpl',
        'customerhobbie' => 'App\Configurations\CustomerhobbieConfigurationImpl',
    ];
    const NAMESPACE = 'App\\';
    const ROUTE = 'app/';
    /**
     * @return array
     */
    public static function getClasses()
    {
        return self::CLASSES;
    }
    public static function getClass($resource){
        return self::CLASSES[$resource];
    }
}
