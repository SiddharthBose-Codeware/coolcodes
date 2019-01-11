<?php

abstract class AbstractModel {

  public $id;

  public static $tableName;

  public function getPK() {

    return $this->id;

  }

  abstract function getFields();

}

?>
