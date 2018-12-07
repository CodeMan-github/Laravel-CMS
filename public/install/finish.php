<?php
error_reporting(0);
if (!isset($_SESSION)) session_start();

if ($_SESSION['install_step'] < 3) {
    header("Location: /install/database.php");
    exit();
}

unset($_SESSION['install_step']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Installation Success</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/install/style/css/bootstrap.min.css" rel="stylesheet">
    <link href="/install/style/css/style.css" rel="stylesheet">
    <script src="/install/style/js/bootstrap.min.js"></script>
</head>

<body>
<div class="hidden-xs">
    <div class="logo">
        <img style="width:100px;" src="/install/style/images/logo.png">
    </div>
    <div class="sub-logo">
        RSS Auto Pilot 1.0
    </div>
</div>
<div class="visible-xs logo-sm">
    <img style="width:50px;" src="style/images/logo-sm.png">
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <ul class="list-group">
                <li class="list-group-item"><i class="fa fa-smile-o"></i> Welcome</li>
                <li class="list-group-item"><i class="fa fa-cogs"></i> Server Requirements</li>
                <li class="list-group-item"><i class="fa fa-list-alt"></i> Database and Permissions</li>
                <li class="list-group-item active"><i class="fa fa-thumbs-up"></i> Finish</li>
            </ul>
            <div class="hidden-xs hidden-sm">
                <center>All Rights Reserved <a href="http://www.kodeinfo.com">KodeInfo.com</center>
                </a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><i class="fa fa-thumbs-up"></i> Done </strong>

                    <div class="pull-right"><span class="badge badge-warning">Finish</span>
                    </div>
                </div>
                <div class="panel-body">
                    <h1 class="done">Successfully Installed</h1>

                    <p> You are ready to go <i class="fa fa-smile-o"></i></p>

                    <div class="">
                        Don't forget to leave <a href="http://codecanyon.net/user/kodeinfo">Feedback and Rate This
                            Script</a>.
                    </div>
                    <br/>

                    <div style="color:red;">
                        Please Remember to Delete <strong>/public/install</strong> Directory From Script.
                    </div>

                    <h3>Admin Login</h3>

                    <p>Email : admin@mail.com</p>

                    <p>Password : admin</p>

                    <br/>

                    <p>
                        <a href="/login?setup=true" class="btn btn-primary btn-lg" role="button">Click here to finish setup</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>