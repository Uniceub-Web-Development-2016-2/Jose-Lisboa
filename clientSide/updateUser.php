<?php

include('httpful.phar');

session_start();

if(!empty($_POST["iduser"]) && !empty($_POST["email"]) && !empty($_POST["password"]))
{

        $url = "http://localhost/eventSys/user";

        $body = json_encode($_POST);

        $response = \Httpful\Request::put($url)->sendsJson()->body($body)->send();

        $array = json_decode($response->body, true);

        $_SESSION['firstname'] = $_POST['firstname'];

        echo('<script type="text/javascript">
            alert("Data successfully updated!");
            window.location.href ="home.php";
            </script>');

}
else
    {
        header('Location: 500.html');
    }


?>