<?php

class HomeController extends GetController {

  public function execute($facade) {

    // TODO: Change the API response to a JSONResponse

    echo json_encode([

      "status" => "API is working somehow."

    ]);

  }

}

?>
