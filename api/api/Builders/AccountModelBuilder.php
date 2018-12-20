<?php
include_once("AbstractModelBuilder.php");
include_once("../Mappers/AccountMapper.php");

class AccountModelBuilder extends AbstractModelBuilder {

  public function build($fields) {

    return (new AccountMapper($fields))->map();

  }

}

?>
