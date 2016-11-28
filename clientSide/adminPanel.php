<?php
    session_start();
    include('selection.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin panel - EventSys</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap Docs -->
        <link href="http://getbootstrap.com/docs-assets/css/docs.css" rel="stylesheet" media="screen">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme-change-size.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="bootstrap-admin-with-small-navbar">
        <!-- small navbar -->
        <nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar-sm" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav navbar-left bootstrap-admin-theme-change-size">
                                <li class="text">Change size:</li>
                                <li><a class="size-changer small">Small</a></li>
                                <li><a class="size-changer large active">Large</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li>
                                    <a href="#">Reminders <i class="glyphicon glyphicon-bell"></i></a>
                                </li>
                                <li>
                                    <a href="#">Settings <i class="glyphicon glyphicon-cog"></i></a>
                                </li>
                                <li>
                                    <a href="#">Go to frontend <i class="glyphicon glyphicon-share-alt"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" role="button" class="dropdown-toggle" data-hover="dropdown"> <i class="glyphicon glyphicon-user"></i> User options <i class="caret"></i></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="profile.php">My profile</a></li>
                                        <li><a href="delProfile.php">Inactivate profile</a></li>
                                        <li role="presentation" class="divider"></li>
                                        <li><a href="index.html">Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- main / large navbar -->
        <nav class="navbar navbar-default navbar-fixed-top bootstrap-admin-navbar bootstrap-admin-navbar-under-small" role="navigation">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".main-navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="adminPanel.php">EventSys</a>
                        </div>
                        <div class="collapse navbar-collapse main-navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-hover="dropdown">Options <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation" class="dropdown-header">Menu options</li>
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li role="presentation" class="divider"></li>
                                        <li role="presentation" class="dropdown-header">Dropdown header</li>
                                        <li><a href="#">Separated link</a></li>
                                        <li><a href="#">One more separated link</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div>
                </div>
            </div><!-- /.container -->
        </nav>

        <div class="container">
            <!-- left, vertical navbar & content -->
            <div class="row">
                <!-- left, vertical navbar -->
                <div class="col-md-2 bootstrap-admin-col-left">
                    <ul class="nav navbar-collapse collapse bootstrap-admin-navbar-side">
                        <li class="active">
                            <a href="#"><i class="glyphicon glyphicon-chevron-right"></i> Menu</a>
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-chevron-down"></i> Users</a>
                            <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                                <li><a href="501.html"><i class="glyphicon glyphicon-chevron-right"></i> All users</a></li>
                                <li><a href="signup.php"><i class="glyphicon glyphicon-chevron-right"></i> Create user</a></li>
                                <li><a href="profile.php"><i class="glyphicon glyphicon-chevron-right"></i> Update users</a></li>
                                <li><a href="501.html"><i class="glyphicon glyphicon-chevron-right"></i> Delete users</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="glyphicon glyphicon-chevron-down"></i> Events</a>
                            <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                                <li><a href="501.html"><i class="glyphicon glyphicon-chevron-right"></i>All events</a></li>
                                <li><a href="501.html"><i class="glyphicon glyphicon-chevron-right"></i> Create event</a></li>
                                <li><a href="501.html"><i class="glyphicon glyphicon-chevron-right"></i> Update events</a></li>
                                <li><a href="501.html"><i class="glyphicon glyphicon-chevron-right"></i> Delete events</a></li>
                            </ul>
                            <li>
                            <a href="#"><i class="glyphicon glyphicon-chevron-down"></i> Subscriptions</a>
                            <ul class="nav navbar-collapse bootstrap-admin-navbar-side">
                                <li><a href="501.html"><i class="glyphicon glyphicon-chevron-right"></i>All subscriptions</a></li>
                                <li><a href="501.html"><i class="glyphicon glyphicon-chevron-right"></i> Subscribe user</a></li>
                                <li><a href="501.html"><i class="glyphicon glyphicon-chevron-right"></i> Update subscription</a></li>
                                <li><a href="501.html"><i class="glyphicon glyphicon-chevron-right"></i> Cancel subscription</a></li>
                            </ul>
                        </li>
                        <a href="501.html"><i class="glyphicon glyphicon-chevron-side"></i> Payment</a>
                        </li>
                    </ul>
                </div>

                <!-- content -->
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="page-header bootstrap-admin-content-title">
                                <h1>EventSys Admin Panel</h1>
                                    <p class="pull-right">
                                    Welcome,
                                    <?php
                                        echo($_SESSION['firstname']);
                                    ?>
                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Details</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <p>EventSys is a software developed to manage academic events with simplicity, mobility and efficiency. Our intent is to deliver the best experience and facilities when joining...</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Sponsors</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <ul>
                                        <li>
                                            <a href="https://getbootstrap.com">Bootstrap</a>
                                        </li>
                                        <li>
                                            <a href="https://github.com/">Github</a>
                                        </li>
                                        <li>
                                            <a href="https://www.uniceub.br">UniCEUB</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Nothing here</div>
                                </div>

                                    <?php
                                        //resultado();
                                    ?>

                            </div>
                        </div>
                    </div>
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

        <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
    </body>
</html>
