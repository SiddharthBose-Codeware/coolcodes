<?php

class PDOInstance {

  private $instance;

  protected function __construct() {}

  function __destruct() {}

  public static function getPDOInstance() {

    if (!isset(self::$instance)) {

      $instance = new PDOInstance();

    }

    return $instance;

  }

  public function getConnection($address, $dbName, $username, $password) {

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

  public function __clone() {

    return false;

  }

  public function __wakeup() {

    return false;

  }

}

?>
