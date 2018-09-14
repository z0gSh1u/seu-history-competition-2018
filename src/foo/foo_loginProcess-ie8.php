<?php
	error_reporting(0);
	define("DBACCESS", "vbbvXmtEw9SRyoVs");
	$V_CONF = include "../config.conf";
	$con = include('../getsqlcon.php');
	// get user info
	$USR_SN = $_POST["stuNum"];
	$USR_YN	= $_POST["yktNum"];
	$USR_FLAG = $_POST["captcha"];
	$SQ_TBN = $V_CONF["sql-tablename"];
	// check
	require_once ('../tools/illegalCharCheck.php');
	if ($USR_FLAG != "tuotuodeie8")
    {
        echo '<script>alert("验证码未通过！")</script>';
        echo '<script>window.close();</script>';
        die();exit();return;
    }
	ilgCharCheck($USR_SN); ilgCharCheck($USR_YN);
	$RAWRES = mysqli_query($con, "SELECT finishans,name FROM `".$SQ_TBN."` WHERE stuNum ='".$USR_SN."' && yktNum ='".$USR_YN."' LIMIT 1;");
	if (mysqli_num_rows($RAWRES) < 1)
	{
		echo '<script>alert("信息有误，请检查！")</script>';
		echo '<script>window.close();</script>';
		die();exit();return;
	}
	$ROWS = mysqli_fetch_assoc($RAWRES);
	$FINISHANS = $ROWS['finishans'];
	if ($FINISHANS != 0)
	{
		echo '<script>alert("你已经答过题了，无法再次进入！点击确认查询分数。")</script>';
		$togo = 'foo_getMark.php?stuNum='.$_POST["stuNum"].'&'.'yktNum='.$_POST["yktNum"];
		echo '<script>window.location.href="'.$togo.'";</script>';
		die();exit();return;
	}

    $xmlDoc = new DOMDocument();
    $xmlDoc->load("../xml/contest_time.xml");
    $beginStr = $xmlDoc->documentElement->childNodes[0]->nodeValue;
    $endStr = $xmlDoc->documentElement->childNodes[1]->nodeValue;
    $beginDate = intval(substr($beginStr, 0, strlen($beginStr)-3));
    $endDate = intval(substr($endStr, 0, strlen($endStr)-3));
    date_default_timezone_set('PRC');
    $nowDate = time();
    if($nowDate < $beginDate)
    {
        echo '<script>alert("竞赛还未开始");</script>';
        echo '<script>window.close();</script>';
        die();exit();return;
    }
    else if($nowDate > $endDate)
    {
        echo '<script>alert("竞赛已经结束");</script>';
        echo '<script>window.close();</script>';
        die();exit();return;
    }

	$USR_NAME = $ROWS['name'];
	mysqli_close($con);
	// 5. session
	session_unset();
	session_destroy();
	$sess_name = session_name();
    if (session_start())
        setcookie($sess_name, session_id(), null, '/', null, null, true);
	session_regenerate_id();
	$_SESSION["stuNum"] = $USR_SN;
	$_SESSION["yktNum"] = $USR_YN;
	$_SESSION["name"] = $USR_NAME;
	$_SESSION["usrtype"] = 1;
	$_SESSION["refreshLeft"] = 5;
	
	// token
	include_once '../tools/safe_token_api.php';
	$_SESSION["token"] = Crumb::genToken($_SESSION["stuNum"]);
	
	// feed back
	echo '<script>alert("登陆成功，点击确定开始答题。")</script>';
	echo '<script>url="../in-answer-ie8.php"; window.location.href=url;</script>';
?>