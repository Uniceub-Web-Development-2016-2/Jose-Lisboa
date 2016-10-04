<?php
include('request_controller.php');

$controller = new RequestController();

//var_dump($controller->execute());

//echo json_encode($controller->execute());

echo $controller->execute();

