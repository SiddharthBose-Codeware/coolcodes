<?php

include_once("autoload.php");

include_once(__DIR__."/App.php");
include_once(__DIR__."/allclasses.php");
include_once(__DIR__."/AppDefaults.php");

$app = new App(AppDefaults::getAppConfig());

$app->init();
$app->execute();

?>
