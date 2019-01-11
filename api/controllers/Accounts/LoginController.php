<?php

class LoginController extends APIController {

  public function execute($facade) {

    $primaryCredentialField = $facade->auth->getPrimaryCredentialField();

    if (!$this->isRequiredParamtersGiven([$primaryCredentialField, 'password'])) {

      return new JSONResponse([

        "description" => $facade->apiStrings->getAPIString('credentials_not_given')

      ]);

    }

    $loginResult = $facade->auth->login($_POST[$primaryCredentialField], $_POST['password']);

    if ($loginResult["isSuccessful"]) {

      return new JSONResponse($loginResult["tokens"]);

    } else {

      if ($loginResult["status"] == Auth::USER_UNAUTHORIZED) {

        return new JSONResponse([

            "description" => $facade->apiStrings->getAPIString('user_unauthorized')

        ]);

      } else if ($loginResult["status"] == Auth::NO_USER_EXISTS) {

        return new JSONResponse([

            "description" => $facade->apiStrings->getAPIString('user_not_exists')

        ]);

      }

    }

  }

}

?>
