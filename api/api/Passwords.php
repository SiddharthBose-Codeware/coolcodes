<?php

class Passwords {

  public static function getHashedPassword($password) {

    return password_hash($password, PASSWORD_BCRYPT); // For now, later replace with PASSWORD_ARGON2I

  }

}

?>
