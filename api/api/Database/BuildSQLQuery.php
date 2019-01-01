<?php
include_once("PDOInstance.php");

class BuildSQLQuery {

  private $isSelect;

  private $isWherePresent;

  private $tableName;

  private $whereClause;

  private $fieldsToSelect;

  private $bindMap;

  private $setData;

  private $insertData;

  function __construct($tableName = NULL) {

    if ($tableName) {

      $this->setTableName($tableName);

    }

    $this->bindMap = [];

  }

  private function getSelectQuery() {

    $toSelect = "*";

    if (is_array($this->fieldsToSelect)) {

      $toSelect = implode(", ", $this->fieldsToSelect);

    }

    return "SELECT ".$toSelect." FROM ".$this->tableName.($this->isWherePresent ? " WHERE ".$this->whereClause : "");

  }

  private function getInsertQuery($insertData) {

    $keys = "";
    $values = "";

    $keys = implode(", ", array_keys($insertData));

    $values = ":".implode(", :", array_keys($insertData));

    $this->bindMap = array_merge($this->bindMap, $insertData);

    return "INSERT INTO ".$this->tableName." (".$keys.") VALUES (".$values.")";

  }

  private function getUpdateQuery() {

    $setValues = [];

    foreach ($this->setData as $fieldName => $value) {

      array_push($setValues, ($fieldName."=:".$fieldName));

      $this->bindMap[":".$fieldName] = $value;

    }

    return "UPDATE ".$this->tableName." SET ".implode(", ", $setValues).
    ($this->isWherePresent ? " WHERE ".$this->whereClause : "");

  }

  private function getDeleteQuery() {

    return "DELETE FROM ".$this->tableName.
    ($this->isWherePresent ? " WHERE ".$this->whereClause : "");

  }

  public function setTableName($tableName) {

    $this->tableName = $tableName;

    return $this;

  }

  public function select($fieldsToSelect) {

    $this->isSelect = true;

    if (!is_array($fieldsToSelect)) {

      $fieldsToSelect = [$fieldsToSelect];

    }

    $this->fieldsToSelect = $fieldsToSelect;

    return $this;

  }

  public function where($left, $operator, $right) {

    if (!$this->isWherePresent) {

      $this->isWherePresent = true;

    }

    $this->whereClause .= ($left.$operator.":".$left)." ";

    $this->bindMap[":".$left] = $right;

    return $this;

  }

  public function insert($insertData) {

    $this->insertData = $insertData;

    return $this;

  }

  public function update($setData) {

    $this->setData = $setData;

    return $this;

  }

  public function delete() {

    return $this;

  }

  public function and() {

    $this->whereClause .= "AND ";

    return $this;

  }

  public function or() {

    $this->whereClause .= "OR ";

    return $this;

  }

  public function execute() {

    echo $this->getDeleteQuery();

    print_r($this->bindMap);

  }

}

// print_r((new BuildSQLQuery)->setTableName("accounts")->select(["email", "password"])->where("something", "=", "anything")->and()->where("madperson", "=", "programmer")->execute());

// print_r((new BuildSQLQuery)->setTableName("accounts")->insert([
//
//   "firstName" => "something",
//   "lastName" => "anything"
//
// ])->execute());

// print_r((new BuildSQLQuery)->setTableName("accounts")->update([
//
//   "firstName" => "something",
//   "lastName" => "anything"
//
// ])->where("email", "=", "a@b.com")
// ->and()
// ->where("password", "=", "somerandompassword")
// ->execute());

// print_r((new BuildSQLQuery)->setTableName("accounts")->delete()->where("id", "=", "somenumber")->execute());
