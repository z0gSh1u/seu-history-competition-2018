<html>
<meta charset="utf-8">
<?php 
	include ('public_head_check.php');
?>
<?php
$stu = $_GET['stuNum'];
$ykt = $_GET['yktNum'];
$nam = $_GET['name'];
require_once('../tools/illegalCharCheck.php');
ilgCharCheck($stu);ilgCharCheck($ykt);ilgCharCheck($nam);
$con =
include ('../getsqlcon.php');
$V_CONF = include "../config.conf";
if ($stu != null)	// main key stu
{
	$qry =<<<EOT
SELECT `stunum`,`yktnum`,`name` FROM `{$V_CONF["sql-tablename"]}` WHERE stunum='{$stu}' LIMIT 1;
EOT;
	$rawres = mysqli_query($con, $qry);
} else if ($ykt != null) {
	$qry =<<<EOT
SELECT `stunum`,`yktnum`,`name` FROM `{$V_CONF["sql-tablename"]}` WHERE yktnum='{$ykt}' LIMIT 1;
EOT;
	$rawres = mysqli_query($con, $qry);
} else if ($nam != "") {
	$qry =<<<EOT
SELECT `stunum`,`yktnum`,`name` FROM `{$V_CONF["sql-tablename"]}` WHERE name='{$nam}';
EOT;
	$rawres = mysqli_query($con, $qry);
} else {
	echo "<script>alert('请检查所填信息！');</script>";
	die();
	exit();
}
echo "<h2>查询完成</h3>";
echo <<<EOT
<table border="1" >
<tr>
			<th align="center" width="110px">学号</th>
			<th align="center" width="110px">一卡通号</th>
			<th align="center" width="220px">姓名</th>

</tr>
EOT;
while ($cookedres = mysqli_fetch_array($rawres, MYSQLI_ASSOC)) 
{echo <<<EOT
<tr>
			<td align="center" >{$cookedres['stunum']}</td>
			<td align="center" >{$cookedres['yktnum']}</td>
			<td align="center" >{$cookedres['name']}</td>
</tr>
EOT;
}
echo "</table>"
?>
</html>