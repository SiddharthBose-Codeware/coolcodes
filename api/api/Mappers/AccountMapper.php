<?php
include_once("AbstractMapper.php");
include_once("../Models/Accounts.php");

class AccountMapper extends AbstractMapper {

  public function map($mappingData) {

    $account = new Account();

    $account->firstName = $mappingData["firstName"];

    $account->lastName = $mappingData["lastName"];

    $account->username = $mappingData["username"];

    $account->email = $mappingData["email"];

    $account->password = $mappingData["password"];

    return $account;

  }

}

?>
