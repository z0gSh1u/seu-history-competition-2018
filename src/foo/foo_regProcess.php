<?php
	error_reporting(0);
	define("DBACCESS", "vbbvXmtEw9SRyoVs");
	$SUPERPW = $_POST["superpw"];
	$V_CONF = include "../config.conf";
	$con = include('../getsqlcon.php');
	$REALSPW = $V_CONF["superregpw"];
	$SQ_TBN = $V_CONF["sql-tablename"];
	if ($REALSPW != $SUPERPW)
	{
		echo '<script>alert("超级密码错误！请咨询管理员。");</script>';
		echo '<script>history.go(-1);</script>';
		die();exit();return;
	}
	// start register
	// get user info
	$USR_SN = $_POST["stuNum"];
	$USR_YN	= $_POST["yktNum"];
	require_once ('../tools/illegalCharCheck.php');
	ilgCharCheck($USR_SN);ilgCharCheck($USR_YN);
		// additional info
		$regtyp = 1; $nam = "[default]"; 
		$aca = substr($USR_SN, 0, 2);
		$sco = -1; $fians = 0;
	// duplicate check
	$DUPRAWQUERY = mysqli_query($con, "SELECT regtype FROM ".$SQ_TBN." WHERE stuNum ='".$USR_SN."' || yktNum ='".$USR_YN."' LIMIT 1;");
	if (mysqli_num_rows($DUPRAWQUERY) == 1)
	{
		echo '<script>alert("用户已存在！请咨询管理员。");</script>';
		echo '<script>history.go(-1);</script>';
		die();exit();return;
	}
	// add
	mysqli_query($con, "INSERT INTO ".$SQ_TBN." (stuNum,yktNum,finishans,score,regtype,name,academy) VALUES ('"
	.$USR_SN. "','" .$USR_YN. "'," .$fians. "," .$sco. "," .$regtyp. ",'" .$nam. "','" .$aca."')" );
	mysqli_close($con);
	// feed back
	echo '<script>alert("新用户添加成功！")</script>';
	echo '<script>window.close();</script>';
?>