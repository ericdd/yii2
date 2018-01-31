<?php

function printr($str)
{
	if(is_array($str) || is_object($str)) {
		echo '<pre>';
		print_r($str);
		echo '</pre>';
		return;
	}
		echo '<pre>';
		echo $str;
		echo '</pre>';
}

function removeBacktraceArg($a){
	foreach($a as $k=>$v){
		if($k=='args' || $k=='object') unset($a[$k]);
	}
	return $a;
}

function is_post() {
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function pwd($str, $salt='DFSF4B5vbcb9') {
	return md5(sha1($salt.$str));
}

function bsize($str)
{
	foreach (array('', 'K', 'M', 'G') as $i => $k)
	{
		if ($str < 1024) break;
		$str /= 1024;
	}
	return sprintf("%5.2f %sB", $str, $k);
 }

function getOs()
{
	if (!empty($_SERVER['HTTP_USER_AGENT']))
	{
		$OS = $_SERVER['HTTP_USER_AGENT'];
		if (preg_match('/win/i', $OS))
		{
			$OS = 'Windows';
		}elseif (preg_match('/mac/i', $OS))
		{
			$OS = 'MAC';
		}elseif (preg_match('/linux/i', $OS))
		{
			$OS = 'Linux';
		}elseif (preg_match('/unix/i', $OS))
		{
			$OS = 'Unix';
		}elseif (preg_match('/bsd/i', $OS))
		{
			$OS = 'BSD';
		}
		else
		{
			$OS = 'Other';
		}
		return $OS;
	}
	else
	{
		return "获取访客操作系统信息失败！";
	}
}

function getip()
{
	if ($_SERVER['REMOTE_ADDR']) $ip = $_SERVER['REMOTE_ADDR'];
	else if (getenv('HTTP_CLIENT_IP')) $ip = getenv('HTTP_CLIENT_IP');
	else if (getenv('HTTP_X_FORWARDED_FOR')) $ip = getenv('HTTP_X_FORWARDED_FOR');
	return $ip;
}


function get_current_url()
{
	return 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . (($_SERVER['SERVER_PORT'] == 80 || $_SERVER['SERVER_PORT'] == 443) ? '' : ':' . $_SERVER['SERVER_PORT']) . $_SERVER['REQUEST_URI'];
}

function msg($msg = '未授权', $url = -1, $type = 0)
{
	if (!$url || $url == -1)
	{
		$url = "javascript:history.back(-1);";
	}

	$style = 'background:#F2DEDF;border:1px solid #e1bcc2;color:#a40';
	if($type == 1) {
		$style = 'background:#DEF0D8;border:1px solid #bcd1aa;color:#3C763C';
	}

print <<<EOT
<!DOCTYPE html>
<html>
<head>
<title>跳转提示</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
*{margin:0;padding:0;border:none;}
body{background:#fff;font-family:"Microsoft YaHei",Tahoma,Helvetica;font-size:14px;color:#333;}
body a{text-decoration:none;color:#000;}
body a:hover{text-decoration:underline;}
#msgbox{width:50%;max-width:800px;margin:7% auto;$style;border-radius:3px;padding:20px 30px;overflow-x:hidden;}
#msgcenter{display:block;margin-top:10px;font-size:14px;text-align:center;}
.msg{line-height:1.7;padding:5px 0;}
</style>
</head>
<body>
<div id="msgbox">
	<div class="msg">$msg</div>
	<div id="msgcenter"><a href="$url">返回上一页</a></div>
</div>

</body></html>
EOT;
die();
}



?>