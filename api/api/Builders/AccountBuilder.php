<?php

class AccountBuilder extends AbstractBuilder {

  function setPK($pk) {

    $this->instance->pk = $pk;

    return $this;

  }

  public function setFirstName($firstName) {

    $this->instance->setFirstName($firstName);

    return $this;

  }

  public function setLastName($lastName) {

    $this->instance->setLastName($lastName);

    return $this;

  }

  public function setUsername($username) {

    $this->instance->setUsername($username);

    return $this;

  }

  public function setEmail($email) {

    $this->instance->setEmail($email);

    return $this;

  }

  public function setPassword($password) {

    $this->instance->setPassword($password);

    return $this;

  }


}
