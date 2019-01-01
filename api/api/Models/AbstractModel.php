<?php

abstract class AbstractModel {

  public $pk;

  public static $tableName;

  abstract function getFields();

}

?>
