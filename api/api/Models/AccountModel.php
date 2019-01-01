<?php
include_once("AbstractModel.php");

class AccountModel extends AbstractModel {

  private $firstName;

  private $lastName;

  private $username;

  private $email;

  private $password;

  public function getFirstName() {

    return $this->firstName;

  }

  public function setFirstName($firstName) {

    $this->firstName = $firstName;

  }

  public function getLastName() {

    return $this->lastName;

  }

  public function setLastName($lastName) {

    $this->lastName = $lastName;

  }

  public function getUsername() {

    return $this->username;

  }

  public function setUsername($username) {

    $this->username = $username;

  }

  public function getEmail() {

    return $this->email;

  }

  public function setEmail($email) {

    $this->email = $email;

  }

  public function getPassword() {

    return $this->password;

  }

  public function setPassword($password) {

    $this->password = $password;

  }


}