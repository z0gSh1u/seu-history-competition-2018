<?php
error_reporting(0);
$_SESSION = array();
if (isset($_COOKIE[session_name()])) 
{
	setcookie(session_name(), '', time() - 1, '/');
}
session_destroy();
session_unset();
unset($_SESSION);
echo "<html><script>alert('登出成功！');window.close();</script></html>";
?>