<?php

class NotFoundController extends APIController {

  public function execute($facade) {

    return JSONResponse([

      "error" => "This API view does not exist."

    ], 404);

  }

}

?>
