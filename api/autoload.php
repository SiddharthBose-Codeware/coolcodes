<?php

class Autoloader {

  protected static $fileExtension = '.php';

  protected static $rootDirectory = __DIR__;

  protected static $fileIterator = null;

  public static function load($className) {

    $filename = $className.static::$fileExtension;

    $directoryIterator = new RecursiveDirectoryIterator(static::$rootDirectory, RecursiveDirectoryIterator::SKIP_DOTS);

    if (is_null(static::$fileIterator)) {

        static::$fileIterator = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::LEAVES_ONLY);

    }

    foreach (static::$fileIterator as $file) {

      if ($file->getFilename() == $filename) {

        if ($file->isReadable()) {

          include_once($file->getPathname());

        }

        break;

      }

    }

  }

}

spl_autoload_register("Autoloader::load");

?>
