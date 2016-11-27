<?php

include('httpful.phar');

if(!empty($_POST))
{
    $url = 'http://localhost/eventSys/subscription';

    $body = json_encode($_POST);

    $response = \Httpful\Request::post($url)->sendsJson()->body($body)->send();

    $array = json_decode($response->body, true);

    echo('<script type="text/javascript">
                alert("Successfully subscribed!");
                window.location.href ="home.php";
                </script>');
}
else
{
    header('Location: 500.html');
}



?>