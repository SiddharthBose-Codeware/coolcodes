<?php

abstract class AbstractMapper {

  protected $mappingData;

  function __construct($mappingData) {

    $this->mappingData = $mappingData;

  }

  abstract public function getObject();

}

?>
