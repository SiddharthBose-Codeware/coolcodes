<?php

class BuildSQLQuery {

  private $isSelect;

  private $isInsert;

  private $isUpdate;

  private $isDelete;

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

    $this->isInsert = true;

    $this->insertData = $insertData;

    return $this;

  }

  public function update($setData) {

    $this->isUpdate = true;

    $this->setData = $setData;

    return $this;

  }

  public function delete() {

    $this->isDelete = true;

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

  public function build() {

    if ($this->isSelect) {

      return $this->getSelectQuery($this->fieldsToSelect);

    } else if ($this->isInsert) {

      return $this->getInsertQuery($this->insertData);

    } else if ($this->isUpdate) {

      return $this->getUpdateQuery($this->setData);

    } else if ($this->isDelete) {

      return $this->getDeleteQuery();

    }

    return "";

  }

  public function getBindValues() {

    return $this->bindMap;

  }

  public function isSelect() {

    return $this->isSelect;

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
