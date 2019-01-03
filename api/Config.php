<?php

class Config {

  private $configItems;

  function __construct($configItems) {

    $this->configItems = $configItems;

  }

  public function isUnderDevelopment() {

    return $this->configItems["underDevelopment"];

  }

  public function getUnderDevelopmentController() {

    return $this->configItems["underDevelopmentController"]; //new UnderDevelopmentController;

  }

  public function getNotFoundController() {

    return $this->configItems["notFoundController"]; // new NotFoundController;

  }

  public function getPreparedRoutes() {

    return $this->configItems["preparedRoutes"];

  }

  public function getAdditionalHeaders() {

    return $this->configItems["additionalHeaders"];

  }

}

?>
