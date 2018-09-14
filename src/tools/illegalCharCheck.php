<?php
	function ilgCharCheck($str)
	{
		$ilgCharSet=<<<EOT
+-*/=,.< >!&?`'"()[]{}_%#\
EOT;
		for($i=0;$i<strlen($str);$i++)
		{
			for($j=0;$j<strlen($ilgCharSet);$j++)
			{
				if($ilgCharSet[$j] == $str[$i])
				{
					die('请求被服务器拒绝。');
					exit();
					return;
				}
			}
		}
	}
	
	function ilgCharCheck_noudl($str)
	{
		$ilgCharSet=<<<EOT
+-*/=,.< >!&?`'"()[]{}%#\
EOT;
		for($i=0;$i<strlen($str);$i++)
		{
			for($j=0;$j<strlen($ilgCharSet);$j++)
			{
				if($ilgCharSet[$j] == $str[$i])
				{
					die('请求被服务器拒绝。');
					exit();
					return;
				}
			}
		}
	}
?>