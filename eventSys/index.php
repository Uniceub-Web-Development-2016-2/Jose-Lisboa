<?php

include('../eventSys/control/request_controller.php');
include('../eventSys/view/index.html');


$controller = new RequestController();

echo $controller->execute();
