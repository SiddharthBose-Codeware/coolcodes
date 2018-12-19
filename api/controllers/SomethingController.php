<?php
include_once("NotGetController.php");

class SomethingController extends NotGetController {

  public function execute() {

    echo "<h1>Welcome to Something! Please go to anything or I will delete your account.</h1>";

  }

}

?>
