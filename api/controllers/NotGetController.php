<?php
include_once("Controller.php");

class NotGetController extends Controller {

  public function canExecuteRequest($type) {

    return $type != "GET";

  }

}

?>
