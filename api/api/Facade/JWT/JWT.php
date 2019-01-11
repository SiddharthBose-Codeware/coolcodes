<?php

class JWT extends FacadeSegment {

  const ACCESS_TOKEN = 0;

  const REFRESH_TOKEN = 1;

  public function generateJWT($type, $options) {

    // TODO: change the dummy info to usable ones

    $headerEncoded = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode("{\"alg\": \"HS256\",\"typ\": \"JWT\"}"));

    $time = time();

    $payloadEncoded = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode([

      "sub" => $options["userId"],
      "iat" => $time,
      "exp" => $time + $this->getExpirationTime($type),
      "token_type" => "bearer"

    ])));

    $signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(hash_hmac("sha256", $headerEncoded.".".$payloadEncoded, $this->appConfig->getAuthJWTSecret(), true)));

    $jwtToken = $headerEncoded.".".$payloadEncoded.".".$signature;

    if ($type == self::REFRESH_TOKEN) {

      return openssl_encrypt($jwtToken, $this->appConfig->getAuthJWTEncryptAlgo(), $this->appConfig->getAuthJWTSecret(), 0, $this->appConfig->getAuthJWTEncryptionInitVector());

    }

    return $jwtToken;

  }

  private function getExpirationTime($type) {

    switch ($type) {

      case self::ACCESS_TOKEN:

      return $this->appConfig->getAuthAcessTokenExpiration();

      case self::REFRESH_TOKEN:

      return $this->appConfig->getAuthRefreshTokenExpiration();

      default:

      return 0;

    }

  }

  public function getDecryptedToken($jwtToken) {

    return openssl_decrypt($jwtToken, $this->appConfig->getAuthJWTEncryptAlgo(), $this->appConfig->getAuthJWTSecret(), 0, $this->appConfig->getAuthJWTEncryptionInitVector());

  }

  public function getTokenDetails($token, $isEncrypted = false) {

    if ($isEncrypted) {

      $token = $this->getDecryptedToken($token);

    }

    $jwtParts = explode(".", $token);

    $header = base64_decode($jwtParts[0]);

    $payload = base64_decode($jwtParts[1]);

    return [

      "header" => json_decode($header),

      "payload" => json_decode($payload)

    ];

  }

  public function isTokenExpired($token, $isEncrypted = false) {

    if ($isEncrypted) {

      $token = $this->getDecryptedToken($token);

    }

    $tokenDetails = $this->getTokenDetails($token);

    return ($tokenDetails["payload"]->exp > time());

  }

  public function getAccessTokenOnRefresh($refreshToken, $isEncrypted = false) {

    $tokenDetails = $this->getTokenDetails($refreshToken, $isEncrypted);

    return $this->generateJWT(self::ACCESS_TOKEN, [

      "userId" => $tokenDetails["payload"]->sub

    ]);

  }

}

// echo (new JWT("a"))->generateJWT();

?>
