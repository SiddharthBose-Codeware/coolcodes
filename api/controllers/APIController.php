<?php

abstract class APIController extends Controller {

  public function isRequiredParamtersGiven($requiredParameters) {

    if (!is_array($requiredParameters)) {

      $requiredParameters = [$requiredParameters];

    }

    if (in_array($_SERVER['REQUEST_METHOD'], array('PUT', 'PATCH', 'POST'))) {

      parse_str(file_get_contents("php://input"), $data);

      return !(array_diff_key(array_flip($requiredParameters), $data));

    }

    return !(array_diff_key(array_flip($requiredParameters), $_GET));

  }

}

?>
