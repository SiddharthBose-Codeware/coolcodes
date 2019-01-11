<?php

abstract class AbstractBuilder {

  public static $tableName;

  protected $instance;

  function __construct() {

    $this->instance = new AccountModel();

  }

  function getInstance() {

    return $this->instance;

  }

}

?>
