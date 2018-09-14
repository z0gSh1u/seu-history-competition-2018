<?php
include ('public_head_check.php');
?>
<?php
			$con =
			include ('../getsqlcon.php');

	$type = $_POST['type'];
	$xuehao = $_POST['stuNum'];
	$V_CONF = include "../config.conf";
	if ($type == 0)
	{
		$sql =<<<EOT
SELECT `finishans` FROM `{$V_CONF['sql-tablename']}` WHERE stunum = '{$xuehao}' LIMIT 1;
EOT;
		$raw = mysqli_query($con, $sql);
		if(mysqli_num_rows($raw)==0)
		{exit('查无此用户。');}
		$row = mysqli_fetch_assoc($raw)['finishans'];
		if($row == 1)
		{exit('该用户已答题。');}
		else if($row == 0)
		{exit('该用户未答题。');}
	}
	
	if ($type == 1) // set yes
	{
		$sql =<<<EOT
UPDATE `{$V_CONF['sql-tablename']}` SET `finishans`='1' WHERE (`stunum`='{$xuehao}');
EOT;
		$raw = mysqli_query($con, $sql);
		exit('已设置为【已】答题。若此用户不存在，则此操作无任何结果');
	}
	if ($type == 2) // set yes
	{
		$sql =<<<EOT
UPDATE `{$V_CONF['sql-tablename']}` SET `finishans`='0', `score`='-1' WHERE (`stunum`='{$xuehao}');
EOT;
		$raw = mysqli_query($con, $sql);
		exit('已设置为【未】答题。若此用户不存在，则此操作无任何结果');
	}
?>