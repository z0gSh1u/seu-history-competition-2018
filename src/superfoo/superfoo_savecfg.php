<?php 
include ('public_head_check.php');
?>
<?php
$cont = $_POST['cfgarea'];
$numbytes = file_put_contents('../config.conf', $cont);
if ($numbytes) {
	exit('OK');
} else {
	exit('Failed');
}
?>