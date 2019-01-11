<?php

class GetController extends Controller {

  public function canExecuteRequest($type) {

    return $type == "GET";

  }

}

?>
