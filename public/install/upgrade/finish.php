<?php
error_reporting(0);
if (!isset($_SESSION)) session_start();

if ($_SESSION['upgrade_step'] < 4) {
    header("Location: /install/upgrade/database.php");
    exit();
}


unset($_SESSION['upgrade_step']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Upgraded Successfully</title>
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
        RSS Auto Pilot
    </div>
</div>
<div class="visible-xs logo-sm">
    <img style="width:50px;" src="/install/style/images/logo-sm.png">
</div>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <ul class="list-group">
                <li class="list-group-item"><i class="fa fa-smile-o"></i> Welcome</li>
                <li class="list-group-item"><i class="fa fa-cogs"></i> Server Requirements</li>
                <li class="list-group-item"><i class="fa fa-user"></i> Admin Verification</li>
                <li class="list-group-item"><i class="fa fa-list-alt"></i> Upgrade Database</li>
                <li class="list-group-item active"><i class="fa fa-thumbs-up"></i> Finish</li>
            </ul>
            <div class="hidden-xs hidden-sm">
                <center>All Rights Reserved <a href="http://www.kodeinfo.com">KodeInfo.com</a></center>
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
                    <h1 class="done">Successfully Upgraded</h1>

                    <p> You are ready to go <i class="fa fa-smile-o"></i></p>

                    <div class="">
                        Don't forget to leave <a href="http://codecanyon.net/user/kodeinfo">Feedback and Rate This
                            Script</a>.
                    </div>
                    <br/>

                    <div style="color:red;">
                        Please Remember to Delete <strong>/public/install/upgrade</strong> Directory From Script.
                    </div>
                    <br/>

                    <p>
                        <a href="/login?setup=true" class="btn btn-primary btn-lg" role="button">Click here to finish upgrade</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>