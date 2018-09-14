<?php 
include ('public_head_check.php');
?>
<?php
	$con =
	include ('../getsqlcon.php');
	$V_CONF = include "../config.conf";
	$data = json_decode($_POST['json'], TRUE);
	$ty = $data[0];
	$data = array_slice($data, 1);
	$sql = 'DELETE FROM ';
	if ($ty == 1) // del sel
	{
		$sql .=<<<EOT
`{$V_CONF['que-sel-tablename']}`
EOT;
	}
	else if ($ty == 2)
	{
	$sql .=<<<EOT
`{$V_CONF['que-tf-tablename']}`
EOT;
	}
	else
	{
		exit('非法请求！');die();
	}
	$sql .= 'WHERE queid in (';
	foreach ($data as $unit)
	{
		$sql .= intval($unit);
		$sql .= ',';
	}
	$sql = substr($sql, 0, strlen($sql) - 1);
	$sql .= ');';
	$res = mysqli_query($con, $sql);
	if ($res)
	{
		exit('执行成功！');
	}
	else
	{
		exit('发生错误！');
	}
?>