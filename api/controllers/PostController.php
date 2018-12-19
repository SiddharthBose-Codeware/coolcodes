<?php
include_once("Controller.php");

class PostController extends Controller {

  public function canExecuteRequest($type) {

    return $type != "GET";

  }

}

?>
