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

    if (!isset($this->configItems["additionalHeaders"])) {

      return [];

    }

    return $this->configItems["additionalHeaders"];

  }

  public function getAuthPrimaryCredential() {

    return $this->configItems["auth"]["primaryCredential"];

  }

  public function getAuthPassword() {

    return $this->configItems["auth"]["password"];

  }

}

?>
