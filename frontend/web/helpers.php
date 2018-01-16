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

function flasher($msg, $type='') {
	if(!$msg) return;
	if($type)  $type = "_$type";
	app('session')->flash("flash_message{$type}", $msg);
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

/**
	二维数组转成一维
*/
function tow2one($ar) {
	if(!$ar) return;

	$ks = array_keys($ar[0]);
	$vs = array_values($ar[0]);

	$k1 = $ks[0];
	$k2 =  $ks[1];

	foreach($ar as $k => $v) {
		$arr[$v[$k1]] = $v[$k2];
	}

	return $arr;
}

function get_array($sql)
{
	$ret = \DB::select($sql);
	$arr = json_decode(json_encode($ret),true);
	return tow2one($arr);
}

/**
 ids转成对应的values
*/
function ids2names($ids, $arr, $sep=", ") {
	if(!$arr) return;
	$ida = explode(',', $ids);
	foreach($ida as $v) {
		$ret[] = $arr[$v];
	}
	return implode($sep, $ret);
}

function roles2name($ids, $sep=", ") {
	$ret = cache_roles();
	if(!$ret) return;
	return ids2names($ids, array_flip($ret), $sep);
}

function perms2name($ids, $sep=", ") {
	$ret = cache_perms();
	if(!$ret) return;
	return ids2names($ids, array_flip($ret), $sep);
}

// 缓存全部角色
function cache_roles($update = 0) {
	$redis = 'Illuminate\Support\Facades\Redis';
	$ret = $redis::get('roles');
	if(!$update && $ret) return json_decode($ret, true);
	$ret = get_array('select name, id from roles');
	if(!$ret) return;
	$redis::set('roles', json_encode($ret));
//	echo rand(),'<br />';
	return $ret;
}

// 缓存全部权限
function cache_perms($update = 0) {
	$redis = 'Illuminate\Support\Facades\Redis';
	$ret = $redis::get('perms');
	if(!$update && $ret) return json_decode($ret, true);
	$ret = get_array('select name, id from permissions');
	if(!$ret) return;
	$redis::set('perms', json_encode($ret));
//	echo rand(),'<br />';
	return $ret;
}


function is_str_in($needle, $haystack) {
	$needle = trim($needle) ;
	if(strpos(','.$haystack.',', ','.$needle.',') !== false ) {
		return true;
	}
}

/**
	判断角色是否存在，用于视图调用，支持中英文
	roles('editor');
	roles('超级管理员, Admin');
*/
function roles($names) {
	$rid = session('role_id');
	if(!$rid) return;

	if($rid == 1 || strpos(','.$rid.',', ",1,") !== false ) {
		return true;
	}

	$u_roles = roles2name($rid, ',');
	$arr = explode(',', $names);

	foreach($arr as $v) {
		if(is_str_in($v, $u_roles)) {
			return true;
		}
	}
}

/**
	判断角色是否存在，用于控制器调用
	roles('editor');
	roles('超级管理员, Admin');
*/
function roles_require($names) {
	if(roles($names)) {
		return;
	}
	msg("角色未授权");
}

/**
	判断权限是否存在，用于视图调用
	perms('user_add');
	perms('user_add, user_edit');
*/
function perms($names) {
	$rid = session('role_id');
	if(!$rid) return;
	if($rid == 1 || strpos(','.$rid.',', ",1,") !== false ) {
		return true;
	}

	$pmsid = app('session')->get("perm_id");
	$u_pms = perms2name($pmsid, ',');
	$arr = explode(',', $names);

	foreach($arr as $v) {
		if(is_str_in($v, $u_pms)) {
			return true;
		}
	}
}

/**
	判断权限是否存在，用于控制器调用
	perms_require('user_add');
	perms_require('user_add, user_edit');
*/
function perms_require($names) {
	if(strpos($names, 'Controller::')) {
		$names = strtolower(str_replace('Controller::', '_', basename($names)));
	}

	if(perms($names)) {
		return;
	}
	msg();
}

/**
 登录后写入必要session和缓存
*/
function set_sessinfo($user=null) {
	if(session('id')) return;
	echo rand();
	if(!$user) $user = auth()->user();

	app('session')->put("id", $user->id);
	app('session')->put("name", $user->name);
	app('session')->put("role_id", $user->role_id);
	app('session')->put("last_login", $user->last_login);

	$times = date('Y-m-d H:i:s',time());
	\DB::table('users')->where('id', $user->id)->update(['last_login' => $times]);
	$rets = \DB::select("select GROUP_CONCAT(perm_id) as ids from roles where id in($user->role_id)");
	app('session')->put("perm_id", $rets[0]->ids);

	cache_roles();
	cache_perms();
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
#msgcenter{display:block;margin-top:10px;font-size:14px;}
.msg{line-height:1.7;padding:5px 0;}
</style>
</head>
<body>
<div id="msgbox">
	<div class="msg">$msg</div>
	<center id="msgcenter"><a href="$url">返回上一页</a></center>
</div>

</body></html>
EOT;
die();
}



?>