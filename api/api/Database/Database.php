<?php
include_once("BuildSQLQuery.php");
include_once("ModelFields.php");

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

  public function save($model) {

    if ($model->pk) {

      (new BuildSQLQuery)->update($model::$tableName)->set(ModelFields::getFields($model))->execute();

    } else {

      print_r((new BuildSQLQuery)->insert($model::$tableName, ModelFields::getFields($model))->execute());

    }

  }

}

?>
