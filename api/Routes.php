<?php
include_once("Config.php");

class Routes {

  private $routes;

  private $notFoundController;

  private $appConfig;

  function __construct($appConfig) {

    $this->appConfig = $appConfig;

    $this->initRoutes();

  }

  public function initRoutes() {

    $this->routes = $this->appConfig->getPreparedRoutes();

    $this->notFoundController = $this->appConfig->getNotFoundController();

  }

  public function getRoutes() {

    return $this->routes;

  }

  public function getUnderDevelopmentController() {

    return $this->appConfig->getUnderDevelopmentController();

  }

  public function getController(string $path) {

    if (array_key_exists($path, $this->routes)) {

      return (new $this->routes[$path]);

    } else {

      return (new $this->notFoundController);

    }

  }

}

?>
