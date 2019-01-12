<?php

class APIStrings extends FacadeSegment {

  private function getAPIStrings() {

    return [

      "user_unauthorized" => "The password is invalid. Please try again.",

      "user_not_exists" => "No such user exsits by these credentials. Please try again.",

      "refresh_token_not_given" => "Refresh token not given.",

      "jwt_token_expired" => "The token given is expired.",

      "credentials_not_given" => "All credentials are not given.",

      "missing_account_creation_details" => "Some of the account creation info is missing.",

      "account_with_username_already_exsits" => function($username) {

        return "An account already exsits with the username \"".$username."\".";

      },

      "account_created" => "Your account is successfully created."

    ];

  }

  public function getAPIString($name, $paramsOrValue = []) {

    $value = $this->getAPIStrings()[$name];

    return is_callable($value) ? $value->__invoke($paramsOrValue) : $value;

  }

}

?>
