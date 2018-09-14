<?php 
include ('public_head_check.php');
?>
<?php
$con =
	include ('../getsqlcon.php');
$V_CONF = include "../config.conf";

	$ty = $_POST['type'];
	
	if($ty == 1) // sel
	{
		$qid = $_POST['selqueid'];
		$timu = $_POST['selquecont'];
		$sela = $_POST['selqA'];
		$selb = $_POST['selqB'];
		$selc = $_POST['selqC'];
		$seld = $_POST['selqD'];
		$right = $_POST['selans'];
		$sql =<<<EOT
INSERT INTO `{$V_CONF['que-sel-tablename']}` (`queid`, `que`, `sel1`, `sel2`, `sel3`, `sel4`, `ans`) VALUES ({$qid}, "{$timu}", "{$sela}", "{$selb}", "{$selc}", "{$seld}", {$right});
EOT;
	}
	else if($ty == 2) // tf
	{
		$qid = $_POST['tfqueid'];
		$timu = $_POST['tfquecont'];
		$right = $_POST['tfans'];
		$sql =<<<EOT
INSERT INTO `{$V_CONF['que-tf-tablename']}` (`queid`, `que`, `ans`) VALUES ({$qid}, "{$timu}", {$right});
EOT;
	}
	else
		{
			exit('非法请求！');die();
		}
	

	$res = mysqli_query($con, $sql);
	
	if (!$res){echo "<script>alert('发生错误！');window.location.href='superfoo_queslist.php';</script>";}
	else {echo "<script>alert('新增成功！');window.location.href='superfoo_queslist.php';</script>";}
?>