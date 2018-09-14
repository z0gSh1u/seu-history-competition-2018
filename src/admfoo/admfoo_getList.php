<?php
	include ('public_head_check.php');
?>
<?php
    // get config
    $V_CONF = include "../config.conf";
    $con = include('../getsqlcon.php');
    // get academy information
    $academy = $_POST["academyNum"];
	require_once('../tools/illegalCharCheck.php');
    // check input
	ilgCharCheck($academy);
    
	// process
    if(strlen($academy) == 1)
    {
        $academy = '0' . $academy;
    }
    if($academy == 0)
    {
        $query_score = "SELECT * FROM " . $V_CONF["sql-tablename"] . " ORDER BY stunum;";
    }
    else
    {
        $query_score = "SELECT * FROM " . $V_CONF["sql-tablename"] . " WHERE academy='" . $academy . "' ORDER BY stunum;";
    }
    $raw_score = mysqli_query($con,$query_score);
    if (mysqli_num_rows($raw_score) < 1)
    {
        echo '<script>alert("未查询到此院系信息")</script>';
        echo '<script>window.close();</script>';
        die();exit();return;
    }

    $ua = $_SERVER["HTTP_USER_AGENT;charset=gb2312"];
    if($academy == 0)
    {
        $filename = "";
    }
    else
    {
        $filename = "[" . $academy . "系]";
    }
    $filename .= "2018校史校情知识竞赛成绩册".date('m-d').".csv";
    $encoded_filename = urlencode($filename);
    $encoded_filename = str_replace("+", "%20", $encoded_filename);
    header("Content-Type: application/octet-stream");
    if (preg_match("/MSIE/", $_SERVER['HTTP_USER_AGENT']) ) {
        header('Content-Disposition:  attachment; filename="' . $encoded_filename . '"');
    } elseif (preg_match("/Firefox/", $_SERVER['HTTP_USER_AGENT'])) {
        header('Content-Disposition: attachment; filename*="utf8' .  $filename . '"');
    } else {
        header('Content-Disposition: attachment; filename="' .  $filename . '"');
    }

    echo chr(0xEF).chr(0xBB).chr(0xBF);
    echo "学号,一卡通号,姓名,成绩,\n";
    while($score = mysqli_fetch_assoc($raw_score))
    {
        echo $score['stunum'] . "\t," . $score['yktnum'] . "\t," . $score['name'] . ",";
        if($score['score'] == -1)
        {
            echo "未完成答题,";
        }
        else
        {
            echo strval($score['score']) . "\t,";
        }
        echo "\n";
    }
?>