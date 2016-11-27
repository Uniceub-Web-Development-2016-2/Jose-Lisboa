<?php

include('httpful.phar');

    $url = 'http://localhost/eventSys/subscription';

    $body = json_encode($_POST);

    $response = \Httpful\Request::delete($url)->sendsJson()->body($body)->send();

    $array = json_decode($response->body, true);

    echo('<script type="text/javascript">
                alert("Event subscription canceled.");
                window.location.href ="home.php";
                </script>');

?>