<?php

abstract class Response {

  public $responseCode;

  public $data;

  function __construct($data, $responseCode = 200) {

    $this->data = $data;

    $this->responseCode = $responseCode;

  }

  abstract public function showResponse();

}

?>
