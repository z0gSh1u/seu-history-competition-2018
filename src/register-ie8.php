<!DOCTYPE HTML>
<html>
	<link rel="icon" href="favicon.ico" />
	<meta charset="utf-8" />
	<head>
		<title>
			临时补注册 - 校史校情知识竞赛 - 东南大学 2018
		</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" /> 
		<script type="text/javascript" src="js/xsxq-js.js"></script>
		<script type="text/javascript" src="js/xsxq-js-ie8addon.js" ></script>
	</head>
	<body>
		<div id="wholeblock" class="container well" style="margin: 0 auto; margin-top: 5%; width: 600px; background-color: rgba(255,255,255,0.8);">
		<div id="banner" style="opacity: 1;">
			<center><img src="img/seulogo-transparent-sm.png" height="100%" /></center>
			<h1 style="text-align: center;"><b>东南大学</b>&nbsp;校史校情知识竞赛 2018</h1>
		</div>
		<br />
		<div style="text-align: center; opacity: 1;">
			<h2>· 补 注 册 ·</h2>
			<br>
				<p style="color: red;"><br>务必在管理员指导下操作</p>
			<form method="post" action="foo/foo_regProcess.php" id="regform">
				<p>管理员填写 - 超级密码：</p>
				<input class="input-sm" name="superpw" id="superpw" type="password"/ >
				<br /><br />
				<p>新用户信息：</p>
				<input class="input-sm" value="学       号" name="stuNum" id="stuNum" style="text-align: center;" onclick="setvalue('stuNum','');"/>
					<br>
					<br>
					<input class="input-sm" value="一 卡 通 号" name="yktNum" id="yktNum" style="text-align: center;"  onclick="setvalue('yktNum','');"/>
					<br>
					<br>
				<button type="button" class="btn btn-primary" onclick="onsubrr();">确 认</button>
			</form>
		</div>
		</div>
	</body>
</html>