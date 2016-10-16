<?php

include('../eventSys/control/request_controller.php');
include('../eventSys/view/index.html');


$controller = new RequestController();

//var_dump($controller->execute());

//echo json_encode($controller->execute());

echo $controller->execute();


