<?php 
include ('public_head_check.php');
?>
<?php
$con =
include '../getsqlcon.php';
	require_once ('../tools/illegalCharCheck.php');
date_default_timezone_set('PRC');
$tablename = $_POST['tablename'];
$type = $_POST['outputmethod'];
ilgCharCheck_noudl($tablename);
ilgCharCheck($type);

$to_file_name = '../sqloutput/' . $tablename . '-' . date('m-d-H-i-s', time());
if ($type == 1)// both
	$to_file_name .= '-both.sql';
else// data only
	$to_file_name .= '-data.sql';

echo "运行中，请耐心等待...<br/><br/>导出文件：";
print_r($to_file_name);
$info = "-- ----------------------------\r\n";
$info .= "-- Date: " . date("Y-m-d H:i:s", time()) . "\r\n";
$info .= "-- ----------------------------\r\n\r\n";
file_put_contents($to_file_name, $info);

if ($type == 1)// both
{
	// output structure
	$sql = "SHOW CREATE TABLE " . $tablename;
	$res = mysqli_query($con, $sql);
	$row = mysqli_fetch_array($res);
	$info = "-- ----------------------------\r\n";
	$info .= "-- Table structure for `" . $tablename . "`\r\n";
	$info .= "-- ----------------------------\r\n";
	$info .= "DROP TABLE IF EXISTS `" . $tablename . "`;\r\n";
	$sqlStr = $info . $row[1] . ";\r\n\r\n";
	file_put_contents($to_file_name, $sqlStr, FILE_APPEND);
	mysqli_free_result($res);
}

$sql = "SELECT * FROM " . $tablename;
$res = mysqli_query($con, $sql);
$info = "-- ----------------------------\r\n";
$info .= "-- Records for `" . $tablename . "`\r\n";
$info .= "-- ----------------------------\r\n";
file_put_contents($to_file_name, $info, FILE_APPEND);

while ($row = mysqli_fetch_row($res)) 
{
	$sqlStr = "INSERT INTO `" . $tablename . "` VALUES (";
	foreach ($row as $zd) {
		$sqlStr .= "'" . $zd . "', ";
	}
	// Tail Process
	$sqlStr = substr($sqlStr, 0, strlen($sqlStr) - 2);
	$sqlStr .= ");\r\n";
	file_put_contents($to_file_name, $sqlStr, FILE_APPEND);
}
mysqli_free_result($res);

echo '<br><br>导出完成！点击下方链接下载：<br><br>';
echo '<a href="'.$to_file_name.'">'.$to_file_name.'</a>';
?>

