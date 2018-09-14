<?php
// public head check for super user
// 1. check usertype
// 2. check token
// 3. get db access right

error_reporting(0);
define("DBACCESS_uQBX2boXK24YSD", "5wv84Upxj0ASiUR3xTn8IX");
include 'safe_token_api.php';
$sess_name = session_name();
if (session_start())
	setcookie($sess_name, session_id(), null, '/', null, null, true);
if ( ($_SESSION['usrtype'] != 3) && ($_SESSION['usrtype'] != 2) ) {
	session_unset();
session_destroy();
unset($_SESSION);
	echo "<script>alert('非法访问！');</script>";
	echo "<script>window.close();</script>";
	die();
	exit();
}

if ($_SESSION['usrtype'] == 3)
{
if (!Crumb::verifyToken($_SESSION['superUsrname'], $_SESSION['token']))
{
	session_unset();
session_destroy();
unset($_SESSION);
	echo "<script>alert('非法访问！');</script>";
	echo "<script>window.close();</script>";
	die();
	exit();
}
}
else
{
	if (!Crumb::verifyToken($_SESSION['fdyUsrname'], $_SESSION['token']))
{
	session_unset();
session_destroy();
unset($_SESSION);
	echo "<script>alert('非法访问！');</script>";
	echo "<script>window.close();</script>";
	die();
	exit();
}
}
?>
<?php

    $V_CONF = include "../config.conf";
    $con = include('../getsqlcon.php');
require_once('../tools/illegalCharCheck.php');
	ilgCharCheck($_GET["academy"]);

    $wantAca = $_GET["academy"];
    header('Content-Type:text/html; charset=UTF-8');
    mysqli_query($con, 'SET NAMES utf8');
    if($wantAca == 0)
    {
        $queryStr = "SELECT stunum,score,name,academy FROM " . $V_CONF["sql-tablename"] . " ORDER BY academy;";
    }
    else
    {
        $queryStr = "SELECT stunum,score,name FROM " . $V_CONF["sql-tablename"] . " WHERE academy='" . $wantAca . "';";
    }
    $raw_list = mysqli_query($con, $queryStr);
    while($single_row = mysqli_fetch_assoc($raw_list))
    {
        $scoreList[] = $single_row;
    }
    $json_str = json_encode($scoreList, JSON_UNESCAPED_UNICODE);
    file_put_contents('../json/list' . $wantAca . '.json', $json_str);
    date_default_timezone_set('PRC');
    $updateTime = time();
    $json_str = json_encode($updateTime);
    file_put_contents('../json/updatetime' . $wantAca . '.json', $json_str);
?>