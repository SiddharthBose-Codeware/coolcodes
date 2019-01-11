<?php

class App {

  private $controller;

  private $appConfig;

  private $facade;

  function __construct($appConfig) {

    $this->appConfig = $appConfig;

    $this->facade = new Facade($this->appConfig);

  }

  public function init() {

    $routes = new Routes($this->appConfig);

    if ($this->appConfig->isUnderDevelopment()) {

      $underDevelopementController = $routes->getUnderDevelopmentController();

      $this->controller = new $underDevelopementController;

    } else {

      $path = str_replace("/coolcodes/api/", "", explode("?", $_SERVER['REQUEST_URI'])[0]);

      if ($_SERVER['REQUEST_URI']{strlen($_SERVER['REQUEST_URI']) - 1} == "/") {

        $path = substr($path, 0, (strlen($path) - 1));

      }

      $headers = $this->appConfig->getAdditionalHeaders();

      foreach ($headers as $headerType => $headerValue) {

        header($headerType.": ".$headerValue);

      }

      $this->controller = $routes->getController($path);


    }

  }

  public function execute() {

    if ($this->controller->canExecuteRequest($_SERVER['REQUEST_METHOD'])) {

      $response = $this->controller->execute($this->facade);

      $response->showResponse();

    } else {

      // MAYBEMORECODE: Add a controller for the 400 Bad Request Response.

      http_response_code(400);

    }

  }


}

?>
