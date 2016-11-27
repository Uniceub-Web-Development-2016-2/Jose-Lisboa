<?php
include('httpful.phar');
if(!isset($_SESSION))
    {
        session_start();
    }

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

    function only_show_events()
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
                                                        <a href="login.php" class="action btn">More details...</a>
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

        echo '                  <div class="col-md-8">
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
                                                Observations: '.$value['observation'].'</br>
                                                <br>
                                            </div>
                                        </div>

                                            <div class="col-md-2">
                                                </div>
                                                    <div class="col-md-4">
                                                        <p class="left">
                                                            <a href="home.php" class="action btn">Return</a>
                                                        </p>
                                                        <p class="right">
                                                            <form method="post" action="subscription.php">
                                                            <input type="hidden" name="idevent" value='.$value['idevent'].'>
                                                                <button class="btn btn-lg btn-primary" type="submit">Subscribe!</button>
                                                            </form>
                                                        </p>
                                                    </div>
                                                <div class="col-md-2">
                                                </div>

                                    </div>';
            }
    }


    function return_spec_user($iduser)
    {
        $request = 'http://localhost/eventSys/user?iduser='.$iduser;
        $response = \Httpful\Request::get($request)->send();

        $array = json_decode($response->body, true);

        foreach ($array as $key => $value)
        {

            echo '
                    <form method="post" action="updateUser.php" class="form-horizontal">
                        <fieldset>

                        <legend>USER INFO</legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">* CPF</label>
                            <div class="col-md-4">
                            <input id="cpf" name="iduser" type="text" value="'.$value['iduser'].'" class="form-control input-md" readonly>
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">* First Name</label>
                            <div class="col-md-4">
                            <input id="firstname" name="firstname" type="text" value="'.$value['firstname'].'" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">* Last Name</label>
                            <div class="col-md-4">
                            <input id="lastname" name="lastname" type="text" value="'.$value['lastname'].'" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">* Email</label>
                            <div class="col-md-4">
                            <input id="email" name="email" type="text" value="'.$value['email'].'" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="password">* Password</label>
                            <div class="col-md-4">
                            <input id="password" name="password" type="password" placeholder="Enter a password" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Select Basic -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="blood_group">Gender</label>
                            <div class="col-md-2">
                            <input type="radio" name="gender" value="M" checked> Male<br>
                            <input type="radio" name="gender" value="F"> Female<br>
                            <input type="radio" name="gender" value="O"> Other
                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="contact">* Phone number</label>
                            <div class="col-md-4">
                            <input id="phonenumber" name="phonenumber" type="number" max="99999999999" value="'.$value['phonenumber'].'" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="contact">Phone number 2</label>
                            <div class="col-md-4">
                            <input id="phonenumber2" name="phonenumber2" type="number" max="99999999999" value="'.$value['phonenumber2'].'" class="form-control input-md">
                            <input type="hidden" name="usertype" value="G">
                            <input type="hidden" name="codaddress" value="'.$value['codaddress'].'">
                            <input type="hidden" name="usstatus" value="1">
                            </div>
                        </div>

                        <legend>ADDRESS INFO</legend>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cep">* CEP</label>
                            <div class="col-md-4">
                            <input name="cep" type="text" id="cep" value="'.$value['cep'].'" size="10" maxlength="9" onblur="pesquisacep(this.value);" class="form-control input-md"/>
                            <input type="hidden" name="idaddress" value="'.$value['idaddress'].'">
                            </div>
                            <span>Insert you CEP code and press TAB</span>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="logradouro">Street</label>
                            <div class="col-md-4">
                            <input name="logradouro" type="text" id="rua" class="form-control input-md" />

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="bairro">Neighborhood</label>
                            <div class="col-md-4">
                            <input name="bairro" type="text" id="bairro" class="form-control input-md"/>

                           </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-4 control-label" for="localidade">City</label>
                            <div class="col-md-4">
                            <input name="localidade" type="text" id="cidade" class="form-control input-md"/>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="uf">FU</label>
                            <div class="col-md-4">
                            <input name="uf" type="text" id="uf" class="form-control input-md"/>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="complemento">Complement</label>
                            <div class="col-md-4">
                            <input name="complemento" value="'.$value['complemento'].'" type="text" id="complemento" class="form-control input-md"/>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="numero">Number</label>
                            <div class="col-md-4">
                            <input name="numero" value="'.$value['numero'].'" type="number" id="numero" class="form-control input-md"/>

                            </div>
                        </div></br>

                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                        <p class="left">
                        <a href="home.php" class="action btn">Cancel</a>
                        </p>
                        <p class="right">
                            <button type="submit" class="btn btn-lg btn-success">Confirm</button>
                        </p>
                        </div>
                        <div class="col-md-4">
                        </div>
                            </fieldset>

                        </form>';
        }
    }

    function return_subscr_parameters($idevent)
    {
        $request = 'http://localhost/eventSys/event?idevent='.$idevent;

        $response = \Httpful\Request::get($request)->send();

        $array = json_decode($response->body, true);

        foreach ($array as $key => $value)
        {

            echo('<div class="col-md-8">
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
                                                Observations: '.$value['observation'].'</br>
                                                <br>
                                                User: </br>
                                                CPF: '.$_SESSION['iduser'].'</br>
                                                Name: '.$_SESSION['firstname'].' '.$_SESSION['lastname'].'</br>
                                            </div>
                                        </div>

                                            <div class="col-md-2">
                                                </div>
                                                    <div class="col-md-4">
                                                        <p class="left">
                                                            <a href="home.php" class="action btn">Cancel</a>
                                                        </p>
                                                        <p class="right">
                                                            <form method="post" action="insertSubsc.php">
                                                            <input type="hidden" name="codevent" value='.$value['idevent'].'>
                                                            <input type="hidden" name="coduser" value='.$_SESSION['iduser'].'>
                                                            <input type="hidden" name="subscriptiondate" value='.date('Y-m-d').'>
                                                            <input type="hidden" name="subscriptionstatus" value="1">
                                                            <input type="hidden" name="sustatus" value="1">
                                                            <button type="submit" class="btn btn-lg btn-success">Confirm</button>
                                                            </form>
                                                        </p>
                                                    </div>
                                                <div class="col-md-2">
                                                </div>

                                    </div>');

    }
}

function return_subscriptions($coduser)
{
        $request = 'http://localhost/eventSys/subscription?coduser='.$coduser;

        $response = \Httpful\Request::get($request)->send();

        $array = json_decode($response->body, true);

        foreach ($array as $key => $value)
        {
            echo('<div class="col-md-6">
                                        <div class="panel panel-default">
                                            <div class="bootstrap-admin-panel-content">
                                                <p><h2>'.$value['eventname'].'</h2></p>
                                                <p><h4>'.$value['eventtheme'].'</h4></p>
                                                User info:</br>
                                                <blockquote>
                                                    '.$value['firstname'].' '.$value['lastname'].'
                                                </blockquote>
                                                </br>
                                                Email: '.$value['email'].'</br>
                                                Phone number: '.$value['phonenumber'].'</br>
                                                </br>
                                                Subscription info:</br>
                                                Subscription date: '.$value['subscriptiondate'].'</br>
                                                Subscription status: '.verify_subsc_status($value['subscriptionstatus'], $value['idsubscription']).'
                                            </div>
                                        </div>
                                    </div>');
        }
}

function verify_subsc_status($subscstatus, $idsubscription)
{
    if($subscstatus==1)
    {
      return 'Subscribed</br>
      </br>
      <form method="post" action="cancelSubsc.php">
      <input type="hidden" name="idsubscription" value='.$idsubscription.'>
      <input type="hidden" name="subscriptionstatus" value="0">
      <button type="submit" class="btn btn-danger">Cancel subscription</button>
      </form>';
    }

    else
    {
        return 'Canceled</br>';
    }
}

?>