<?php

include_once("api/Facade/Auth/Auth.php");

class Facade {

  public $auth;

  function __construct($appConfig) {

    $this->auth = new Auth($appConfig);

  }

}

?>
