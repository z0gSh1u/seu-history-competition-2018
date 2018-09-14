<?php
	error_reporting(0);
	if(!defined("DBACCESS"))
		{die('Access Denied.'); exit();}
	define("DBACCESS", "vbbvXmtEw9SRyoVs");
	$V_CONF = include "config.conf";
	
	// get sql info
	$SQ_HOST	= $V_CONF["sql-servername"];
	$SQ_USR		= $V_CONF["sql-username"];
	$SQ_PWD		= $V_CONF["sql-password"];
	$SQ_DBNAME	= $V_CONF["sql-dbname"];
	$SQ_PORT	= $V_CONF["sql-port"];
	$SQ_TBN		= $V_CONF["sql-tablename"];
	
	$con = mysqli_connect($SQ_HOST, $SQ_USR, $SQ_PWD, $SQ_DBNAME, $SQ_PORT); 		// try1
	if (!$con)
	{
		$con = mysqli_connect($SQ_HOST, $SQ_USR, $SQ_PWD, $SQ_DBNAME, $SQ_PORT);	// try2
	}
	if (!$con)
	{
		$con = mysqli_connect($SQ_HOST, $SQ_USR, $SQ_PWD, $SQ_DBNAME, $SQ_PORT);	// try3
	}
	if (!$con)
	{
		$con = mysqli_connect($SQ_HOST, $SQ_USR, $SQ_PWD, $SQ_DBNAME, $SQ_PORT);	// try4
	}
	if (!$con)
	{
		$con = mysqli_connect($SQ_HOST, $SQ_USR, $SQ_PWD, $SQ_DBNAME, $SQ_PORT);	// try5
	}
	if (!$con) // sooooooooooooorry
	{
		die("内部连接错误！" . mysqli_error());
	}
	return $con;
?>