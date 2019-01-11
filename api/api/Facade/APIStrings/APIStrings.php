<?php

class APIStrings extends FacadeSegment {

  private function getAPIStrings() {

    return [

      "user_unauthorized" => "The password is invalid. Please try again.",

      "user_not_exists" => "No such user exsits by these credentials. Please try again.",

      "refresh_token_not_given" => "Refresh token not given.",

      "jwt_token_expired" => "The token given is expired.",

      "credentials_not_given" => "All credentials are not given."

    ];

  }

  public function getAPIString($name, $params = []) {

    $value = $this->getAPIStrings()[$name];

    return is_callable($value) ? $value->__invoke($params) : $value;

  }

}

?>
