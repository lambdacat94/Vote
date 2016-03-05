<?php
require_once('init.php');
?>

		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title>投票程序</title>
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" href="./css/index.css" type="text/css" />
 <style>
 dl{
	height:200px;
	width:20%;
	margin-top:5px;
	float:left;
}
 </style>
  <script type="text/javascript" src="./index.js"></script>
 </head>
 <body>
<div id="" class="big">
	
	<div id="left-tab" class="left fl">
		<div id="" class="style1" style="display:none">
		</div>
		
		
	
<?php
$Con->Intset();
		echo '
	</div>
	<div id="" class="right rt">
	<div id="" class="div-h3">
		<h3>感谢您投票&nbsp;<a href="./index.php?action=login">登陆</a>版权所有</h3>
		
	</div>';
				
switch($action)
{
	case "login":		//登录
		$Con->Login(); break;
	case "tou":		//投票表单提交
		// print_r($_POST[tuser]);
		$Con->Add($_POST); break;
	case "sel":		//查询
	// echo 1;
		$Con->Sel();break;
	default:
		$Con->Sel('all');		//查询所有投票选项
; break;
}
?>
	</div>
	
</div>
 </body>
</html>