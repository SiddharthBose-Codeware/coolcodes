<?php

class APIController extends PostController {

  public function isRequiredParamtersGiven($requiredParameters) {

    if (!is_array($requiredParameters)) {

      $requiredParameters = [$requiredParameters];

    }

    return !(array_diff_key(array_flip($requiredParameters), $_POST));

  }

}

?>
