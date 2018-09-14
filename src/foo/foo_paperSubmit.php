<?php 
include ('public_head_check.php');
?>
<?php
	$rawans = $_POST['answers'];
	$ans = json_decode($rawans, TRUE);
	$V_CONF = include "../config.conf";
	$con = include('../getsqlcon.php');
	$finalmark = 0;
	$stuNum = $_SESSION["stuNum"];
	$selplus = intval($V_CONF['que-sel-cost']);
	$tfplus = intval($V_CONF['que-tf-cost']);
	// check finishans, avoid duplicate submission
	$firstansquery = "SELECT `finishans` FROM `xsxqsql` WHERE (stuNum=".$_SESSION["stuNum"]." ) LIMIT 1";
	$raw_finish = mysqli_query($con, $firstansquery);
	$finishstts = mysqli_fetch_assoc($raw_finish);
	$finishstts = $finishstts['finishans'];
	if($finishstts == 1)
	{
   		session_unset();
    	session_destroy();
    	unset($_SESSION);
    	die();
    	exit();
    	return;
	}
	// calculate score
	foreach($ans as $key => $v)
	{
		if(strlen($key) >= 3 && substr($key, 0, 2) == 'TF') 
		// is tf
		{
			$tfid = substr($key, 2);
			$tfid = intval($tfid);
			// get right ans
			$queryinfo =<<<EOT
SELECT ans FROM `{$V_CONF['que-tf-tablename']}` WHERE queid={$tfid} LIMIT 1;
EOT;
			// except process
			$rawres = mysqli_query($con, $queryinfo);
			if (mysqli_num_rows($rawres) < 1)
			{
				continue;
			}
			$rightans = mysqli_fetch_assoc($rawres)['ans'];
			if($rightans == $v){$finalmark = $finalmark + $tfplus;}
		}
		else 
		// is sel
		{
			$selid = intval($key);
			// get right ans
			$queryinfo =<<<EOT
SELECT ans FROM `{$V_CONF['que-sel-tablename']}` WHERE queid={$selid} LIMIT 1;
EOT;
			$rawres = mysqli_query($con, $queryinfo);
			// except process
			if (mysqli_num_rows($rawres) < 1)
			{
				continue;
			}
			$rightans = mysqli_fetch_assoc($rawres)['ans'];
			if($rightans == $v){$finalmark = $finalmark + $selplus;}
		}
	}
	// update score and ans status
	require_once ('../tools/illegalCharCheck.php');
	ilgCharCheck($_SESSION['stuNum']); ilgCharCheck($finalmark);
	$queryupdscore = 'UPDATE xsxqsql SET score=' . $finalmark. " WHERE stunum='" . $_SESSION['stuNum'] . "' LIMIT 1;";
	$queryupdstts = "UPDATE xsxqsql SET finishans=1 WHERE stunum='" . $_SESSION['stuNum'] . "' LIMIT 1;";
	mysqli_query($con, $queryupdscore);
	mysqli_query($con, $queryupdstts);
?>