<?php
//连接数据库，$db将在引入的页面中使用
$db = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$db) { //连接失败
    die("Connect DataBase Err" . "<br>");
} else { //连接成功
    mysql_select_db(DB_NAME); //选择数据库
    mysql_query("set names utf8"); //设置编码
}


?>