<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit76dcacd62b1f9cc044e9e8d8a6dd7187
{
    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'Zend\\Validator\\' => 15,
            'Zend\\Stdlib\\' => 12,
            'Zend\\Escaper\\' => 13,
        ),
        'S' => 
        array (
            'Symfony\\Component\\Process\\' => 26,
        ),
        'P' => 
        array (
            'PhpOffice\\PhpWord\\' => 18,
            'PhpOffice\\Common\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Zend\\Validator\\' => 
        array (
            0 => __DIR__ . '/..' . '/zendframework/zend-validator/src',
        ),
        'Zend\\Stdlib\\' => 
        array (
            0 => __DIR__ . '/..' . '/zendframework/zend-stdlib/src',
        ),
        'Zend\\Escaper\\' => 
        array (
            0 => __DIR__ . '/..' . '/zendframework/zend-escaper/src',
        ),
        'Symfony\\Component\\Process\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/process',
        ),
        'PhpOffice\\PhpWord\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/phpword/src/PhpWord',
        ),
        'PhpOffice\\Common\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/common/src/Common',
        ),
    );

    public static $prefixesPsr0 = array (
        'P' => 
        array (
            'PHPExcel' => 
            array (
                0 => __DIR__ . '/..' . '/phpoffice/phpexcel/Classes',
            ),
        ),
        'K' => 
        array (
            'Knp\\Snappy' => 
            array (
                0 => __DIR__ . '/..' . '/knplabs/knp-snappy/src',
            ),
        ),
    );

    public static $classMap = array (
        'PclZip' => __DIR__ . '/..' . '/pclzip/pclzip/pclzip.lib.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit76dcacd62b1f9cc044e9e8d8a6dd7187::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit76dcacd62b1f9cc044e9e8d8a6dd7187::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit76dcacd62b1f9cc044e9e8d8a6dd7187::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit76dcacd62b1f9cc044e9e8d8a6dd7187::$classMap;

        }, null, ClassLoader::class);
    }
}