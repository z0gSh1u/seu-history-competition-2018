<?php
function getsysinfo(){
	$output = '';
    if(strtolower(PHP_OS) != 'linux'){
        $output = "请在Linux下部署以使用本功能.";
    }
	else{
    $result_status = '';
    $command = 'uptime';
    exec($command, $output, $result_status);
	}
    print_r($output);
}
?>