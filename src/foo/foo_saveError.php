<?php
	error_reporting(0);
	$EMAIL = $_POST['email'];
	$ISSUE = $_POST['issue'];
	
	function writeLog($em, $is)
	{
		$fn = uniqid("issue_");
		$fn = $fn.mt_rand(0, 9).mt_rand(0, 9).mt_rand(0, 9);
		$fn = $fn.".txt";
		$fn = dirname(__FILE__).'/special_userissues/'.$fn;
		
		$fi = fopen($fn, "w");
		fwrite($fi, "Contact:  ".$em.PHP_EOL);
		fwrite($fi, "Issue: ".PHP_EOL);
		fwrite($fi, $is);
		fclose($fi);
	}
	
	writeLog($EMAIL, $ISSUE);
	echo '<script>alert("提交成功！");</script>';
	echo "<script>window.location.href=('../index.php');</script>";
?>