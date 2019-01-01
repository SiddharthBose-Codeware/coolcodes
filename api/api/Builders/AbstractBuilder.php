<?php

abstract class AbstractBuilder {

  public static $tableName;

  private $instance;

  function __construct() {

    $this->instance = new AccountModel();

  }

  function getInstance() {

    return $this->instance;

  }

}

?>
