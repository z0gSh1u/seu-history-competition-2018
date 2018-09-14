<?php 
include ('public_head_check.php');
?>
<?php
if ($_FILES['sqlfile']['error'] > 0) {
	echo "发生错误。错误信息: " . $_FILES["file"]["error"];
	die();
	exit();
}
$newname = uniqid().'-by-'.$_SESSION['name'];
move_uploaded_file($_FILES['sqlfile']['tmp_name'], 'sqlscripts/' . $newname . $_FILES['sqlfile']['name']);
echo "文件上传成功，正在等待执行。<br><br>";
$sqlfileurl = '../sqlscripts/' . $newname . $_FILES['sqlfile']['name'];
echo $sqlfileurl;
echo "<br><br>";
$V_CONF =
include "../config.conf";

// get sql info
$SQ_HOST = $V_CONF["sql-servername"];
$SQ_USR = $V_CONF["sql-username"];
$SQ_PWD = $V_CONF["sql-password"];
$SQ_DBNAME = $V_CONF["sql-dbname"];
$SQ_PORT = $V_CONF["sql-port"];
$SQ_TBN = $V_CONF["sql-tablename"];

$_sql = file_get_contents($sqlfileurl);
$_arr = explode(';', $_sql);
$_mysqli = new mysqli($SQ_HOST, $SQ_USR, $SQ_PWD, $SQ_DBNAME, $SQ_PORT);
if (mysqli_connect_errno()) {
	exit('连接数据库出错！');
}

foreach ($_arr as $_value) {
	$_mysqli -> query($_value . ';');
}
$_mysqli -> close();
$_mysqli = null;
echo "SQL脚本执行完成，请关闭本页面。";
?>