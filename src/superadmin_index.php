<?php
include ('superfoo/public_head_check.php');
?>
<!DOCTYPE HTML>
<html>
	<meta charset="utf-8" />
	<style>.btn {
	width: 140px;
	margin: 6px 6px auto auto;
}

.rightfloat {
	width: 65%;
	height: auto;
	float: right;
	display: none;
}</style>
	<head>
		<title>
			超级管理 - 校史校情知识竞赛 - 东南大学 2018
		</title>
		<base target="_blank" />
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
        <script src="js/jquery-3.3.1.min.js" ></script>
        <script type="text/javascript" src="js/send_to_other.js"></script>
        <script type="text/javascript" src="js/load_xml.js"></script>
        <script type="text/javascript" src="js/set_time.js"></script>
        <script type="text/javascript" src="js/ichart.1.2.min.js"></script>
        <script type="text/javascript" src="js/score_info.js"></script>
        <script type="text/javascript" src="js/superadmin_index-js.js" ></script>
	</head>
	<body>
		<center>
		<h1 style="font-weight: bold;">超级管理员界面</h1>
		<h3>校史校情知识竞赛 2018 - 东南大学</h3>
		<p style="color: red; display:inline-block;"><b>登陆为: </b> <?php echo $_SESSION['name']; ?></p>
		&nbsp;&nbsp;&nbsp;&nbsp;<button onclick="window.open('foo/foo_logout.php');">退出登录</button>
		</center>
		<div class="container">
			<br><br>
			<div style="width: 142px; height: auto; float: left;" id="left">
			<h4><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;后台功能集</b></h4>
			<button class="btn btn-default" onclick="showdiv('setinfo');">用户信息设置</button>
			<button class="btn btn-default" onclick="window.open('register.php');">用户补注册</button>
			<button class="btn btn-default" onclick="showdiv('makequery');">执行SQL查询</button>
			<button class="btn btn-default" onclick="showdiv('importsql');">导入SQL脚本</button>
			<button class="btn btn-default" onclick="showdiv('outputsql');">SQL导出功能</button>
			<button class="btn btn-default" onclick="showdiv('laoshiconf');">辅导员管理</button>
			<button class="btn btn-default" onclick="window.open('superfoo/superfoo_queslist.php');">题库管理</button>
			<button class="btn btn-default" onclick="showdiv('configfile');">修改Config文件</button>
			<button class="btn btn-default" onclick="showdiv('resetstatus');">重置答题状态</button>
			<button class="btn btn-default" onclick="showdiv('resetsess');">解除Session</button>
			<button class="btn btn-default" onclick="showdiv('startandend');showTime('xml/contest_time.xml');">竞赛开放与关闭</button>
			<button class="btn btn-default" onclick="window.open('query_score.php');">个人分数查询</button>
			<button class="btn btn-default" onclick="showdiv('interquery');">个人信息互查</button>
			<button class="btn btn-default" onclick="showdiv('scoreinfo');">院系分数报表</button>
			<button class="btn btn-default" onclick="showdiv('scoreoutput');">成绩导出功能</button>
			<button class="btn btn-default" onclick="window.open('foo/special_userissues/');">查看Issue</button>
			<button class="btn btn-default" onclick="showdiv('serverinfo');">服务器负载信息</button>
			</div>
			
			<div style="" id="defaultright">
				<br><br><br><br><br><br><br><br><br>
				<center>
				<h1>超级后台 谨慎操作</h1><br>
				<p>校史校情知识竞赛系统</p><br><p>v1.0</p><br><p>2018-07</p>
				</center>
			</div>
			
			<div class='rightfloat' id="resetstatus">
				<h3>当前页面：<b>重置答题状态</b></h3>
					<p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：z0gSh1u</p>
				<br />
					<p>定位用户：</p>
<form id='resetform'>
					<input name="stuNum" placeholder="学号" class="input-lg" /><br>
					<input id='rsfty' name='type' type="hidden" value=""/>
					<br>
					<button onclick=" resetformsub(0);" class="btn btn-primary" type="button">查询答题状态</button><br>
					<button onclick=" resetformsub(1);" class="btn btn-primary" type="button">设置为已答题</button><br>
					<button onclick=" resetformsub(2);" class="btn btn-primary" type="button">设置为未答题</button><br>
