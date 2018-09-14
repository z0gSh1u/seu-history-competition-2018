<!DOCTYPE HTML>
<?php
include ('foo/public_head_check.php');
?>
<?php
$_SESSION["refreshLeft"] = $_SESSION["refreshLeft"] - 1;
if ($_SESSION["refreshLeft"] == 0)
{
	echo "<script>alert('刷新页面次数达到上限，请重新登录！反复触及上限将导致账号封禁！');</script>";
	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) 
	{
		setcookie(session_name(), '', time() - 1, '/');
	}
	session_destroy();
	session_unset();
	unset($_SESSION);
	echo "<script>window.location.href='index-ie8.php';</script>";
}

$con =
	include ('getsqlcon.php');
// 1. session matters
$sess_name = session_name();
    if (session_start()) {
        setcookie($sess_name, session_id(), null, '/', null, null, true);}
// check first answering
$firstansquery = "SELECT `finishans` FROM xsxqsql WHERE (stuNum=".$_SESSION["stuNum"]." ) LIMIT 1";
$raw_finish = mysqli_query($con,$firstansquery);
$finishstts = mysqli_fetch_assoc($raw_finish);
$finishstts = $finishstts['finishans'];
if($finishstts == 1)
{
	echo '<script>alert("你已经答过题了，无法再次进入！点击确认查询分数。")</script>';
	$togo = 'foo/foo_getMark.php?stuNum='.$_POST["stuNum"].'&'.'yktNum='.$_POST["yktNum"];
	echo '<script>window.location.href="'.$togo.'";</script>';
session_unset();
session_destroy();
unset($_SESSION);
	die();
	exit();
	return;
}

// 2. load configs
$CONFS =
include "config.conf";
// 3. pick questions
$query_sel = "SELECT * FROM " . $CONFS['que-sel-tablename'] . " ORDER BY RAND() LIMIT " . $CONFS['que-sel-count'];
$query_tf = "SELECT * FROM " . $CONFS['que-tf-tablename'] . " ORDER BY RAND() LIMIT " . $CONFS['que-tf-count'];

$raw_sel = mysqli_query($con, $query_sel);
$raw_tf = mysqli_query($con, $query_tf);

while ($row = mysqli_fetch_assoc($raw_sel)) {
	$rows_sel[] = $row;
}
while ($row = mysqli_fetch_assoc($raw_tf)) {
	$rows_tf[] = $row;
}

echo "<html>";

$i = 1;

// hidden field
echo "<div id='selcount' v=" . strval($CONFS['que-sel-count']) . " ></div>";
echo "<div id='tfcount' v=" . strval($CONFS['que-tf-count']) . " ></div>";
echo "<div id='maxques' v=" . strval($CONFS['que-sel-count'] + $CONFS['que-tf-count']) . " ></div>";
echo "<div id='maxtime' v=" . strval($CONFS['answer-timelength']) . " ></div>";
echo "<div id='xuehaodiv' v=" . strval($_SESSION["stuNum"]) . " ></div>";
echo "<div id='yikatongdiv' v=" . strval($_SESSION["yktNum"]) . " ></div>";
?>

<!-- UI Codes -->
<meta charset="utf-8" />
<head>
	<link rel="icon" href="./favicon.ico" />
	<title>答题中 - 校史校情知识竞赛</title>
	<base target="_blank" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="css/css_in-answer-ie8.css" />
	<script type="text/javascript" src="js/json2.js" ></script>
	<script type="text/javascript" src="js/jquery-1.9.min.js" ></script>
	<script type="text/javascript" src="js/xsxq-js.js"></script>
	<script type="text/javascript" src="js/xsxq-js-ie8addon.js"></script>
</head>

<body>
<div class="banner">
<img style="margin: 22px auto 7px 22px; "  src="img/whitelogo.png">
<p class="bannertext">
东南大学校史校情知识竞赛 - 2018
</p>
</div>

<div class="userinfos" style="white-space: nowrap; position: relative; height: 50px;">
<p class="userinfo">
<?php
echo "当前登录：" . strval($_SESSION["name"]) . "&nbsp;&nbsp";
echo "学号：" . strval($_SESSION["stuNum"]) . "&nbsp;&nbsp";
echo "一卡通：" . strval($_SESSION["yktNum"]);
?>
</p>
<div style="text-align: right; margin: auto 15px 15px auto;">
<button class="btn btn-default btn-sm" style="right: 10px;" onclick="window.open('error_send-ie8.php');">
报告问题
</button>
&nbsp;

<button class="btn btn-default btn-sm" style="right: 10px;" onclick="onlogout();">
退出登录
</button>
</div>
</div>

