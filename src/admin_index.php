<?php 
	error_reporting(0);
	$sess_name = session_name();
    if (session_start())
        setcookie($sess_name, session_id(), null, '/', null, null, true);
	if($_SESSION['usrtype']!=2)
	{
		echo "<script>alert('非法访问！');</script>";
		echo "<script>window.close();</script>";
		die();exit();
	}
	$fdyAca = $_SESSION['fdyAca'];
?>

<!DOCTYPE HTML>
<html>
	<meta charset="utf-8" />
	<style>
		.btn{
			width: 140px;
			margin: 6px 6px auto auto;
		}
		.rightfloat{
			width: 65%; 
			height: auto; 
			float: right; 
			display: none;
		}
	</style>
	<head>
		<title>
			辅导员界面 - 校史校情知识竞赛 - 东南大学 2018
		</title>
		<base target="_blank" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" /> 
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/admin_index-js.js"></script>
		<script type="text/javascript" src="js/send_to_other.js"></script>
        <script type="text/javascript" src="js/load_xml.js"></script>
        <script type="text/javascript" src="js/set_time.js"></script>
        <script type="text/javascript" src="js/ichart.1.2.min.js"></script>
        <script type="text/javascript" src="js/score_info.js"></script>
        <script type="text/javascript" src="js/superadmin_index-js.js" ></script>
	</head>
	<body>
		<center>
		<h1 style="font-weight: bold;">辅导员界面</h1>
		<h3>校史校情知识竞赛 2018 东南大学</h3>
		<p style="color: red; display:inline-block;"><b>登陆为: </b> <?php echo $_SESSION['fdyUsrname']; ?></p>
		&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="window.open('foo/foo_logout.php');">退出登录</button>
		</center>
		<!-- Let divs show -->
		<div class="container">
			<br><br>
			<div style="width: 142px; height: auto; float: left;" id="left">
			<h4><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;后台功能集</b></h4>
			<button class="btn btn-default" onclick="showdiv('setinfo');">用户信息设置</button>
			<button class="btn btn-default" onclick="window.open('register.php');">用户补注册</button>
			<button class="btn btn-default" onclick="window.open('query_score.php');">个人分数查询</button>
			<button class="btn btn-default" onclick="showdiv('interquery');">个人信息互查</button>
			<button class="btn btn-default" onclick="showdiv('myscoreinfo');">本院系情况</button>
			<button class="btn btn-default" onclick="showdiv('scoreinfo');">全校院系情况</button>
			<button class="btn btn-default" onclick="showdiv('scoreoutput');">成绩导出功能</button>
			<button class="btn btn-default" onclick="window.open('error_send.php');">向管理员反馈</button>
			</div>
			
			<div id="defaultright">
				<br><br><br><br><br><br>
				<center>
				<h1>欢迎您，<?php echo $_SESSION['name'];?>老师！</h1>
				<br><p>校史校情知识竞赛系统</p><br><p>2018-07</p>
				</center>
			</div>
			
			<div class='rightfloat' id="setinfo">
				<h3>当前页面：<b>用户信息设置</b></h3>
					<p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：z0gSh1u</p>
				<br />
				<form action="admfoo/admfoo_setinfo.php" method="post">
					<p>定位用户：</p>
					<input name="stuNum" placeholder="[必填主键]学号" class="input-lg" />
					<br><br>
					<p>信息维护（不修改的不填）：</p>
					<input name="yktNum" placeholder="一卡通号" class="input-lg" />
					<br>
					<input name="name" placeholder="姓名" class="input-lg" style="margin: 15px 0 15px 0" />
					<br>
					<button type="submit" class="btn btn-primary">提 交</button>
				</form>
			</div>
			
			<div class='rightfloat' id="interquery">
				<h3>当前页面：<b>个人信息互查</b></h3>
					<p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：z0gSh1u</p>
				<br />
					<p>定位用户，任填其一：</p>
					<input id="stuNumaa" placeholder="学号" class="input-lg" />
					<br><br>
					<input id="yktNumaa" placeholder="一卡通号" class="input-lg" />
					<br><br>
					<input id="nameaa" placeholder="姓名" class="input-lg">
					<br><br>
					<button type="button" onclick='interquerysub();' class="btn btn-primary">提 交</button>
				<iframe src="" id='interqueryres' style="display: none; width: 590px; height: 350px;"></iframe>
			</div>
			<script>
				function interquerysub() {
	var url = "./admfoo/admfoo_interquery.php?stuNum=" + document.getElementById('stuNumaa').value + "&yktNum=" + document.getElementById('yktNumaa').value;
	url = url + '&name=' + document.getElementById('nameaa').value;
	document.getElementById('interqueryres').src = url;
	document.getElementById('interqueryres').style.display = 'block';
}
			</script>

            <div class="rightfloat" id="scoreoutput">
                <h3>当前页面：<b>成绩导出功能</b></h3>
                    <p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：LongChen</p>
                <br />
                <p>本功能可迅速将成绩信息制成csv表格</p>
                <form action="admfoo/admfoo_getList.php" method="post">
                    <p>您的院系是：</p>
                    <?php
                    	$jsonraw = file_get_contents('acanuminfo.json');
                        $jsondecode = json_decode($jsonraw, TRUE);
                        $infoarray = $jsondecode['academies'];
						$row = null;
						foreach($infoarray as $row)
						{
							if($row['number']==$_SESSION['fdyAca'])
							{
								echo $row['number']." - ".$row['academy'];
								break;
							}
						}
						echo '<select name="academyNum" style="display: none;">\n';
                        echo <<<EOT
<option value="{$_SESSION['fdyAca']}" selected="selected">_</option>
EOT;
						echo '</select>';
						echo '<br><br>';
                    ?>
                    <button type="submit" class="btn btn-primary" style="width: 80px;">导 出</button>
                </form>
            </div>

            <div class="rightfloat" id="scoreinfo">
                <h3>当前页面：<b>全校院系情况</b></h3>
                <p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：LongChen</p>
                <br>
                <button onclick="refreshAll();">更新缓存</button>
                <br><br>
                <select name="chartType1" id="chartType1" onchange="onChangeChart_admin('chartType1', 'chart1', '<?php echo $fdyAca;?>');" style="height: 30px; margin-right: 20px;">
                    <option value="" selected="selected" disabled="disabled" style="display: none">请选择你要查看的报表</option>
                    <option value="0">院系答题情况</option>
                    <option value="1">平均分前十院系</option>
                </select>
                <br><br>
                <div id="chart1"></div>
                <br />
            </div>

            <div class="rightfloat" id="myscoreinfo">
                <h3>当前页面：<b>本院系情况</b></h3>
                <p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：LongChen</p>
                <br>
                <button onclick="refreshAll();">更新缓存</button>
                <br><br>
                <select name="chartType2" id="chartType2" onchange="onChangeChart_admin('chartType2', 'chart2', '<?php echo $fdyAca;?>');" style="height: 30px; margin-right: 20px;">
                    <option value="" selected="selected" disabled="disabled" style="display: none">请选择你要查看的报表</option>
                    <option value="2">分数段统计</option>
                    <option value="3">优秀学生排名</option>
                </select>
                <br><br>
                <div id="chart2"></div>
                <br />
            </div>
			
		</div>

	<br><br>
	</body>
</html>