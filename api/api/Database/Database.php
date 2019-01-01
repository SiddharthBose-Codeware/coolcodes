<?php
include_once("BuildSQLQuery.php");

class Database {

  private static $instance;

  private $pdo;

  protected function __construct($address, $dbName, $username, $password) {

    $this->pdo = $this->getConnection($address, $dbName, $username, $password);

  }

  function __destruct() {}

  private function getConnection($address, $dbName, $username, $password) {

    $connection = null;

    try {

      $connection = new PDO("mysql:host=".$address.";dbname=".$dbName, $username, $password);

      return $connection;

    } catch (PDOException $pdoException) {

      throw $pdoException;

    } catch (Exception $exception) {

      throw $exception;

    }

  }

  public static function getDatabase() {

    if (!self::$instance) {

      self::$instance = new Database("127.0.0.1", "coolcodes", "root", "");

    }

    return self::$instance;

  }

  private function executeQuery($queryBuilder) {

    try {

      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $result = $this->pdo->prepare($queryBuilder->build());

      $result->execute($queryBuilder->getBindValues());

      if ($queryBuilder->isSelect()) {

        return $result->fetchAll(PDO::FETCH_ASSOC);

      }

    }

    catch(PDOException $pdoException) {

        echo $pdoException->getMessage();

    }

    catch(Exception $exception) {

      echo $exception->getMessage();

    }

  }

  public function get($modelClass, $conditions, $toGet = "*") {

    $queryBuilder = ((new BuildSQLQuery($modelClass::$tableName))->select($toGet));

    foreach ($conditions as $conditionKey => $conditionValue) {

      $queryBuilder = $queryBuilder->where($conditionKey, "=", $conditionValue);

    }

    return $this->executeQuery($queryBuilder);

  }

  public function save($model) {

    if ($model->pk) {

      $this->executeQuery(

        (new BuildSQLQuery($model::$tableName))->update($model->getFields())

      );

    } else {

      $this->executeQuery(

        (new BuildSQLQuery($model::$tableName))->insert($model->getFields())

      );

    }

  }

  public function delete($model) {

    $this->executeQuery(

      (new BuildSQLQuery($model::$tableName))->where("id", "=", $model->pk)

    );

  }

  public function __clone() {

    return false;

  }

  public function __wakeup() {

    return false;

  }

}

// print_r(Database::getDatabase()->executeQuery((new BuildSQLQuery("accounts"))->insert([
//
//   "firstName" => "John",
//   "lastName" => "Doe",
//   "username" => "madprprogrammertryingtobeseriousbycrackingnonsensecodingjokesatcppcon",
//   "email" => "john@doe.io",
//   "password" => "iambetweenmadperson"
//
// ])));

// print_r(Database::getDatabase()->executeQuery((new BuildSQLQuery("accounts"))->select("*")));

// print_r(Database::getDatabase()->get(AccountModel::class, [
//
//   "firstName" => "John"
//
// ]));

?>
