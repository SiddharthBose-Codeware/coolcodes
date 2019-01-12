<?php

class HomeController extends APIController {

  public function execute($facade) {

    // TODO: Change the API response to a JSONResponse

    return new JSONResponse([

      "status" => "API is working somehow."

    ]);

  }

}

?>
