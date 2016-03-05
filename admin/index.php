<?php
require_once('../init.php');	?>	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <title>投票程序————-后台</title>
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" href="../css/index.css" type="text/css" />
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
		<h3>感谢您投票&nbsp;<a href="./index.php?action=login">登陆</a>
		<a href="./index.php?action=add&sel=class">增加分类</a>
		<a href="./index.php?action=add&sel=formos">增加投票</a>
		
		</h3>
	</div>';
if(empty($_SESSION['login']) || $_SESSION['login']!=intval(1)){
	$_SESSION['login']==0;
	//显示form登陆表单
	// echo "<script>location.href='../index.php?action=login'</script>";
}else{
// echo $_SESSION['login'];
	/* 查询 */
	if($action=='sel'){
	// echo 1;
		$Con->Sel(0,1);
	}
	/* 增加 */
	else if($action=='add'){
			switch($_GET['sel']){
				case "formos":		//增加投票
					$Con->formos(); break;
				case 'class':		//增加分类
					$Con->Addclass();break;
				case 'classsel':
					echo "查询分类";break;
				case 'formos':
					echo 1;
					$Con->formos();break;
		}
	
	
	}
	/* 删除 */
	else if($action=='del'){
			switch($_GET['del']){
			case 'class':		//删除分类
				$Con->Del(0,$_GET[id]);break;
			case 'top':		//删除投票选项
				$Con->Del($_GET[id]);break;
		}
	
	
	}
	/* 修改 */
	// else if($action='update'){
			// switch($_GET['sel']){
			// case 'all':
				// echo "查询所有";break;
			// case 'allclass':
				// echo "查询分类所有投票";break;
			// case 'classsel':
				// echo "查询分类";break;
		// }
	
	
	// }
}
?>
	</div>
	
</div>
 </body>
</html>