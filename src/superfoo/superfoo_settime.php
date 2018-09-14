<?php 
include ('public_head_check.php');
?>
    <?php
    $xmlurl = $_GET["xmlurl"];
    $beginTime = $_GET["begin"];
    $endTime = $_GET["end"];
    $xmlfile = fopen($xmlurl, "w") or die("无法打开文件" . $xmlurl);
    fwrite($xmlfile, '<?xml version="1.0" encoding="ISO-8859-1"?><contest_time><begin>' . $beginTime . '</begin><end>' . $endTime . '</end></contest_time>');
    fclose($xmlfile);
?>