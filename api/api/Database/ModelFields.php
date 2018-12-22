<?php
include_once("../Builders/allmodelbuilders.php");

class ModelFields {

  public static function getFields($model) {

    switch ($model::$modelBuilder) {

      case AccountModelBuilder::class:

      return [

        "firstName" => $model->firstName,
        "lastName" => $model->lastName,
        "username" => $model->username,
        "email" => $model->email,
        "password" => $model->password

      ];

      default:

    }

  }

}

?>
