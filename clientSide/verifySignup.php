<?php

include('httpful.phar');
include('crypt/crypt.php');


if($_POST['iduser'] != null && $_POST['email'] != null && $_POST['password'] != null)
{

        //$body = json_encode($_POST);

        //$url = "http://localhost/eventSys/login";

        //$response = \Httpful\Request::put($url)->sendsJson()->body($body)->send();

        //$array = json_decode($response->body, true);

        //if($array['body']=='bool(true) ')
        //{
            //$crypted = generateHash($_POST['password']);

            //$_POST['password'] = $crypted;

        $url = "http://localhost/eventSys/user";

        $body = json_encode($_POST);

        $response = \Httpful\Request::post($url)->sendsJson()->body($body)->send();

        //var_dump($response);

        $array = json_decode($response->body, true);
    //}

        header('Location: login.php');

}
else
    {
        header('Location: 500.html');
    }


?>