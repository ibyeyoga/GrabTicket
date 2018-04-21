<?php


class Loader
{
    private static $packageMap = [
        'yoga' => __DIR__
    ];

    public static function autoload($class){
        $filePath = self::findFile($class);
        if(file_exists($filePath)){
            self::requireFileOnce($filePath);
        }
    }

    private static function findFile($fullClassPath){
        try{
            $baseNamespace = substr($fullClassPath, 0, strpos($fullClassPath, '\\'));
            $basePath = self::$packageMap[$baseNamespace];
            $filePath = $basePath . substr($fullClassPath, strlen($baseNamespace)) . '.php';
            return $filePath;
        }
        catch (\Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

    private static function requireFileOnce($filePath){
        if(is_file($filePath)){
            require_once $filePath;
        }
    }
}

spl_autoload_register('Loader::autoload');