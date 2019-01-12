<?php

abstract class Controller {

  protected static $canExecuteMethods = [];

  abstract public function execute($facade);

  public function canExecuteRequest($type) {

    return empty(static::$canExecuteMethods) ? true : in_array($type, static::$canExecuteMethods);

  }

}

?>
