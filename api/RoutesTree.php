<?php
include_once("Config.php");

class RoutesTree {

  private $routesTree;

  private $notFoundController;

  private $appConfig;

  function __construct($appConfig) {

    $this->appConfig = $appConfig;

    $this->initRoutesTree();

  }

  public function initRoutesTree() {

    $this->routesTree = $this->appConfig->getPreparedRoutesTree();

    $this->notFoundController = $this->appConfig->getNotFoundController();

  }

  public function getRoutesTree() {

    return $this->routesTree;

  }

  public function getUnderDevelopmentController() {

    return $this->appConfig->getUnderDevelopmentController();

  }

  public function getController($path) {

    $route = $this->routesTree;

    foreach ($path as $pathSegments) {

      if (array_key_exists($pathSegments, $route)) {

          $route = $route[$pathSegments];

      } else {

        return $this->notFoundController;

      }

    }

    if (is_array($route)) {

      return $route[$this->appConfig->getDefaultRouteName()];

    }

    return $route;

  }

}

?>
