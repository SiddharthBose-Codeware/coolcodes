<?php

class Auth extends FacadeSegment {

  const NO_USER_EXISTS = 0;

  const USER_AUTHORIZED = 2;

  const USER_UNAUTHORIZED = 1;

  private $primaryCredentialField;

  private $passwordField;

  private $authModel;

  private $jwt;

  public function __construct($appConfig, $jwt) {

    parent::__construct($appConfig);

    $this->primaryCredentialField = $this->appConfig->getAuthPrimaryCredential();

    $this->passwordField = $this->appConfig->getAuthPassword();

    $this->authModel = $this->appConfig->getAuthModel();

    $this->jwt = $jwt;

  }

  private function authorize($primaryCredential, $password) {

    $result = [];

    $dbResult = Database::getDatabase()->get(

      AccountModel::class,
      [$this->primaryCredentialField => $primaryCredential]

    );

    if (empty($dbResult)) {

      $result["status"] = self::NO_USER_EXISTS;

    } else {

      $user = $dbResult[0];

      if ($user->getPassword() == $password) { // TODO: Improve later

        $result["status"] = self::USER_AUTHORIZED;
        $result["id"] = $user->getPK();

      } else {

        $result["status"] = self::USER_UNAUTHORIZED;

      }

    }

    return $result;

  }

  public function login($primaryCredential, $password) {

    $loginResult = [];

    $authorizationResult = $this->authorize($primaryCredential, $password);

    if ($authorizationResult["status"] == self::USER_AUTHORIZED) {

      // TODO: Give the JWT token

      $options = [

        "userId" => $authorizationResult["id"]

      ];

      $accessToken = $this->jwt->generateJWT(JWT::ACCESS_TOKEN, $options);

      $refreshToken = $this->jwt->generateJWT(JWT::REFRESH_TOKEN, $options);

      $loginResult["isSuccessful"] = true;
      $loginResult["tokens"] = [

        "accessToken" => $accessToken,
        "refreshToken" => $refreshToken

      ];

    } else {

      $loginResult["isSuccessful"] = false;
      $loginResult["status"] = $authorizationResult["status"];

    }

    return $loginResult;

  }

  public function getPrimaryCredentialField() {

    return $this->primaryCredentialField;

  }

}

?>
