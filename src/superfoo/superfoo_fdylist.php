<?php 
include ('public_head_check.php');
?>
<!DOCTYPE HTML>
<html>
	<meta charset="utf-8" />
	<script src="../js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
	<body>
		<h2>&nbsp;&nbsp;辅导员用户情况表</h1>
		<table border="1" width="500px" class="table table-hover table-bordered">
			<tr class="info">
				<th align="center">辅导员用户名</th>
				<th align="center">辅导员姓名</th>
				<th align="center">辅导员密码</th>
				<th align="center">辅导员学院</th>
			</tr>
			<?php
			$con =
			include ('../getsqlcon.php');
			$V_CONF = include "../config.conf";
			$queryinfo = 'SELECT * FROM ' . $V_CONF['sql-ls-tablename']. ' ORDER BY `academy`;';
			$rawres = mysqli_query($con, $queryinfo);
			$acainfojson = file_get_contents('acanuminfo.json');
			$acainfo = json_decode($acainfojson, TRUE);
			$acainfo = $acainfo['academies'];
			while ($res = mysqli_fetch_array($rawres, MYSQLI_ASSOC)) {
				echo '<tr>';
				echo '<td>' . $res['unl'] . '</td>';
				echo '<td>' . $res['name'] . '</td>';
				echo '<td>' . $res['pawl'] . '</td>';
				echo '<td>' . $res['academy'] . ' ';
				foreach ($acainfo as $one)
					if ($one['number'] == $res['academy']) {
						echo $one['academy'];
						break;
					}
				echo '</td>';
				echo '</tr>';
			}
			?>
		</table>
		&nbsp;&nbsp;
		<button onclick="oncallsetfdy('new');">
		新增
		</button>
		<button onclick="oncallsetfdy('del');">
		删除
		</button>
		<button onclick="oncallsetfdy('cn');">
		改名
		</button>
		<button onclick="oncallsetfdy('cpw');">
		改密
		</button>
		<button onclick="oncallsetfdy('caca');">
		改学院
		</button>
		<script>var cur = null;

function oncallsetfdy(ty) {
	if(cur != null) {
		document.getElementById(cur).style.display = 'none';
	}
	document.getElementById(ty).style.display = 'inline-block';
	cur = ty;
}</script>
		<br>
		<br>
		<script>function fdysetsub(id) {
	$.ajax({
		type: "POST",
		url: "superfoo_setfdy.php",
		data: $('#' + id).serialize(),
		success: function(data) {
			alert(data);
			location.reload();
		},
		error: function() {
			alert('发生错误！');
		}
	})
}</script><!-- new -->
		<form method="post" action="superfoo_setfdy.php" style="display: none;" id='new'>
			<input name="type" id="type" type="hidden" value="0"/>
			&nbsp;&nbsp;<input name="fdyid" id="fdyid" placeholder="辅导员用户名">
			</input>
			<br>
			&nbsp;&nbsp;<input name="fdyname" id="fdyname" placeholder="新姓名">
			</input>
			<br>
			&nbsp;&nbsp;<input name="fdypw" id="fdypw" placeholder="新密码">
			</input>
			<br>
			&nbsp;&nbsp;<input name="fdyaca" id="fdyaca" placeholder="新学院代码">
			</input>
			<br>
			&nbsp;&nbsp;<button type="button" onclick="fdysetsub('new');">
			确认新增
			</button>
		</form><!-- delete -->
		<form style="display: none;" id='del'>
			<input name="type" id="type" type="hidden" value="1"/>
			&nbsp;&nbsp;<input name="fdyid" id="fdyid" placeholder="辅导员用户名">
			</input>
			<br>
			&nbsp;&nbsp;<button type="button" onclick="fdysetsub('del');">
			确认删除
			</button>
		</form><!-- edit name -->
		<form style="display: none;" id='cn'>
			<input name="type" id="type" type="hidden" value="2"/>
			&nbsp;&nbsp;<input name="fdyid" id="fdyid" placeholder="辅导员用户名">
			</input>
			<br>
			&nbsp;&nbsp;<input name="fdyname" id="fdyname" placeholder="新姓名">
			</input>
			<br>
			&nbsp;&nbsp;<button type="button" onclick="fdysetsub('cn');">
			确认改名
			</button>
		</form><!-- edit password -->
		<form style="display: none;" id='cpw'>
			<input name="type" id="type" type="hidden" value="3"/>
			&nbsp;&nbsp;<input name="fdyid" id="fdyid" placeholder="辅导员用户名">
			</input>
			<br>
			&nbsp;&nbsp;<input name="fdypw" id="fdypw" placeholder="新密码">
			</input>
			<br>
			&nbsp;&nbsp;<button type="button" onclick="fdysetsub('cpw');">
			确认改密
			</button>
		</form><!-- edit academy -->
		<form style="display: none;" id='caca'>
			<input name="type" id="type" type="hidden" value="4"/>
			&nbsp;&nbsp;<input name="fdyid" id="fdyid" placeholder="辅导员用户名">
			</input>
			<br>
			&nbsp;&nbsp;<input name="fdyaca" id="fdyaca" placeholder="新学院代码">
			</input>
			<br>
			&nbsp;&nbsp;<button type="button" onclick="fdysetsub('caca');">
			确认改学院
			</button>
		</form>
	</body>
</html>
