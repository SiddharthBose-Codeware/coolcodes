<?php

class RefreshTokenController extends APIController {

  public function execute($facade) {

    if ($this->isRequiredParamtersGiven('refreshToken')) {

      $refreshToken = $facade->jwt->getDecryptedToken($_POST['refreshToken']);

      if (!$facade->jwt->isTokenExpired($refreshToken)) {

        return new JSONResponse([

          "description" => $facade->apiStrings->getAPIString('jwt_token_expired')

        ]);

      }

      $accessToken = $facade->jwt->getAccessTokenOnRefresh($refreshToken);

      return new JSONResponse([

        "access_token" => $accessToken

      ]);

    } else {

      return new JSONResponse([

        "description" => $facade->apiStrings->getAPIString('refresh_token_not_given')

      ]);

    }

  }

}

?>
