<?php

include('httpful.phar');
include('crypt/crypt.php');

session_start();

if($_POST["email"] != null && $_POST["password"] != null)
{
	$login_array = array('email' => $_POST["email"], 'password' =>$_POST["password"]);
	$crypted = generateHash($_POST["password"]);
	$_POST["password"] = $crypted;

	$url = "http://localhost/eventSys/login";

	$body = json_encode($login_array);

	$response = \Httpful\Request::post($url)->sendsJson()->body($body)->send();

	$array = json_decode($response->body, true)[0];


	if(!empty($array) && $array["email"] == $_POST["email"] && $array["password"] == $array["password"])
	{
		$_SESSION['iduser'] = $_POST['iduser'];
		$_SESSION['firstname'] = $_POST['firstname'];
		$_SESSION['usertype'] = $_POST['usertype'];
		header("Location: home.html");
	}
	else
	{
		echo '<script language="javascript">';
		echo 'alert("Wrong email/password!")';
		echo '</script>';
		//header("Location: login.html");
	}
}


?>

