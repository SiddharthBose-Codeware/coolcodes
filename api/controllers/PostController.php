<?php

class PostController extends Controller {

  public function canExecuteRequest($type) {

    return $type == "POST";

  }

}

?>
