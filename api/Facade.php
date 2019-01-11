<?php

class Facade {

  public $auth;

  public $apiStrings;

  public $jwt;

  function __construct($appConfig) {

    $this->jwt = new JWT($appConfig);

    $this->auth = new Auth($appConfig, $this->jwt);

    $this->apiStrings = new APIStrings($appConfig);

  }

}

?>
