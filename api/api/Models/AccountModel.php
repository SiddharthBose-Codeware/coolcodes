<?php
include_once("AbstractModel.php");
include_once("../Passwords.php");
include_once("../Builders/AccountModelBuilder.php");
include_once("../Database/Database.php");

class AccountModel extends AbstractModel {

  public $firstName;

  public $lastName;

  public $username;

  public $email;

  public $password;

  public static $modelBuilder = AccountModelBuilder::class;

  public static $tableName = "accounts";

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
