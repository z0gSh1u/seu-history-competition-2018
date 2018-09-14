<!DOCTYPE HTML>
<html>
	<meta charset="utf-8" />
	
	<!--[if lte IE 6]>
	<script type="text/javascript">
	window.location.href="oldbrowser.html";
	</script>
	<![endif]-->
	<!--[if lte IE 8]>
	<script type="text/javascript">
	window.location.href="index-ie8.php";
	</script>
	<![endif]-->
	
	<head>
		<link rel="icon" href="favicon.ico" />
		<title> 校史校情知识竞赛 - 东南大学 2018 </title>
		<base target="_blank" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/jquery.backstretch.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script src="js/xsxq-js.js"></script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="stylesheet" href="css/njigsaw-style.css">
    	<script type="text/javascript" src="js/njigsaw-js.js"></script>
	</head>
	<body>
		<script type="text/javascript">$.backstretch(
	["img/indexLoop/1.jpg", "img/indexLoop/2.jpg",  "img/indexLoop/3.jpg",  "img/indexLoop/4.jpg",  "img/indexLoop/5.jpg",  "img/indexLoop/6.jpg"], {
		duration: 5000,
		fade: 1000
	});</script>
		<div id="wholeblock" class="container well" style="margin: 0 auto; margin-top: 1.8%; width: 600px; background-color: rgba(255,255,255,0.8);">
			<div id="banner" style="opacity: 1;">
				<center>
					<img src="img/seulogo-transparent.png" width="20%" height="100%" />
				</center>
				<h1 style="text-align: center;"><b>东南大学</b>&nbsp;校史校情知识竞赛 2018</h1>
			</div>
			<br />
			<div style="text-align: center; opacity: 1;">
				<h2>· 学 生 登 陆 ·</h2>
				<br>
				<form id="loginform" action="foo/foo_loginProcess.php" method="post">
					<input class="input-lg" placeholder="学          号" name="stuNum" id="stuNum" style="text-align: center;"/>
					<br>
					<br>
					<input class="input-lg" placeholder="一 卡 通 号" name="yktNum" id="yktNum" style="text-align: center;" type="password"; />
					<br>
					<br>
                    <input type="hidden" name="captcha" value="false" id="captcha"/>
						<div id="slideBar" style="text-align: center; display: inline-block;"></div>
					<br><br>
					<button type="button" class="btn btn-primary" style="font-size: 18px;" onclick="idxonsub();">
					登  陆
					</button>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<button type="button" class="btn btn-default" style="font-size: 18px;" onclick="myreset();">
					清  空
					</button>				
    <script type="text/javascript">
        SliderBar("slideBar", options);
    </script>
				
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
			<a href="register.php" style="color: inherit;">
				补注册
			</a>
			<b style="color: #5E5E5E;">&nbsp;&nbsp;|&nbsp;&nbsp;</b>
			<a href="query_score.php" style="color: inherit;">
				分数查询
			</a>
			<b style="color: #5E5E5E;">&nbsp;&nbsp;|&nbsp;&nbsp;</b>
			<a href="error_send.php" style="color: inherit;">
				意见建议
			</a>
			<b style="color: #5E5E5E;">&nbsp;&nbsp;|&nbsp;&nbsp;</b>
			<a href="" style="color: inherit;" data-toggle="modal" data-target="#introModal">
				帮助与关于
			</a>
		</div>

<!-- Modal -->
<div class="modal fade" id="introModal" tabindex="-1" role="dialog" aria-labelledby="introModal">
  <div class="modal-dialog" role="document" style="top: 45%; transform: translateX(-50%) translateY(-50%); left: 50%; position: absolute;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="introModalLabel" style="font-weight: bold;">关于校史校情知识竞赛</h4>
      </div>
      <div class="modal-body">
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;“我爱东大”校史校情知识竞赛是东南大学“新生文化季”的传统项目与品牌活动，由校团委和计算机科学与工程学院、软件学院主办，计算机科学与工程学院、软件学院团委承办。自校史校情知识竞赛首次举行以来，已逾十余个春秋，面向所有学院，累计参赛人数达数万人。
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>
		
	</body>
</html>