<div class="question">
<?php
foreach ($rows_sel as $key => $v) {
	echo <<<EOT
	<div class="questioncontianer" id="que{$i}" queid="{$v['queid']}">
				<h2 class="questiontext" id="questiontext">{$i}、{$v['que']}</h2>
				<ul class="questionselset">
					<li class="questionselitem" >
						<input id="que{$i}selA" type="radio" value="0" class="rdo" name="radioof{$i}">
						&nbsp;&nbsp; <label for="que{$i}selA" style="font-weight: normal;">A. {$v['sel1']}</label>
					</li>
					<li class="questionselitem" >
						<input id="que{$i}selB" type="radio" value="0" class="rdo" name="radioof{$i}">
						&nbsp; <label for="que{$i}selB" style="font-weight: normal;">B. {$v['sel2']}</label>
					</li>
					<li class="questionselitem" >
						<input id="que{$i}selC" type="radio" value="0" class="rdo" name="radioof{$i}">
						&nbsp; <label for="que{$i}selC" style="font-weight: normal;">C. {$v['sel3']}</label>
					</li>
					<li class="questionselitem" >
						<input id="que{$i}selD" type="radio" value="0" class="rdo" name="radioof{$i}">
						&nbsp; <label for="que{$i}selD" style="font-weight: normal;">D. {$v['sel4']}</label>
					</li>
				</ul>
				<div class="twobutton">
					<button class="btn btn-default btn-lg" style="margin: auto 20px 40px auto;" onclick="prevque()">
					&laquo;&nbsp;上一题
					</button>
					<button class="btn btn-default btn-lg" style="margin: auto 20px 40px auto;" onclick="nextque()">
					下一题&nbsp;&raquo;
					</button>
				</div>
	</div>
EOT;
	$i++;
}

foreach ($rows_tf as $key => $v) {
	echo <<<EOT
	<div class="questioncontianer" id="que{$i}" queid="{$v['queid']}">
				<h2 class="questiontext" id="questiontext">{$i}、{$v['que']}</h2>
				<ul class="questionselset">
					<li class="questionselitem" >
						<input id="que{$i}selA" type="radio" value="0" class="rdo" name="radioof{$i}">
						&nbsp;&nbsp; <label for="que{$i}selA" style="font-weight: normal;">A. 对</label>
					</li>
					<li class="questionselitem" >
						<input id="que{$i}selB" type="radio" value="0" class="rdo" name="radioof{$i}">
						&nbsp; <label for="que{$i}selB" style="font-weight: normal;">B. 错</label>
					</li>
					<br><br><br><br>
				</ul>
				<div class="twobutton">
					<button class="btn btn-default btn-lg" style="margin: auto 20px 40px auto;" onclick="prevque()">
					&laquo;&nbsp;上一题
					</button>
					<button class="btn btn-default btn-lg" style="margin: auto 20px 40px auto;" onclick="nextque()">
					下一题&nbsp;&raquo;
					</button>
				</div>	
			</div>
EOT;
	$i++;
}
?>
	
			<div class="questioncontrol questioncon-ie">
				<div class="quesctrlinside">
					<p class="quectrltext">
						选择题：
					</p>
					<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<style>
						.quebtn-ie{
							border-radius: 50%;
							behavior: url(PIE.htc);
							position: relative;
							z-index: 99;
							height: 41px;
							width: 41px;
						}
					</style>
					<script>var toprint = '<button class="btn btn-default quebtn quebtn-ie" id="rbtn';
for(i = 1; i != parseInt($('#selcount').attr('v')) + 1; i++) {
	var t = toprint + i.toString() + '" onclick="onclickques(' + i.toString();
	t = t + ')">' + i.toString() + '</button>'
	document.write(t);
	if (i % 10 == 0 && i != parseInt($('#selcount').attr('v'))) {document.write('<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');}
}</script>
					<br>
					<br>
					<p class="quectrltext">
						判断题：
					</p>
					<br>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<script>var toprint = '<button class="btn btn-default quebtn quebtn-ie" id="rbtn';
for(i = parseInt($('#selcount').attr('v')) + 1; i != parseInt($('#selcount').attr('v')) + parseInt($('#tfcount').attr('v')) + 1; i++) {
	var t = toprint + i.toString() + '" onclick="onclickques(' + i.toString();
	t = t + ')">' + i.toString() + '</button>'
	document.write(t);
}</script>
					<br>
					<br>
					<p class="quectrltext">
						剩余时间：
					</p>
					<br>
					<span style="font-size: large;" id="cddisplay">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;00 : 00
					</span>
					<div style="text-align: right;">
						<button class="btn btn-danger" style="margin: 80px 30px auto auto; display: none;" id="qttoofast">
						切题过快，请认真答题！
						</button>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<button class="btn btn-warning btn-sm" style="margin: 80px 30px auto auto; display: none;" onclick="forcesubmit();" id="forcesubbtn">
						强制交卷
						</button>
						<button class="btn btn-primary btn-lg" style="margin: 80px 30px auto auto;" onclick="onpapersubmit_ie8();">
						交  卷
						</button>
					</div>
				</div>
		</div>

		<script>$(function() {
	$('.questioncontrol').css('height', $('.questioncontianer').height());
})
onchangeques(1);
</script>
<script type="text/javascript" src="js/in-answer-countdown.js" ></script>
	</body>

</html>

