<?php
	error_reporting(0);
	define("DBACCESS", "vbbvXmtEw9SRyoVs");
	$V_CONF = include "../config.conf";
	$con = include('../getsqlcon.php');
	// get user info
	$USR_SN = $_POST["uid"];
	$USR_YN	= $_POST["upw"];
	require_once('../tools/illegalCharCheck.php');
	ilgCharCheck($USR_SN);ilgCharCheck($USR_YN);
	$SQ_TBN = $V_CONF["sql-ls-tablename"];
	// check
	$toquery =<<<EOT
SELECT * FROM `{$SQ_TBN}` WHERE unl='{$USR_SN}' && pawl='{$USR_YN}' LIMIT 1;
EOT;
	$RAWRES = mysqli_query($con, $toquery);
	if (mysqli_num_rows($RAWRES) < 1)
	{
		echo '<script>alert("信息有误，请检查！")</script>';
		echo '<script>window.close();</script>';
		die();exit();return;
	}
	$ROWS = mysqli_fetch_assoc($RAWRES);
	$USR_NAME = $ROWS['name'];
	mysqli_close($con);
	// set session
	session_unset();
	session_destroy();
	$sess_name = session_name();
    if (session_start())
        setcookie($sess_name, session_id(), null, '/', null, null, true);
	session_regenerate_id();
	
	$_SESSION["fdyUsrname"] = $USR_SN;
	$_SESSION["fdyAca"] = $ROWS['academy'];
	$_SESSION["name"] = $USR_NAME;
	$_SESSION["usrtype"] = 2;
	// token
	include_once 'safe_token_api.php';
	$_SESSION["token"] = Crumb::genToken($_SESSION["fdyUsrname"]);
	
	// feed back
	echo '<script>alert("登陆成功！")</script>';
	echo '<script>url="../admin_index.php"; window.location.href=url;</script>';
?>