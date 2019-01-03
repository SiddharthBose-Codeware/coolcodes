<?php
include_once("GetController.php");

class HomeController extends GetController {

  public function execute($facade) {

    echo "<h1>Welcome to home. This is home. The home. Something but not anything but home. Home. Home. Home. Home</h1>";

    $facade->auth->authenticate([

      "email" => "a@b.com",
      "password" => "somerandompassword"

    ]);

  }

}

?>
