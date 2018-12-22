<?php
include_once("PDOInstance.php");

class BuildSQLQuery {

  private $finalSQLString;

  private $isSelect;

  private $pdo;

  private $params;

  function __construct() {

    $this->pdo = PDOInstance::getPDOInstance()->getConnection("127.0.0.1", "coolcodes", "root", "");

    $this->params = [];

  }

  public function select($subject) {

    $this->isSelect = true;

    $this->finalSQLString .= "SELECT ".$subject." ";

    return $this;

  }

  public function update($table) {

    $this->finalSQLString .= "UPDATE ".$table." ";

    return $this;

  }

  public function set($pairs) {

    $this->finalSQLString .= "SET ";

    foreach($pairs as $key => $value) {

      $this->finalSQLString .= $key."=:".$key.", ";

    }

    $this->finalSQLString = substr($this->finalSQLString, 0, strlen($this->finalSQLString) - 2);

    $this->params[":".$field] = $value;

    return $this;

  }

  public function insert($table, $pairs) {

    $this->finalSQLString .= "INSERT INTO ".$table." ";

    $keys = "";
    $values = "";

    foreach($pairs as $key => $value) {

      $keys .= $key.", ";

      $values .= ":".$key.", ";

      $this->params[":".$key] = $value;

    }

    $this->finalSQLString .= "(".substr($keys, 0, strlen($keys) - 2).") VALUES (".substr($values, 0, strlen($values) - 2).")";

    return $this;

  }

  public function delete() {

    $this->finalSQLString .= "DELETE ";

    return $this;

  }

  public function from($table) {

    $this->finalSQLString .= "FROM ".$table." ";

    return $this;

  }

  public function where() {

    $this->finalSQLString .= "WHERE ";

    return $this;

  }

  public function equals($firstParam, $secondParam) {

    $this->finalSQLString .= $firstParam."=:".$firstParam." ";

    $this->params[":".$firstParam] = $secondParam;

    return $this;

  }

  public function add() {

    $this->finalSQLString .= "ADD ";

    return $this;

  }

  public function or() {

    $this->finalSQLString .= "OR ";

    return $this;

  }

  public function execute($builder = null) {

    $result = $this->pdo->prepare($this->finalSQLString);

    $result->execute($this->params);

    if ($this->isSelect) {

      return $result->fetchAll(PDO::FETCH_CLASS, $builder);

    }

  }

}

?>
