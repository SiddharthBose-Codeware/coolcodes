<?php

class CreateAccountController extends APIController {

  public function execute($facade) {

    if (!$this->isRequiredParamtersGiven(['firstName', 'lastName', 'username', 'email', 'password'])) {

      // TODO: Return a JSONResponse with some text like more keys required.

      return;

    }

    $accountBuilder =
    (new AccountBuilder)
    ->setFirstName($_POST['firstName'])
    ->setLastName($_POST['lastName'])
    ->setUsername($_POST['username'])
    ->setEmail($_POST['email'])
    ->setPassword($_POST['password']);

    $acount = $accountBuilder->getInstance();

    Database::getDatabase()->save($account);

    return new JSONResponse([

      "description" => "Your account is successfully created."

    ]);

  }

}

?>
