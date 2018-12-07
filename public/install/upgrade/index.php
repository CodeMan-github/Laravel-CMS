<?php
error_reporting(0);
if (!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>RSS Auto Pilot - 1.0</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/install/style/images/favicon.png">
    <link href="/install/style/css/bootstrap.min.css" rel="stylesheet">
    <link href="/install/style/css/style.css" rel="stylesheet">
    <script src="/install/style/js/bootstrap.js"></script>
</head>

<body>
<div class="hidden-xs">
    <div class="logo">
        <img style="width:100px;" src="/install/style/images/logo.png">
    </div>
    <div class="sub-logo">
        RSS Auto Pilot - 1.0
    </div>
</div>
<div class="visible-xs logo-sm">
    <img style="width:50px;" src="/install/style/images/logo-sm.png">
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Thank you for Purchasing <a href="http://www.codecanyon.com/user/kodeinfo">KodeInfo's</a>
                        Product</strong>

                    <div class="pull-right">
                        <span class="badge badge-warning">Begin</span>
                    </div>
                </div>
                <div class="panel-body">
                    <h1>RSS Auto Pilot Upgrade Wizard</h1>
                    <h4>Upgrade Wizard</h4>
                    <br/>

                    <p>Welcome to Installation Wizard, RSS Aggregator is a RSS Feed Content Site Builder and Blogging
                        System to Create and Manage Money Making website or you can even use it as your Personal Google
                        RSS Reader with your favorite blog/rss feed collections. It is the only aggregator with all in
                        one features and every day development . For any problem during installation <a
                            href="http://www.codecanyon.net/user/kodeinfo">Contact Our Support</a>.</p>
                    <br>

                    <p>
                        <a href="/install/upgrade/requirements.php?<?php echo(time()); ?>" class="btn btn-info btn-lg"
                           role="button">Upgrade</a>
                    </p>

                </div>
                <div class="hidden-xs hidden-sm">
                    <center>All Rights Reserved <a href="http://www.kodeinfo.com">
                            KodeInfo.com</center>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>