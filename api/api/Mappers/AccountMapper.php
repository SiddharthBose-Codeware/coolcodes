<?php
include_once("AbstractMapper.php");
include_once("../Models/AccountModel.php");

class AccountMapper extends AbstractMapper {

  public function getObject() {

    $account = new AccountModel();

    $account->pk = $this->mappingData["pk"];

    $account->firstName = $this->mappingData["firstName"];

    $account->lastName = $this->mappingData["lastName"];

    $account->username = $this->mappingData["username"];

    $account->email = $this->mappingData["email"];

    $account->password = $this->mappingData["password"];

    return $account;

  }

}

?>
