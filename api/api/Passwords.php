<?php

class Passwords {

  public static function getHashedPassword($password) {

    return password_hash($password, PASSWORD_ARGON2I);

  }

}

?>
