<?php
include_once("RoutesTree.php");
include_once("Config.php");

class App {

  private $controller;

  private $appConfig;

  function __construct($appConfig) {

    $this->appConfig = $appConfig;

  }

  public function init() {

    $routesTree = new RoutesTree($this->appConfig);

    if ($this->appConfig->isUnderDevelopment()) {

      $this->controller = $routesTree->getUnderDevelopmentController();

    } else {

      $pageURL = str_replace("/coolcodes/api/", "", $_SERVER['REQUEST_URI']);

      $path = explode("/", $pageURL);

      if ($_SERVER['REQUEST_URI']{strlen($_SERVER['REQUEST_URI']) - 1} == "/") {

        $path = array_slice($path, 0, count($path) - 1);

      }

      $this->controller = $routesTree->getController($path);


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
