<!DOCTYPE HTML>
<html>
	<link rel="icon" href="favicon.ico" />
	<meta charset="utf-8" />
	<title> 分数查询 - 校史校情知识竞赛 - 东南大学 2018 </title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
	<script src="js/xsxq-js.js" ></script>
	</head>
	<body>
		<div id="wholeblock" class="container well" style="margin: 0 auto; margin-top: 5%; width: 600px; background-color: rgba(255,255,255,0.8);">
			<div id="banner" style="opacity: 1;">
				<center>
					<img src="img/seulogo-transparent.png" width="20%" height="100%" />
				</center>
				<h1 style="text-align: center;"><b>东南大学</b>&nbsp;校史校情知识竞赛 2018</h1>
			</div>
			<br />
			<div style="text-align: center; opacity: 1;">
				<h2>· 分 数 查 询 ·</h2>
				<br>
				<form method="get" action="foo/foo_getMark.php" id="getmarkform">
					<input class="input-lg" placeholder="学          号" name="stuNum" id="stuNum" style="text-align: center;"/>
					<br>
					<br>
					<input class="input-lg" placeholder="一 卡 通 号" name="yktNum" id="yktNum" style="text-align: center;" />
					<br>
					<br>
					<button type="button" class="btn btn-primary" style="font-size: 18px;" onclick="onsubaa();">
					查  询
					</button>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<button type="button" class="btn btn-default" style="font-size: 18px;" onclick="myreset();">
					清  空
					</button>
				</form>
			</div>
		</div>
	</body>
</html>