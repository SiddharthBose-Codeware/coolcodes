<?php

class CreateAccountController extends APIController {

  protected static $canExecuteMethods = ["POST"];

  public function execute($facade) {

    if (!$this->isRequiredParamtersGiven(['firstName', 'lastName', 'username', 'email', 'password'])) {

      // TODO: Return a JSONResponse with some text like more keys required.

      return new JSONResponse([

        "description" => $facade->apiStrings->getAPIString('missing_account_creation_details')

      ]);

    }

    $alreadyExsistingAccounts = Database::getDatabase()->get(AccountModel::class, ["username" => $_POST['username']]);

    if (!empty($alreadyExsistingAccounts)) {

      return new JSONResponse([

        "description" => $facade->apiStrings->getAPIString('account_with_username_already_exsits', $_POST['username'])

      ]);

    }



    $accountBuilder =
    (new AccountBuilder)
    ->setFirstName($_POST['firstName'])
    ->setLastName($_POST['lastName'])
    ->setUsername($_POST['username'])
    ->setEmail($_POST['email'])
    ->setPassword($_POST['password']);

    $account = $accountBuilder->getInstance();

    Database::getDatabase()->save($account);

    return new JSONResponse([

      "description" => $facade->apiStrings->getAPIString('account_created', $_POST['username'])

    ]);

  }

}

?>
