<?php
require_once '../include/config.inc.php';
if (!isset($_SESSION['username'])) {
    echo '<script>
    ///location.href = "sign.php";
    </script>';
}
$system = mysql_query('SELECT * FROM m_config WHERE id=1');
$system = mysql_fetch_assoc($system);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $system['title'];?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="../css/matrix-style.css" />
    <link rel="stylesheet" href="../css/matrix-media.css" />
    <link rel="stylesheet" href="../css/select2.css" />
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/jquery.gritter.css" />

<!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>-->
    <link rel="stylesheet" href="../css/overwrite.css"/>
</head>
<body>

<!--Header-part-->
<div id="header">
    <h1><a href="index.php">::Control Panel::</a></h1>
</div>
<!--close-Header-part-->


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
    <ul class="nav">
        <li  class="dropdown" id="profile-messages" >
            <a title="" href="javascript:;" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">
                    >> <?php echo $_SESSION['username'];?>
        </span><b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="profile.php"><i class="icon-user"></i> Profile</a></li>
                <li class="divider"></li>
                <li><a href="password.php"><i class="icon-check"></i> Password</a></li>
                <li class="divider"></li>
                <li><a href="quit.php"><i class="icon-key"></i> Quit</a></li>
            </ul>
        </li>
        <?php if($_SESSION['usertype']==3)
        {?>
        <li class=""><a title="" href="setting.php"><i class="icon icon-cog"></i> <span class="text">Setting</span></a></li>
        <?php }?>
        <li class=""><a title="" href="quit.php"><i class="icon icon-share-alt"></i> <span class="text">Quit</span></a></li>
        <li>
            <a href="/">
                <i class="icon icon-arrow-left"></i>
                Home</a>
        </li>
    </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!--close-top-serch-->
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul id="Nav">
        <li id="Home" class="active"><a href="index.php"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>

        <?php include('nav'.$_SESSION['usertype']).'.php';?>
    </ul>
</div>