<!DOCTYPE HTML>
<html>
	<meta charset="utf-8" />
	<head>
		<title>
			超级管理员入口 - 校史校情知识竞赛 - 东南大学 2018
		</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" /> 
		<script type="text/javascript" src="js/xsxq-js.js" ></script>
	</head>
	<body>
		<div id="wholeblock" class="container well" style="margin: 0 auto; margin-top: 5%; width: 600px; background-color: rgba(255,255,255,0.8);">
		<div id="banner" style="opacity: 1;">
			<center><img src="img/seulogo-transparent.png" width="20%" height=auto /></center>
			<h1 style="text-align: center;"><b>东南大学</b>&nbsp;校史校情知识竞赛 2018</h1>
		</div>
		<br />
		<div style="text-align: center; opacity: 1;">
			<h2>· 管 理 员 登 陆 ·</h2>
			<br>
			<form action="superfoo/superfoo_loginProcess.php" method="post">
			
				<input class="input-lg" placeholder="帐号" name="uid" id="uid" />
				<br><br>
				<input class="input-lg" placeholder="密码" name="upw" id="upw" type="password"/>
				<br><br>
				<button type="submit" class="btn btn-primary" style="font-size: 18px;">登  陆</button>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn btn-default" style="font-size: 18px;" onclick="myreset();">清  空</button>
			</form>
		</div>
		</div>
	</body>
</html>