<?php

abstract class Controller {

  public function execute($facade) {}

  function canExecuteRequest($type) {

    return true;

  }

}

?>
