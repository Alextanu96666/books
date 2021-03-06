<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd1e7bb4d83282f8cc74928c36f692190
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd1e7bb4d83282f8cc74928c36f692190::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd1e7bb4d83282f8cc74928c36f692190::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
