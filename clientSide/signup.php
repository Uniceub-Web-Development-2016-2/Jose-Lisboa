<!DOCTYPE html>
<html>
    <head>
        <title>Sign up</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme.css">

        <!-- Adicionando Javascript -->

        <script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script><script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"/></script>
        <script type="text/javascript">$(document).ready(function(){    $("#cpf").mask("999.999.999-99");});</script>


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script type="text/javascript" src="js/html5shiv.js"></script>
            <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->
    </head>


    <body class="bootstrap-admin">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">


                      <form method="post" action="verifySignup.php" class="form-horizontal">
                        <div class="page-header">
                            <h1>Sign up</h1>
                        </div>
                        <fieldset>

                        <legend>USER INFO</legend>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">* CPF</label>
                            <div class="col-md-4">
                            <input id="cpf" name="iduser" type="text" placeholder="Enter CPF code" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">* First Name</label>
                            <div class="col-md-4">
                            <input id="firstname" name="firstname" type="text" placeholder="Enter first name" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">* Last Name</label>
                            <div class="col-md-4">
                            <input id="lastname" name="lastname" type="text" placeholder="Enter last name" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="email">* Email</label>
                            <div class="col-md-4">
                            <input id="email" name="email" type="text" placeholder="Enter email address" class="form-control input-md" required="">

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
                            <input id="phonenumber" name="phonenumber" type="number" max="99999999999" placeholder="Enter phone number" class="form-control input-md" required="">

                            </div>
                        </div>

                        <!-- Text input-->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="contact">Phone number 2</label>
                            <div class="col-md-4">
                            <input id="phonenumber2" name="phonenumber2" type="number" max="99999999999" placeholder="Enter phone number" class="form-control input-md">
                            <input type="hidden" name="usertype" value="G">
                            <input type="hidden" name="codaddress" value="">
                            <input type="hidden" name="usstatus" value="1">
                            </div>
                        </div>

                        <legend>ADDRESS INFO</legend>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cep">* CEP</label>
                            <div class="col-md-4">
                            <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);" class="form-control input-md"/>

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
                            <input name="complemento" type="text" id="complemento" class="form-control input-md"/>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="numero">Number</label>
                            <div class="col-md-4">
                            <input name="numero" type="number" id="numero" class="form-control input-md"/>

                            </div>
                        </div></br>

                        <div align="center">
                            <button type="submit" class="btn btn-lg btn-success">Sign up</button>
                        </div>
                            </fieldset>
                        </form>

                    </div>
                </div>
            </div>


            <!-- footer -->
            <div class="navbar navbar-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <footer role="contentinfo">
                                <p class="left">EventSys</p>
                                <p class="right">&copy; 2016 </p>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>

</html>

            <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
            <script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"/>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <script type="text/javascript" src="js/cepscript.js" ></script>
            </script>
    </body>
