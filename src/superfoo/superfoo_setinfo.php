<?php 
include ('public_head_check.php');
?>
<?php
    $V_CONF = include "../config.php";
    $con = include('../getsqlcon.php');
	require_once('../tools/illegalCharCheck.php');
	ilgCharCheck($_POST["stuNum"]);ilgCharCheck($_POST["yktNum"]);ilgCharCheck($_POST["name"]);
    if($_POST["stuNum"] == "")
    {
        echo '<script>alert("学号不可为空");</script>';
        echo '<script>window.close();</script>';
        die();exit();return;
    }
    if(mysqli_num_rows(mysqli_query($con, "SELECT * FROM " . $V_CONF["sql-tablename"] . " WHERE stunum='" . $_POST["stuNum"] . "'")) < 1)
    {
        echo '<script>alert("未找到学号为" + ' . $_POST["stuNum"] . '+ "的学生");</script>';
        echo '<script>window.close();</script>';
        die();exit();return;
    }

    $update_info_1 = "UPDATE " . $V_CONF["sql-tablename"] . " SET ";
    $update_info_2 = " WHERE stunum='" . $_POST["stuNum"] . "'";
    if($_POST["yktNum"] != "")
    {
        mysqli_query($con, $update_info_1 . "yktnum='" . $_POST["yktNum"] . "'" . $update_info_2);
    }
    if($_POST["name"] != "")
    {
        mysqli_query($con, $update_info_1 . "name='" . $_POST["name"] . "'" . $update_info_2);
    }

    echo '<script>alert("' . $_POST["stuNum"] . '的信息修改完成");</script>';
    echo '<script>window.close();</script>';
    die();exit();return;
?>