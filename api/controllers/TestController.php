<?php
include_once("PostController.php");

class TestController extends PostController {

  public function execute() {

    echo "<h1>Welcome to Test! Please go to Something or I will eat your account.</h1>";

  }

}

?>
