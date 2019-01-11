<?php

class AppDefaults {

  public static function getAppConfig() {

    return new Config([

      "underDevelopment" => false,
      "underDevelopmentController" => UnderDevelopmentController::class,
      "notFoundController" => NotFoundController::class,
      "preparedRoutes" => [

        "" => HomeController::class,
        "login" => LoginController::class,
        "login/refresh" => RefreshTokenController::class,
        "something" => SomethingController::class,
        "something/test" => TestController::class

      ],

      "additionalHeaders" => [

        "Access-Control-Allow-Origin" => "*"

      ],

      "auth" => [

        "primaryCredential" => "email",
        "password" => "password",
        "authModel" => AccountModel::class,
        "jwtSecret" => "UVc0Z1NWWWdhWE1nWjJWdVpYS",
        "jwtEncryptAlgo" => "AES-256-CBC",
        "jwtEncryptionInitVector" => "2x6SUhOMElHSmxJS",
        "jwtAccessTokenExpiration" => 3600, // 1 hour
        "jwtRefreshTokenExpiration" => 86400 // 1 day

      ]

    ]);

  }

}

?>