</form>
			</div>	
			
			<div class="rightfloat" id="resetsess">
                <h3>当前页面：<b>解除Session</b></h3>
                    <p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：z0gSh1u</p>
                <br />
				<p><b>· 如何解除某一台机器上的本身的Session？</b></p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;请在用户机上访问./foo/foo_logout.php。</p>
					<p><b>· 如何解除服务器上存储的所有Session？</b></p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;请在服务器上执行：</p>
				<pre style="width:300px;">
rm -rf /tmp/*
service mysql restart
service apache restart</pre>
            </div>
			
			<div class="rightfloat" id="outputsql">
                <h3>当前页面：<b>SQL导出功能</b></h3>
                    <p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：z0gSh1u</p>
                <br />
	<p>请选择你要导出的表：</p>
	<form method="post" action="superfoo/superfoo_outputsql.php" id='opsqlform'>
<?php
define("DBACCESS", "vbbvXmtEw9SRyoVs");
header("Content-type:text/html;charset=utf-8");
$con =
include 'getsqlcon.php';
mysqli_query($con, 'SET NAMES utf8');
$tables_raw = mysqli_query($con, 'SHOW TABLES');
echo '<select name="tablename" style="height: 30px;">';
while ($tables = mysqli_fetch_row($tables_raw)) {
	echo '<option value=' . $tables[0] . '>' . $tables[0] . '</option>';
}
echo '</select>';
?>
<input type="hidden" value='-1' id='outputmethod' name="outputmethod"/>
<br><br>
<button class="btn btn-primary" onclick="opsqlosb(1);">导出数据和结构</button>
<button class="btn btn-primary" onclick="opsqlosb(2);">仅导出数据</button>
</form>
            </div>
			
			<div class="rightfloat" id="configfile">
                <h3>当前页面：<b>修改Config文件</b></h3>
                    <p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：z0gSh1u</p>
                <br />
				<p>Config文件内容：</p>
				<?php
				$cfgcont = file_get_contents('config.conf');
				echo "<form id='cfgedit'>";
				echo "<textarea rows='26' style='width:600px;' id='cfgarea' name='cfgarea'>" . $cfgcont . '</textarea>';
				echo <<<EOT
<button class="btn btn-warning" type="button" onclick="cfgeditsub('cfgedit');">确认保存</button>
EOT;
				echo '</form>';
				?>

           </div>
			
			<div class="rightfloat" id="scoreoutput">
                <h3>当前页面：<b>成绩导出功能</b></h3>
                    <p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：LongChen</p>
                <br />
                <form action="superfoo/superfoo_getList.php" method="get">
                    <p style="font-size: large">选择导出院系</p>
                    <p>本功能可迅速将成绩信息制成csv表格</p>
                    <select name="academyNum" style="height: 30px;">
                        <option value="00" selected="selected">全部</option>
                        <?php
						$jsonraw = file_get_contents('acanuminfo.json');
						$jsondecode = json_decode($jsonraw, TRUE);
						$infoarray = $jsondecode['academies'];
						$row = null;
						foreach ($infoarray as $row) {
							echo '<option value="' . $row['number'] . '">[' . $row['number'] . '] ' . $row['academy'] . '</option>';
						}
                        ?>
                    </select>
                    <br><br>
                    <button type="submit" class="btn btn-primary" style="width: 80px;">导 出</button>
                </form>
            </div>
			
			<div class='rightfloat' id='laoshiconf'>
				<h3>当前页面：<b>辅导员管理</b></h3>
					<p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：z0gSh1u</p>
				<br />
				<iframe src="superfoo/superfoo_fdylist.php" id='iflist' width="530px" height="500px"></iframe>
			</div>
			
			<div class='rightfloat' id='importsql'>
				<h3>当前页面：<b>导入SQL脚本</b></h3>
					<p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：z0gSh1u</p>
				<br />
				<p>本插件不对上传的文件做任何校验，误操作的结果可能是灾难性的。</p>
				<p>请小心操作！</p>
				<form action='superfoo/superfoo_importsql.php' method="post" enctype="multipart/form-data" id='sqlfileform'>
					<b>上传文件</b><input type='file' name='sqlfile' />
					<br>
					<input type="button" class='btn btn-danger' value='上传并执行' onclick="asksql();"/>
				</form>
			</div>

			<div class='rightfloat' id="setinfo">
				<h3>当前页面：<b>用户信息设置</b></h3>
					<p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：z0gSh1u</p>
				<br />
				<form action="superfoo/superfoo_setinfo.php" method="post">
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
			
			<div class='rightfloat' id="makequery">
				<h3>当前页面：<b>执行SQL查询</b></h3>
					<p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：z0gSh1u</p>
				<br />
				<p>请输入SQL查询语句：</p>
				<p>[ 多语句之间用英文半角分号;隔开 ]</p>
				<p>本插件不对提交的命令做任何校验，误操作的结果可能是灾难性的。</p>
				<p>请小心操作！</p>
				<form action="superfoo/superfoo_makequery.php" method="post">
				<textarea rows="18" class="form-control" style="width: 500px; margin: 5px 0 12px 0;" name="queryinfo"></textarea>
				<button type="submit" class="btn btn-primary" style="width: 100px;">提 交</button>
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
			
			<div class='rightfloat' id="serverinfo">
				<h3>当前页面：<b>服务器负载信息</b></h3>
					<p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：z0gSh1u</p>
				<br />
				<p><b>查询结果：</b></p>
				<?php
				include_once ('superfoo/superfoo_getsysinfo.php');
				getsysinfo();
 ?>
				<br><br>
				<p><b>结果示例：</b></p>
				<img src="img/sysinfomanual.png" alt="sysinfomanual"  />
			</div>

            <div class="rightfloat" id="startandend">
                <h3>当前页面：<b>竞赛开放与关闭</b></h3>
                <p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：LongChen</p>
                <br />
                <div id="begin"></div>
                
                <div id="end"></div>
                <br><p style="display: inline-block;"><b>当前状态：</b></p>
                <div id="flag" style="display: inline-block; font-size: larger; font-weight: bold;"></div>
                <br><br>
                <div id="setBeginTime">
                    <b><p>修改竞赛开始时间</p></b>
                    <input type="number" id="beginYear" min="1970" max="2038" style="text-align: center" />
                    -
                    <input type="number" id="beginMonth" min="1" max="12" style="text-align: center" />
                    -
                    <input type="number" id="beginDate" min="1" max="31" style="text-align: center" />
                    <br><br>
                    <input type="number" id="beginHour" min="0" max="23" style="text-align: center" />
                    :
                    <input type="number" id="beginMinute" min="0" max="59" style="text-align: center" />
                    <br><br>
                    <button onclick="onChange('begin');">确定</button>&nbsp;&nbsp;&nbsp;<button onclick="onNow('begin');">现在</button>
                </div>
                <br>
                <div id="setEndTime">
                    <b><p>修改竞赛结束时间</p></b>
                    <input type="number" id="endYear" min="1970" max="2038" style="text-align: center" />
                    -
                    <input type="number" id="endMonth" min="1" max="12" style="text-align: center" />
                    -
                    <input type="number" id="endDate" min="1" max="31" style="text-align: center" />
                    <br><br>
                    <input type="number" id="endHour" min="0" max="23" style="text-align: center" />
                    :
                    <input type="number" id="endMinute" min="0" max="59" style="text-align: center" />
                    <br><br>
                    <button onclick="onChange('end');">确定</button>&nbsp;&nbsp;&nbsp;<button onclick="onNow('end');">现在</button>
                </div>
                <br><br>
                <button onclick="onRefresh();">刷新</button>
                <br>
            </div>

            <div class="rightfloat" id="scoreinfo">
                <h3>当前页面：<b>院系分数报表</b></h3>
                <p>插件版本：v1.0&nbsp;&nbsp;&nbsp;提供者：LongChen</p>
                <br>
                	<button onclick="refreshAll();">更新缓存</button>
                	<br><br>
                <select name="chartType" id="chartType" onchange="onChangeChart_superadmin('chartType', 'chart');" style="height: 30px; margin-right: 20px;">
                    <option value="" selected="selected" disabled="disabled" style="display: none">请选择你要查看的报表</option>
                    <option value="0">院系答题情况</option>
                    <option value="1">平均分前十院系</option>
                    <option value="2">分数段统计</option>
                    <option value="3">优秀学生排名</option>
                </select>
                <br><br>
                <div id="chart"></div>
                <br />
            </div>
			
			
		</div>

	<br><br>
	</body>
</html>