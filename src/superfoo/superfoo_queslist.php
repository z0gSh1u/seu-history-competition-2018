<?php 
include ('public_head_check.php');
?>
<!DOCTYPE HTML>
<html>
	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="../js/spf-queslist-js.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
	<head>
		<meta charset="utf-8" />
		<title>题库管理</title>
	</head>
	<body>
		&nbsp;&nbsp;说明：1、判断题答案1代表正确，0代表错误
		<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;2、请勿频繁重复请求本页面
		<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;3、题目较多时，请善用Ctrl+F进行查找
		<br>
		&nbsp;&nbsp;快速跳转锚点：
		<br>
		&nbsp;&nbsp;&nbsp;
		<button><a href="#apdt">
			判断题锚点
		</a></button>

		&nbsp;&nbsp;&nbsp;
		<button><a href="#apdtu">
			选择题管理键锚点
		</a></button>
		
		&nbsp;&nbsp;&nbsp;
		<button><a href="#adptm">
			判断题管理键锚点
		</a></button>
		<br>
		<h2>&nbsp;&nbsp;选择题题库</h1>
		<form id='sellib' method="post" action="superfoo_quesedit.php">
		<table border="1" width="95%" class="table table-bordered table-hover">
			<tr class="info">
				<th align="center" width="3%">#</th>
				<th align="center" width="4%">qid</th>
				<th align="center" width="29%">题面</th>
				<th align="center" width="15%">选项A</th>
				<th align="center" width="15%">选项B</th>
				<th align="center" width="15%">选项C</th>
				<th align="center" width="15%">选项D</th>
				<th align="center" width="4%">正答</th>
			</tr>
			<?php
			$con =
			include ('../getsqlcon.php');
			$V_CONF = include "../config.conf";
			$queryinfo = 'SELECT * FROM ' . $V_CONF['que-sel-tablename'].' ORDER BY queid';
			$rawres = mysqli_query($con, $queryinfo);
			$i = 1;
			while ($res = mysqli_fetch_array($rawres, MYSQLI_ASSOC)) {
				echo '<tr>';
				echo '<td>' . '<input type="checkbox" name="selcb[]" id="selcb'.$i.'" value=' . $res['queid'] . ' />';
				// id: 当前页面排序
				// value: qid
				echo '<td>' . $res['queid'] . '</td>';
				echo '<td>' . $res['que'] . '</td>';
				echo '<td>' . $res['sel1'] . '</td>';
				echo '<td>' . $res['sel2'] . '</td>';
				echo '<td>' . $res['sel3'] . '</td>';
				echo '<td>' . $res['sel4'] . '</td>';
				echo '<td>' . chr(65+$res['ans']-1) . '</td>';
				echo "</tr> \n";
				$i++;
			}
			?>
		</table> 
		<a name='apdtu'></a>
		&nbsp;&nbsp;选择题操作：
		<button onclick="allsel(1);" type="button">
		全选
		</button>&nbsp;
		<button onclick="allrev(1);" type="button">
		反选
		</button>&nbsp;
		<button type="button" onclick="delquestion(1);">
		批量删除
		</button>&nbsp;
		<button type="button" onclick="document.getElementById('newsel').style.display = 'block';">
		新增题目
		</button>
		</form><br>
		<form method="post" action="superfoo_quesnew.php" style="display: none;" id='newsel'>
			<p>&nbsp;&nbsp;&nbsp;&nbsp;【大规模新增请使用SQL相关功能！】</p>
			<input name="type" id="type" type="hidden" value="1"/>			&nbsp;&nbsp;
			<input name="selqueid" id="selqueid" placeholder="问题ID（严禁重复）" />
			<br>&nbsp;&nbsp;
			<input name="selquecont" id="selquecont" placeholder="选择题题面" style="width: 350px;"/>
			<br>&nbsp;&nbsp;
				<input name="selqA" id="selqA" placeholder="选项A"  style="width: 350px;"/>
			<br>&nbsp;&nbsp;
				<input name="selqB" id="selqB" placeholder="选项B"  style="width: 350px;"/>
			<br>&nbsp;&nbsp;
				<input name="selqC" id="selqC" placeholder="选项C"  style="width: 350px;"/>
			<br>&nbsp;&nbsp;
				<input name="selqD" id="selqD" placeholder="选项D"  style="width: 350px;"/>
			<br>&nbsp;&nbsp;
			<input name="selans" id="selans" placeholder="选择题答案（请用1、2、3、4表示）"   style="width: 350px;"/>
			</input>
			<br>
			<br>&nbsp;&nbsp;
			<button type="button" onclick="document.getElementById('newsel').submit();">
			确认新增
			</button>
		</form>
		<br>
		<br>
		<a name='apdt'></a><h2>&nbsp;&nbsp;判断题题库</h1>
		<table border="1" width="95%" class="table table-bordered table-hover">
			<tr class="info">
				<th align="center" width="3%">#</th>
				<th align="center" width="4%">qid</th>
				<th align="center">题面</th>
				<th align="center" width="5%">正答</th>
			</tr>
			<?php
			$queryinfo = 'SELECT * FROM ' . $V_CONF['que-tf-tablename'].' ORDER BY queid';
			$rawres = mysqli_query($con, $queryinfo);
			while ($res = mysqli_fetch_array($rawres, MYSQLI_ASSOC)) {
				echo '<tr>';
				echo '<td>' . '<input type="checkbox" name=tfcb[] value=' . $res['queid'] . ' />';
				echo '<td>' . $res['queid'] . '</td>';
				echo '<td>' . $res['que'] . '</td>';
				echo '<td>' . $res['ans'] . '</td>';
				echo "</tr> \n";
			}
			?>
		</table> &nbsp;&nbsp;选择题操作：
		<button onclick="allsel(2);">
		全选
		</button>&nbsp;
		<button onclick="allrev(2);">
		反选
		</button> &nbsp;
		<button onclick="delquestion(2);">
		批量删除
		</button>&nbsp;
		<button  onclick="document.getElementById('newtf').style.display = 'block';">
		新增题目
		</button>
		<form method="post" action="superfoo_quesnew.php" style="display: none;" id='newtf'>
			<p>&nbsp;&nbsp;&nbsp;&nbsp;【大规模新增请使用SQL相关功能！】</p>
			<input name="type" id="type" type="hidden" value="2"/>			&nbsp;&nbsp;
			<input name="tfqueid" id="tfqueid" placeholder="问题ID（严禁重复）" />
			<br>&nbsp;&nbsp;
			<input name="tfquecont" id="tfquecont" placeholder="判断题题面" style="width: 350px;"/>
			<input name="tfans" id="tfans" placeholder="判断题答案（1正确，0错误）"   style="width: 350px;"/>
			</input>
			<br>
			<br>&nbsp;&nbsp;
			<button type="button" onclick="document.getElementById('newtf').submit();">
			确认新增
			</button>
		</form>
		<a name='adptm'></a>
		<br>
		<br>
		<br>
	</body>
</html>
