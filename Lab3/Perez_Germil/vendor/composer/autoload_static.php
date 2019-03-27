<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit62e67b747f446bbf5d0428924c369033
{
    public static $classMap = array (
        'DataStorage' => __DIR__ . '/../..' . '/data/DataStorage.php',
        'IndexController' => __DIR__ . '/../..' . '/controllers/IndexController.php',
        'TemplateManager' => __DIR__ . '/../..' . '/templates/TemplateManager.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit62e67b747f446bbf5d0428924c369033::$classMap;

        }, null, ClassLoader::class);
    }
}
