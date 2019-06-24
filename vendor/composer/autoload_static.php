<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0e6afd7dc9a268cbc535f3277c807960
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Services\\' => 9,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Services\\' => 
        array (
            0 => __DIR__ . '/../..' . '/services',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'App\\common\\ClassParser' => __DIR__ . '/../..' . '/app/common/ClassParser.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0e6afd7dc9a268cbc535f3277c807960::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0e6afd7dc9a268cbc535f3277c807960::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0e6afd7dc9a268cbc535f3277c807960::$classMap;

        }, null, ClassLoader::class);
    }
}