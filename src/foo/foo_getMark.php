<?php
	error_reporting(0);
	define("DBACCESS", "vbbvXmtEw9SRyoVs");
	$V_CONF = include "../config.conf";
	$con = include('../getsqlcon.php');
	// get user info
	$USR_SN = $_GET["stuNum"];
	$USR_YN	= $_GET["yktNum"];
	$SQ_TBN = $V_CONF['sql-tablename'];
	require_once ('../tools/illegalCharCheck.php');
	ilgCharCheck($USR_SN);ilgCharCheck($USR_YN);
	// query
	$QUERYINFO =<<<EOT
SELECT `score`, `name` FROM `{$SQ_TBN}` WHERE stuNum='{$USR_SN}' && yktNum='{$USR_YN}' LIMIT 1;
EOT;
	$RAWRES = mysqli_query($con, $QUERYINFO);
	// feed back
	if (mysqli_num_rows($RAWRES) < 1)
	{
		$SCORE = -2; // no this user
	}
	else
	{
		$SCORET = mysqli_fetch_assoc($RAWRES);
		$SCORE = $SCORET['score'];
		$NAME = $SCORET['name'];
	}
?>
<!DOCTYPE HTML>
<html>
	<meta charset="utf-8" />
		<title>
			分数查询 - 校史校情知识竞赛 - 东南大学 2018
		</title>
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" /> 
	</head>
	<body>
		<div id="wholeblock" class="container well" style="margin: 0 auto; margin-top: 5%; width: 600px; background-color: rgba(255,255,255,0.8);">
		<div id="banner" style="opacity: 1;">
			<center><img src="../img/seulogo-transparent.png" width="20%" height="100%" /></center>
			<h1 style="text-align: center;"><b>东南大学</b>&nbsp;校史校情知识竞赛 2018</h1>
		</div>
		<br />
		<div style="text-align: center; opacity: 1;">
			<h2>· 分 数 查 询 ·</h2>
			<br>
		<?php 
			echo "<h4>学号：".$USR_SN."&nbsp;&nbsp;&nbsp;一卡通：".$USR_YN;
			if ($SCORE == -2)
			{
				echo "</h4><br><h3><b>查无此人！</b></h3><br>";
			} 
			else if ($SCORE == -1)
			{
				echo "&nbsp;&nbsp;&nbsp;姓名：".$NAME."</h4><br>";
				echo "<h3><b>尚未答题，暂无成绩。</b></h3><br>";
			}
			else
			{
				echo "&nbsp;&nbsp;&nbsp;姓名：".$NAME."</h4><br>";
				echo "<h3><b>得分：".$SCORE."</b></h3><br>";
			}
		?>
		</div>
		</div>
	</body>
</html>