<?php

include_once("api/Facade/FacadeSegment.php");

class Auth extends FacadeSegment {

  public function authenticate($credentials) {

    $primaryCredential = $credentials[$this->appConfig->getAuthPrimaryCredential()];

    $password = $credentials[$this->appConfig->getAuthPassword()];

    print_r($this->appConfig);

    // TODO: Do some actual auth

  }

}

?>
