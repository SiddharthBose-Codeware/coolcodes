<?php
include_once("Routes.php");
include_once("Config.php");

class App {

  private $controller;

  private $appConfig;

  function __construct($appConfig) {

    $this->appConfig = $appConfig;

  }

  public function init() {

    $routes = new Routes($this->appConfig);

    if ($this->appConfig->isUnderDevelopment()) {

      $underDevelopementController = $routes->getUnderDevelopmentController();

      $this->controller = new $underDevelopementController;

    } else {

      $path = str_replace("/coolcodes/api/", "", $_SERVER['REQUEST_URI']);

      if ($_SERVER['REQUEST_URI']{strlen($_SERVER['REQUEST_URI']) - 1} == "/") {

        $path = substr($path, 0, (strlen($path) - 1));

      }

      $this->controller = $routes->getController($path);


    }

  }

  public function execute() {

    if ($this->controller->canExecuteRequest($_SERVER['REQUEST_METHOD'])) {

      $this->controller->execute();

    } else {

      // MAYBEMORECODE: Add a controller for the 400 Bad Request Response.

      http_response_code(400);

    }

  }


}
?>
