<?php

include('httpful.phar');
include('crypt/crypt.php');

if(!isset($_SESSION))
    {
        session_start();
    }

if($_POST["email"] != null && $_POST["password"] != null)
{
	//$crypted = generateHash($_POST["password"]);
	//$_POST["password"] = $crypted;

	$login_array = array('email' => $_POST["email"], 'password' =>$_POST["password"]);
	$body = json_encode($login_array);

	$url = "http://localhost/eventSys/login";
	$response = \Httpful\Request::post($url)->sendsJson()->body($body)->send();

	$array = json_decode($response->body, true)[0];

	//var_dump(verifyHash($crypted, $array['password']));
	//die();

		if(!empty($array) && $array["email"] == $_POST["email"] && $array['password'] == $_POST['password'])
		{
			$_SESSION['iduser'] = $array['iduser'];
			$_SESSION['firstname'] = $array['firstname'];
			$_SESSION['lastname'] = $array['lastname'];
			$_SESSION['usertype'] = $array['usertype'];

			header("Location: home.php");
		}
		else
		{
		//header("Location: login.php");

			echo('<script type="text/javascript">
				alert("Wrong email/password! Try again");
				window.location.href ="login.php";
				</script>');
		}
}

?>

