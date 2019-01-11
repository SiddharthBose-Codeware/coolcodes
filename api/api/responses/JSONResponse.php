<?php

class JSONResponse extends Response {

  public function showResponse() {

    header("Content-Type: application/json");

    http_response_code($this->responseCode);

    echo json_encode($this->data);

  }

}

?>
