<?php

class NotFoundController extends APIController {

  public function execute($facade) {

    return new JSONResponse([

      "error" => "This API view does not exist."

    ], 404);

  }

}

?>
