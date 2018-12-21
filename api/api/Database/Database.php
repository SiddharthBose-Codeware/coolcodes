<?php
include_once("BuildSQLQuery.php");

class Database {

  public function getObjectsOf($modelClass, $filterBy = []) {

    $modelBuilders = (new BuildSQLQuery)->select("*")->from($modelClass::$tableName)->execute($modelClass::$modelBuilder);

    $modelObjects = [];

    foreach ($modelBuilders as $modelBuilder) {

      $modelObject = $modelBuilder->build();

      array_push($modelObjects, $modelObject);

    }

    return $modelObjects;

  }

}

?>
