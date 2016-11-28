<?php

include('httpful.phar');

        $url = 'http://localhost/eventSys/user';

        $body = json_encode($_POST);

        $response = \Httpful\Request::delete($url)->sendsJson()->body($body)->send();

        $array = json_decode($response->body, true);

        echo('<script type="text/javascript">
            alert("Profile inactivated");
            window.location.href ="logout.php";
            </script>');
?>