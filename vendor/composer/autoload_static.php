<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit98414211d0ae2cea7bd98c4b21d9f32f
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\Models\\' => 11,
            'App\\Inc\\' => 8,
            'App\\Controllers\\' => 16,
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/models',
        ),
        'App\\Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/includes',
        ),
        'App\\Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/controllers',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit98414211d0ae2cea7bd98c4b21d9f32f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit98414211d0ae2cea7bd98c4b21d9f32f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}