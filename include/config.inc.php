<?php
error_reporting(0);
session_start();
if (PHP_VERSION_ID > 59999) 
{
    function mysql_connect($a,$b,$c,$d=null) { return mysqli_connect($a,$b,$c,$d); }
    function mysql_query($a) { return mysqli_query($a); }
    function mysql_affected_rows($a) { return mysqli_affected_rows($a); }
    function mysql_close($a) { return mysqli_close($a); }
    function mysql_fetch_assoc($a) { return mysqli_fetch_assoc($a); }
    function mysql_free_result ($a) { mysqli_stmt_free_result($a); }
    function mysql_select_db ($a) { mysqli_select_db($a); }
}
$cfg = require_once ('../../Common/Conf/config.php');
$_SESSION['username'] = $_SESSION['admin_user'][0]['username'];
$_SESSION['userid'] = $_SESSION['admin_user'][0]['id'];
$_SESSION['usertype'] = $_SESSION['admin_user'][0]['type'];

//定义几个常量
define('DB_NAME', $cfg['DB_NAME']); //数据库名
define('DB_USER', $cfg['DB_USER']); //数据库连接用户名
define('DB_PASSWORD', $cfg['DB_PWD']); //数据库连接密码
define('DB_HOST', $cfg['DB_HOST']); //数据库连接地址
include('fun.inc.php');
include('DB_connect.inc.php'); //引入连接数据库代码
?>