<?php
class Controller {
	/* 登录 */
	function Login(){
		$login1=new Login();
		$user=htmlspecialchars($_POST['user']);
		$passwd=htmlspecialchars($_POST['passwd']);
			if($user=='' || $passwd==''){
				$login1->getView();
			}else{
				 $login1->user_passwd($user,$passwd);
			}
	}
	/* 增加投票数量 */
	function Add($POST=false){
		$add=new Viewadd();
		$add->addnum($POST);
	}
	/* 增加分类 */
	function Addclass(){
		$add=new Viewadd();
		$add->addclass($POST);
	}
	/* 投票表单提交 */
	function formos($POST=false){
		$add=new Viewadd();
		$add->addtop();
	}
	/* 查询 */
	function Sel($sel=false,$picpath=false){
	// echo 2;
	if($_GET['sel']==''){
		$_GET['sel']=$sel;
	}
		$sel=new Viewsel();
		if($picpath){
			switch($_GET['sel']){
				case 'all':
					$sel->allsel($picpath);break;		//查询所有投票
				case 'allclass':
					$sel->allclass(intval($_GET[class_id]),$picpath);break;		//查询分类所有投票
				case 'classsel':
					$sel->classsel();break;		//查询分类
				default :
					$sel->classsel();break;
			}
		}else{
			switch($_GET['sel']){
				case 'all':
					$sel->allsel();break;		//查询所有投票
				case 'allclass':
					$sel->allclass(intval($_GET[class_id]));break;		//查询分类所有投票
				case 'classsel':
					$sel->classsel();break;		//查询分类
				default :
					$sel->classsel();break;
			}
		
		}
	}
	/* 默认左侧投票分类加载 */
	function Intset(){
		$sel=new Viewsel();
		$sel->classsel();
	}
	/* 删除 */
	function Del($id=false,$classid=false){
		$del=new Viewdel();
		if($id){
			$del->deltop($id);
		}
		if($classid){
			$del->delclass($classid);
		}
		
	
	}
}


?>