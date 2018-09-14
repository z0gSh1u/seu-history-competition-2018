<!DOCTYPE HTML>
<html>
	<meta charset="utf-8" />

	<head>
		<link rel="icon" href="favicon.ico" />
		<title> 校史校情知识竞赛 - 东南大学 2018 </title>
		<base target="_blank" />
		<!--
     		check if Fast mode is on, return to index.php
        -->
        <script>
    	var Sys = {};
    	var ua = navigator.userAgent.toLowerCase();   
    	var s;   
            (s = ua.match(/msie ([\d.]+)/)) ? Sys.ie = s[1] :   
            (s = ua.match(/firefox\/([\d.]+)/)) ? Sys.firefox = s[1] :   
            (s = ua.match(/chrome\/([\d.]+)/)) ? Sys.chrome = s[1] :   
            (s = ua.match(/opera.([\d.]+)/)) ? Sys.opera = s[1] :   
            (s = ua.match(/version\/([\d.]+).*safari/)) ? Sys.safari = s[1] : 0; 
              
    	if (Sys.chrome) 
    	{
    		window.location.href = "index.php";
    	}
		</script>
		
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap-ie6.min.css" />
		<link rel="stylesheet" type="text/css" href="css/ie.css" />
		<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="js/xsxq-js.js"></script>
		<script type="text/javascript" src="js/xsxq-js-ie8addon.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/njigsaw-style.css">
		<!--[if lte IE 8]>
		<script type="text/javascript">
		alert('您当前使用的浏览器版本过低，为保证最佳浏览效果，请使用新版IE或Chrome浏览器。');
		</script>
		<![endif]-->
	</head>
	<style>body {
	background: url(img/indexLoop/1.jpg) top center no-repeat;
}

.well {
	filter: alpha(opacity=92);
}

.code {
	font-family: Arial;
	font-style: italic;
	color: darkgreen;
	font-size: 30px;
	border: 0;
	padding: 2px 3px;
	letter-spacing: 3px;
	font-weight: bolder;
	cursor: pointer;
	width: 150px;
	height: 60px;
	line-height: 60px;
	text-align: center;
	vertical-align: middle;
}</style>
	<body onload="createCode()">
		<div id="wholeblock" class="container well" style="margin: 0 auto; margin-top: 1.8%; width: 600px;">
			<div id="banner">
				<center>
					<img src="img/seulogo-transparent-sm.png" height="100%" />
				</center>
				<h1 style="text-align: center;"><b>东南大学</b>&nbsp;校史校情知识竞赛 2018</h1>
			</div>
			<br />
			<div style="text-align: center;">
				<h2>· 学 生 登 陆 ·</h2>
				<br>
				<form id="loginform" action="foo/foo_loginProcess-ie8.php" method="post">
					<input class="input-lg" value="学       号" name="stuNum" id="stuNum" style="text-align: center;" onclick="setvalue('stuNum','');"/>
					<br>
					<br>
					<input class="input-lg" value="一 卡 通 号" name="yktNum" id="yktNum" style="text-align: center;" onclick="setvalue('yktNum',''); document.getElementById('yktNum').type='password'; "/>
					<br>
					<br>
					<input type="hidden" name="captcha" value="false" id="captcha"/>
					<div style="text-align: center; margin-left: 11px;">
						<input class="input-lg" value="验  证  码" name="yzm" id="yzm" style="text-align: center; width: 150px;"  onclick="setvalue('yzm','');"/>
						<div class="code" id="checkCode" onclick="createCode()" style="margin: auto; display: inline-block;"></div>
					</div>
					<br>
					<button type="button" class="btn btn-primary" style="font-size: 18px;" onclick="idxonsub_ie8();">
					登  陆
					</button>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<button type="button" class="btn btn-default" style="font-size: 18px;" onclick="myreset_ie8();">
					清  空
					</button>
				</form>
			</div>
		</div>
		<!-- extra functions -->
		<br />
		<br />
		<div id="extrafun" class="well center-block" style="color:black; text-align: center; width: 500px; opacity: .9;">
			<a href="admin.php" style="color: inherit;">
				辅导员入口
			</a>
			<b style="color: #5E5E5E;">&nbsp;&nbsp;|&nbsp;&nbsp;</b>
			<a href="register-ie8.php" style="color: inherit;">
				补注册
			</a>
			<b style="color: #5E5E5E;">&nbsp;&nbsp;|&nbsp;&nbsp;</b>
			<a href="query_score-ie8.php" style="color: inherit;">
				分数查询
			</a>
			<b style="color: #5E5E5E;">&nbsp;&nbsp;|&nbsp;&nbsp;</b>
			<a href="error_send-ie8.php" style="color: inherit;">
				意见建议
			</a>
			<b style="color: #5E5E5E;">&nbsp;&nbsp;|&nbsp;&nbsp;</b>
			<a href="helper.html" style="color: inherit;">
				帮助与关于
			</a>
		</div>
	</body>
</html>