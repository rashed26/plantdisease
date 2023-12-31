<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb86c24e5056258de5f260bca15849659
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb86c24e5056258de5f260bca15849659::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb86c24e5056258de5f260bca15849659::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb86c24e5056258de5f260bca15849659::$classMap;

        }, null, ClassLoader::class);
    }
}
