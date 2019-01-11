<?php

abstract class FacadeSegment {

  protected $appConfig;

  function __construct($appConfig) {

    $this->appConfig = $appConfig;

  }

  // abstract function init();

}

?>
