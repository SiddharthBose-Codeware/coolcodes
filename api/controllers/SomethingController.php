<?php
include_once("PostController.php");

class SomethingController extends PostController {

  public function execute() {

    echo "<h1>Welcome to Something! Please go to anything or I will delete your account.</h1>";

  }

}

?>
