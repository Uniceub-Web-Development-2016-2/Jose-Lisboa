<?php
include('httpful.phar');

    function resultado()
    {

        $url = 'http://localhost/eventSys/event';

        $response = \Httpful\Request::get($url)->send();

        $array = json_decode($response->body, true);

        //var_dump($array);

        /*foreach ($array as $key => $value)
        {
                echo  ($value['eventname'].' - '.$value.'</br>');
        }*/

    }

    function return_events()
    {
        $request = 'http://localhost/eventSys/event';
        $response = \Httpful\Request::get($request)->send();

        $array = json_decode($response->body, true);

        foreach ($array as $key => $value)
        {
            echo '<div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="bootstrap-admin-panel-content">
                                                <p><h2>'.$value['eventname'].'</h2></p>
                                                <blockquote>
                                                    '.$value['eventtheme'].'
                                                </blockquote>
                                                Start date: '.$value['startdate'].'</br>
                                                End date: '.$value['enddate'].'</br>
                                                Event location: '.$value['logradouro'].'</br>
                                                    '.$value['bairro'].'</br>
                                                    '.$value['localidade'].', '.$value['uf'].'</br>

                                                    <form method="post" action="event.php">
                                                    <input type="hidden" name="idevent" value="'.$value['idevent'].'"></br>
                                                        <button class="btn btn-lg btn-outline" type="submit">More details...</button>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>';
        }
    }


    function return_spec_event($idevent)
    {
        $request = 'http://localhost/eventSys/event?idevent='.$idevent;
        $response = \Httpful\Request::get($request)->send();

        $array = json_decode($response->body, true);

        foreach ($array as $key => $value)
        {

        echo '<div class="col-md-8">
                                        <div class="panel panel-default">
                                            <div class="bootstrap-admin-panel-content">
                                                <p><h2>'.$value['eventname'].'</h2></p>
                                                <blockquote>
                                                    '.$value['eventtheme'].'
                                                </blockquote>
                                                Start date: '.$value['startdate'].'</br>
                                                End date: '.$value['enddate'].'</br>
                                                Start time: '.$value['starttime'].'h</br>
                                                </br>
                                                Registration fee: R$ '.$value['registrationfee'].'</br>
                                                Subscribers limit: '.$value['subscriberslimit'].'</br>
                                                </br>
                                                Event location: </br> '.$value['logradouro'].'</br>
                                                    '.$value['bairro'].'</br>
                                                    '.$value['localidade'].', '.$value['uf'].'</br>
                                                </br>
                                                Event creator: '.$value['firstname'].' '.$value['lastname'].'</br>
                                                Contact:</br>
                                                    Email:'.$value['email'].'</br>
                                                    Phone number: '.$value['phonenumber'].'</br>
                                                    </br>
                                                Observations: '.$value['observation'].'

                                                    <form method="post" action="event.php">
                                                    <input type="hidden" name="idevent" value="'.$value['idevent'].'"></br>
                                                        <button class="btn btn-lg btn-primary" type="submit">Subscribe!</button>
                                                    </form>
                                                    <button class="btn btn-lg btn-link" value="index.php">Return</button>
                                            </div>
                                        </div>
                                    </div>';
            }
    }

?>