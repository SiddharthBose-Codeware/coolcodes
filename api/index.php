<?php
include_once("App.php");
include_once("allclasses.php");
include_once("AppDefaults.php");

$app = new App(AppDefaults::getAppConfig());

$app->init();
$app->execute();

?>
