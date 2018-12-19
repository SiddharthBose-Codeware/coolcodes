<?php
include_once("Config.php");

class AppDefaults {

  public static function getAppConfig() {

    return new Config([

      "underDevelopment" => false,
      "underDevelopmentController" => new UnderDevelopmentController,
      "notFoundController" => new NotFoundController,
      "defaultRouteName" => "default",
      "preparedRoutedTree" => [

        "default" => new HomeController,

        "something" => [

          "default" => new SomethingController,

          "test" => new TestController

        ]

      ]

    ]);

  }

}

?>
