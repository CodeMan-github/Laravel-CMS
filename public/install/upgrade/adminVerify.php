<?php
error_reporting(0);
if (!isset($_SESSION)) session_start();

if ($_SESSION['upgrade_step'] < 2) {
    header("Location: /install/upgrade/requirements.php");
    exit();
}

$config = parse_ini_file('../../../.env');

define("database", $config['DB_DATABASE']);
define("databaseServer", $config['DB_HOST']);
define("databaseUser", $config['DB_USERNAME']);
define("databasePass", $config['DB_PASSWORD']);

include('../config.php');

$email = '';
$password = '';
$error = false;

function validAdmin($email, $password)
{

    //$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
    $result = mysqlQuery("SELECT * FROM `users` WHERE `email`='$email'");

    $assoc = mysql_fetch_assoc($result);

    if (!isset($assoc['password'])) {
        return false;
    }

    if (password_verify($password, $assoc['password']))
        return true;
    else
        return false;

}


if (isset($_POST['submit'])) {

    if ($_SESSION['csrf'] != $_POST['csrf'])
        $error = "Error Try Again";
    if (!$error) {

        $email = $_POST['email'];

        $password = $_POST['password'];

        if (!validAdmin($email, $password)) {
            $error = "Invalid User name or Password Can't Proceed";
        }
    }

}
$key = sha1(microtime());

$_SESSION['csrf'] = $key;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/install/style/images/favicon.png">
    <link href="/install/style/css/bootstrap.min.css" rel="stylesheet">
    <link href="/install/style/css/font-awesome.min.css" rel="stylesheet">
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
                <li class="list-group-item"><i class="fa fa-cogs"></i> Server Requirements</li>
                <li class="list-group-item active"><i class="fa fa-user"></i> Admin Verification</li>
                <li class="list-group-item"><i class="fa fa-list-alt"></i> Upgrade Database</li>
                <li class="list-group-item"><i class="fa fa-thumbs-up"></i> Finish</li>
            </ul>

            <div class="hidden-xs hidden-sm">
                <center>All Rights Reserved <a href="http://www.kodeinfo.com">
                        KodeInfo.com</a></center>

            </div>
        </div>
        <form action="./adminVerify.php" method="post">
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong><i class="fa fa-gavel"></i> License Verification</strong>

                        <div class="pull-right"><span class="badge badge-warning">Step 3</span>
                        </div>
                    </div>
                    <div class="panel-body">
                        <p><b>Please verify your Admin Login Details</b>
                            <?php
                            if (isset($_POST['email']) && isset($_POST['password']) && $error != "")
                            {
                            ?>

                        <div class="alert alert-danger">
                            <i class="fa fa-times-circle"></i>
                            <?php echo($error) ?>
                        </div>
                        <?php }
                        else {
                            if (isset($_POST['email']) && isset($_POST['password']) && $error == "") {
                                ?>
                                <div class="alert alert-success">
                                    <i class="fa fa-check-square"></i>
                                    Login Details Verified Please Wait ...
                                </div>
                                <?php
                                $_SESSION['upgrade_step'] = 3;
                                echo('<META HTTP-EQUIV="Refresh" Content="2; URL=/install/upgrade/database.php?' . time() . '">');
                            }
                        }
                        ?>
                        <div class="input-group">
                            <span class="input-group-addon">Email</span>
                            <input name="email" type="text" class="form-control" placeholder="e.g. Admin" required>
                        </div>
                        <br/>

                        <div class="input-group">
                            <span class="input-group-addon">Password</span>
                            <input name="password" type="password" class="form-control" required>
                        </div>

                        <input type="hidden" name="csrf" value="<?php echo $key; ?>"/>
                        <br/>

                        <p>
                            <button type="submit" name="submit" class="btn btn-primary btn-lg">Next</button>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>