<?php
error_reporting(0);
if (!isset($_SESSION)) session_start();

$error = false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Server Requirements - Installation Wizard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/install/style/images/favicon.png">
    <link href="/install/style/css/bootstrap.min.css" rel="stylesheet">
    <link href="/install/style/css/style.css" rel="stylesheet">
</head>

<body>
<div class="hidden-xs">
    <div class="logo">
        <img style="width:100px;" src="/install/style/images/logo.png">
    </div>
    <div class="sub-logo">
        RSS Auto Pilot Upgrade Wizard
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
                <li class="list-group-item active"><i class="fa fa-cogs"></i> Server Requirements</li>
                <li class="list-group-item"><i class="fa fa-user"></i> Admin Verification</li>
                <li class="list-group-item"><i class="fa fa-list-alt"></i> Upgrade Database</li>
                <li class="list-group-item"><i class="fa fa-thumbs-up"></i> Finish</li>
            </ul>
            <div class="hidden-xs hidden-sm">
                <center>All Rights Reserved <a href="http://www.kodeinfo.com">
                        KodeInfo.com</center>
                </a>
            </div>
        </div>

        <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong><i class="fa fa-cogs"></i> Server Requirements</strong>

                    <div class="pull-right">
                        <span class="badge badge-warning">Step 1</span>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class='alert alert'><strong>Operating System</strong></div>
                        </div>
                        <div class="col-md-6">
                            <?php if (DIRECTORY_SEPARATOR == '/') {

                                echo "<div class='alert alert-success'>Linux OS</span></div>";

                            } else {

                                if (DIRECTORY_SEPARATOR == '\\') {

                                    //$error = true;

                                    echo "<div class='alert alert-danger'>Not Linux (If Windows you will need to create virtual host manually contact support on skype : kodeinfo)</div>";


                                }

                            }
                            ?>
                        </div>
                        <div class="col-md-4">
                            <div class='alert alert'><strong>Web Server</strong></div>
                        </div>
                        <div class="col-md-6">
                            <?php $s = $_SERVER['SERVER_SOFTWARE'];

                            $s1 = substr($s, 0, 6);

                            if ($s1 == "Apache") {

                                echo "<div class='alert alert-success'>Apache</div>";

                            } else {

                                $error = true;

                                echo "<div class='alert alert-danger'>Not Apache</div>";

                            }
                            ?>
                        </div>
                        <div class="col-md-4">
                            <div class='alert alert'><strong>PHP Version</strong></div>
                        </div>
                        <div class="col-md-6">
                            <?php $s = phpversion();
                            if ($s >= 5.5) {

                                echo "<div class='alert alert-success'>" . phpversion() . "</div>";
                            } else {

                                $error = true;

                                echo "<div class='alert alert-danger'>Below 5.5</div>";
                            }
                            ?>
                        </div>
                        <div class="col-md-4">
                            <div class='alert alert'><strong>PHP PDO Library</strong></div>
                        </div>
                        <div class="col-md-6">
                            <?php if (extension_loaded('pdo_mysql') && class_exists('PDO')) {

                                echo "<div class='alert alert-success'>Installed</div>";

                            } else {

                                $error = true;

                                echo "<div class='alert alert-danger'>Not Installed</div>";

                            }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <div class='alert alert'><strong>PHP Openssl Library</strong></div>
                        </div>
                        <div class="col-md-6">
                            <?php if (extension_loaded('openssl')) {

                                echo "<div class='alert alert-success'>Installed</div>";

                            } else {

                                $error = true;

                                echo "<div class='alert alert-danger'>Not Installed</div>";

                            }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <div class='alert alert'><strong>PHP Mbstring Library</strong></div>
                        </div>
                        <div class="col-md-6">
                            <?php if (extension_loaded('mbstring')) {

                                echo "<div class='alert alert-success'>Installed</div>";

                            } else {

                                $error = true;

                                echo "<div class='alert alert-danger'>Not Installed</div>";

                            }
                            ?>
                        </div>


                        <div class="col-md-4">
                            <div class='alert alert'><strong>PHP CURL</strong></div>
                        </div>
                        <div class="col-md-6">
                            <?php function _is_curl_installed()
                            {

                                if (in_array('curl', get_loaded_extensions())) {

                                    return true;

                                } else {

                                    return false;

                                }

                            }

                            if (_is_curl_installed()) {

                                echo "<div class='alert alert-success'>Installed</div>";

                            } else {

                                $error = true;

                                echo "<div class='alert alert-danger'>Not Installed</div>";

                            }
                            ?>
                        </div>

                        <div class="col-md-4">
                            <div class='alert alert'><strong>PHP SimpleXML</strong></div>
                        </div>
                        <div class="col-md-6">
                            <?php function _is_simplexml_installed()
                            {

                                if (extension_loaded('simplexml')) {

                                    return true;

                                } else {

                                    return false;

                                }

                            }

                            if (_is_simplexml_installed()) {

                                echo "<div class='alert alert-success'>Installed</div>";

                            } else {

                                $error = true;

                                echo "<div class='alert alert-danger'>Not Installed</div>";

                            }
                            ?>
                        </div>
                        <div class="col-md-4"></div>
                        <?php if ($error) {
                            echo('<div class="col-md-6">');

                            echo('<div class="alert alert-danger"> <i class="fa fa-times-circle"></i> ' . "Server Does Not Meet All Requirements, Installation Can't Proceed :(</a></div>");

                            echo('</div>');
                        } ?>
                    </div>

                    <p>
                        <a class="btn btn-primary btn-lg" onClick="window.location.reload()">Refresh</a>
                        <?php if (!$error) {
                            $_SESSION['upgrade_step'] = 2;
                            echo('<a href="adminVerify.php?' . time() . '" class="btn btn-success btn-lg">Next</a>');
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>