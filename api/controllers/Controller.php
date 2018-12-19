<?php

abstract class Controller {

  public function execute() {}

  function canExecuteRequest($type) {

    return true;

  }

}

?>
