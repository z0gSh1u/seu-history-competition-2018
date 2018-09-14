<?php 
include ('public_head_check.php');
?>
<?php
$con =
include ('../getsqlcon.php');
include_once ('safe_token.php');

// verify token
if (!Crumb::verifyToken($_SESSION['superUsrname'], $_SESSION['token'])) { die('Access Denied.');
	exit();
}

// get query info
$QUERY = $_POST['queryinfo'];
$token = strtok($QUERY, ";");
$to_file_name = '../sqlupload/singleExec/log.txt';
date_default_timezone_set('PRC');
while ($token !== false) {
	$RETURN = mysqli_query($con, $token);
	// make log
	$logStr = '[ '. date('m-d-h-i-s').'] '.'[ '. $_SESSION['name'].' ] ';
	$logStr .= $token;
	$logStr .= PHP_EOL;
	file_put_contents($to_file_name, $logStr, FILE_APPEND);
	print_r($RETURN);
	if ($RETURN == null) {echo "[NULL]";
	}
	echo "<br>一次查询完成. 上方是return内容.<br>";
	$token = strtok(";");
}

echo "<br><h3>查询执行完毕。</h3><br>";
?>