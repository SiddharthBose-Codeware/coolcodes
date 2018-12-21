<?php
include_once("AbstractModelBuilder.php");
include_once("../Mappers/AccountMapper.php");

class AccountModelBuilder extends AbstractModelBuilder {

  private $firstName;

  private $lastName;

  private $username;

  private $email;

  private $password;

  public function build() {

    return (new AccountMapper([

      "pk" => $this->id,

      "firstName" => $this->firstName,

      "lastName" => $this->lastName,

      "username" => $this->username,

      "email" => $this->email,

      "password" => $this->password

      ]))->getObject();

  }

}

?>
