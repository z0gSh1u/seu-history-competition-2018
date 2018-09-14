<?php 
include ('public_head_check.php');
?>
<?php
$con =
include ('../getsqlcon.php');
$V_CONF = include "../config.conf";
require_once('../tools/illegalCharCheck.php');
$type = $_POST['type'];
$fdyid = $_POST['fdyid'];
ilgCharCheck($type);ilgCharCheck($fdyid);
if ($type == 0)// new
{
	$fdyname = $_POST['fdyname'];
	$fdypw = $_POST['fdypw'];
	$fdyaca = $_POST['fdyaca'];
	ilgCharCheck($fdyname);ilgCharCheck($fdypw);ilgCharCheck($fdyaca);
	$sql =<<<EOT
INSERT INTO `{$V_CONF['sql-ls-tablename']}` (`unl`, `name`, `pawl`, `academy`) VALUES ('{$fdyid}', '{$fdyname}', '{$fdypw}', '{$fdyaca}');
EOT;
}
if ($type == 1)// del
{
	$sql =<<<EOT
DELETE FROM `{$V_CONF['sql-ls-tablename']}` WHERE `unl`='{$fdyid}' LIMIT 1;
EOT;
}
else if ($type == 2)// name
{
	$fdyname = $_POST['fdyname'];ilgCharCheck($fdyname);
	$sql =<<<EOT
UPDATE `{$V_CONF['sql-ls-tablename']}` SET `name`='{$fdyname}' WHERE `unl`='{$fdyid}' LIMIT 1;
EOT;
}
else if ($type == 3)// pw
{
	$fdypw = $_POST['fdypw'];ilgCharCheck($fdypw);
	$sql =<<<EOT
UPDATE `{$V_CONF['sql-ls-tablename']}` SET `pawl`='{$fdypw}' WHERE `unl`='{$fdyid}' LIMIT 1;
EOT;
}
else if ($type == 4)// aca
{
	$fdyaca = $_POST['fdyaca'];ilgCharCheck($fdyaca);
	$sql =<<<EOT
UPDATE `{$V_CONF['sql-ls-tablename']}` SET `academy`='{$fdyaca}' WHERE `unl`='{$fdyid}' LIMIT 1;
EOT;
}
else
	{
		exit('非法请求！');die();
	}
$res = mysqli_query($con, $sql);

if($res) {exit('操作完成！');} else {exit('操作失败！');}
?>