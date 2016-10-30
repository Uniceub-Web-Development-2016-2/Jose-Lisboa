<?php

include('request.php');

$rm = $_SERVER['REQUEST_METHOD'];
$sp = substr($_SERVER['SERVER_PROTOCOL'], 0,-4);
$sa = $_SERVER['SERVER_ADDR'];
$ra = $_SERVER['REMOTE_ADDR'];
$ru = substr($_SERVER['REQUEST_URI'], 1, 5);
$qs = $_SERVER['QUERY_STRING'];

$request = new Request($rm, $sp, $sa, $ra, $ru, $qs);
var_dump($request);
