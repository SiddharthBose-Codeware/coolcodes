<?php

class HTTPResponse extends Response {

  public function showResponse() {

    http_response_code($this->responseCode);

    if (is_array($this->data)) {

      print_r($this->data);

    } else {

      echo $this->data;

    }

  }

}

?>
