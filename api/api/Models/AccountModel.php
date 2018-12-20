<?php
include_once("../Passwords.php");

class AccountModel extends AbstractModel {

  private $firstName;

  private $lastName;

  private $username;

  private $email;

  private $password;

  public function setFirstName($firstName) {

    $this->firstName = $firstName;

  }

  public function setLastName($lastName) {

    $this->lastName = $lastName;

  }

  public function setUsername($username) {

    $this->username = $username;

  }

  public function setEmail($email) {

    $this->email = $email;

  }

  public function setPassword($password) {

    $hashedPassword = Passwords::getHashedPassword($password);

    $this->password = $hashedPassword;

  }

}

?>
