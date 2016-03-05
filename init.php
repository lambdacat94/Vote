<?php
session_start();
header("Content-type:text/html; charset=UTF-8");
if(is_file('install.php')){
	echo '<script>alert("您需要重新安装程序");location.href="./install.php"</script>';
	exit;
}
/* 常量 */
define(PHPF,dirname(__FILE__)."/");		//路径
define(initrun,true);		//判断是否从index.php访问文件
define(NUM,'3');		//设置投票数量最低值
require_once('config.php');		//引入mysql信息常量
require_once(PHPF.'lib/db.class.php');		//引入数据库底层类
require_once(PHPF.'M/model.php');		//mysql增删改查
require_once(PHPF.'V/view.php');		//视图
require_once(PHPF.'C/controller.php');		//conteroller
$DB=new DB();		//实例化数据库底层类
$Model=new Model();		//实例化mysql操作
$Con=new Controller();
// $Login=new Login();		//实例化登陆


$action=$_GET["action"];
?>