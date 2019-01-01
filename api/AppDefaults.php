<?php
include_once("Config.php");

class AppDefaults {

  public static function getAppConfig() {

    return new Config([

      "underDevelopment" => true,
      "underDevelopmentController" => UnderDevelopmentController::class,
      "notFoundController" => NotFoundController::class,
      "preparedRoutes" => [

        "" => HomeController::class,
        "something" => SomethingController::class,
        "something/test" => TestController::class

      ]

    ]);

  }

}

?>
