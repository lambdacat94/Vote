<?php
/* 删除 */
class Viewdel{
	function deltop($id){		//删除投票选项
		$id=intval($id);
		$a=Model::del('t_user',' WHERE t_id=' . $id);
		if($a){
			echo '<script>alert("成功删除投票");location.href="./index.php?action=sel&sel=all"</script>';
		}
	}
	function delclass($classid){		//删除分类
		$classid=intval($classid);
		$a=Model::del('class',' WHERE c_id=' . $classid);
		if($a){
			echo '<script>alert("成功删除分类");location.href="./index.php"</script>';
		}
	}
}
class Viewadd{
	function addnum($POST){		//增加投票数量
	// echo 1;
		if(is_array($POST[tid]) && count($POST[tid]) >= NUM){		//是否是数组,数组数量大于等于10
			$i=0;
			foreach ($POST[tid] as $key => $value){
				$tid=intval($value);
			$a=Model::update('t_user',"t_num=t_num+1 WHERE t_id=$tid");
			}
				$html='<script>alert("您提交投票成功");location.href="./index.php"</script>';
		}else if(count($POST[tid] < NUM)){
			$html='<script>alert("投票失败,请检查票数是否不小于'. NUM .'票");location.href="./index.php"</script>';
		}
		echo $html;
	}

	function addtop(){		//增加投票选项
	
		if($_POST[submit]=='ok'){
		$other[0]=0;		//t_id
			$other[1]=htmlspecialchars($_POST[cid]);		//c_id
			$other[2]=htmlspecialchars($_POST[name]);		//t_name
			
			$target_path = 'temp_'.$_FILES[upload]['name']; 
			echo '上传的临时文件：' .$_FILES[upload]['tmp_name'] . '<br/>';
			echo '上传的目标文件：' .$target_path . '<br/>';
			echo $_SERVER["SCRIPT_FILENAME"] . '<br/>';
			echo $_SERVER["OS"] . '<br/>';
			//测试函数:　move_uploaded_file
			//也可以用函数：copy
			move_uploaded_file($_FILES[upload]['tmp_name'],PHPF .'images/'. $target_path); 
			echo "Upload result:"; 
			if(file_exists($target_path)) { 
			 if($_SERVER["OS"]!="Windows_NT"){
			  @chmod($target_path,0604);
			  }
			 }
			$other[3]=htmlspecialchars($_POST[sex]);		//t_sex
			$other[4]=$target_path;	//t_pic
			$other[5]=htmlspecialchars($_POST[num]);		//t_num
			$other[6]=htmlspecialchars($_POST[content]);		//t_content
			$other[7]=htmlspecialchars($_POST[other]);		//t_other
			$a=Model::add('t_user',$other);	
			if($a){
				echo '<script>alert("增加投票选项成功");location.href="./index.php?action=sel&sel=all"</script>';
			}
		}else{
			$html='<form action="" method="post"  enctype="multipart/form-data">';
		$html.='<dt>名字:</dt><input type="text" name="name" value="名字">';
		$html.='<dt>性别:</dt><input type="text" name="sex" value="性别">';
		$html.='<dt>头像:</dt><input type="file" name="upload" value="头像">';
		$html.='<dt>简介:</dt><textarea name="content" ></textarea>';
		/* 查询分类 */
		$a=Model::s('class');
		while($row=Model::fetch_array($a)){
			$data[]=$row;
		}
					$html.='<dt>分类:</dt><select name="cid">';
		foreach($data as $key => $value){
					$html.='<option value='.$value[c_id].'>'.$value[c_name];
		}
		$html.='</option></select>';
		/* end查询分类 */
		// $html.='<dt>分类:</dt><select><option value=""></option></select>';
		$html.='<dt>投票数量:</dt><input type="text" name="num" value="11">';
		$html.='<dt>其他:</dt><textarea name="other" ></textarea>';
		$html.='<input type="submit" name="submit" value="ok">';
		$html.='</form>';
		echo $html; 
		}
		
		
	}
	function addclass(){		//增加分类
		if($_POST[submit]=='ok'){
		$other[0]=0;
			$other[1]=htmlspecialchars($_POST[cname]);
			$a=Model::add('class',$other);	
			if($a){
				echo '<script>alert("添加成功");location.href="./index.php"</script>';
			}
		}else{
			$html='<form action="" method="post">';
		$html.='名字:<input type="text" name="cname" value="名字">';
		$html.='<input type="submit" name="submit" value="ok">';
		$html.='</form>';
		echo $html; 
		}
	
	}
}
/* 查询投票 */
class Viewsel{
	function allsel($picpath=false){		//查询所有投票
		$a=Model::s('t_user,class',' WHERE t_user.c_id=class.c_id');
		// echo 1;
			$html='	<form action="./index.php?action=tou" method="post">
			<div id="" class="maintable">';
			if($picpath){
				$image='../images/';
			}else{
				$image='./images/';
			}
		while($row=Model::fetch_array($a)){
			$html.='<dl>';
					$html.='<dd><img src="'.$image.$row[t_pic] .'" height=100 width=100 title="" /></dd>';
					$html.='<dd>'.$row[t_name].'</dd>';
					$html.='<dd>性别1:'.$row[t_sex].'</dd>';
					$html.='<dd>票数:'.$row[t_num].'</dd>';
					$html.='<dd>分类:'.$row[c_name].'</dd>';
					$html.='<dd>投票介绍:'.$row[t_content].'</dd>';
					$html.='<dd>给她投票:<input type="checkbox" name="tid[]" value="'.$row[t_id].'"></dd>';
					if($_SESSION['login']==1){
						$html.='<dd><a href="./index.php?action=del&del=top&id='. $row[t_id] .'">删除投票</a></dd>';
					}
			$html.='</dl>';
		}
		$html.='<div style="padding-top:300px"><input type="submit" value="提交投票" />
		</div>
	</form>';
			echo  $html;	
	}
	function allclass($class,$picpath=false){		//查询分类所有投票
	
		$a=Model::s('t_user',' WHERE c_id='.$class);
		$html='	<form action="./index.php?action=tou" method="post">
			<div id="" class="maintable">';
			if($picpath){
				$image='../images/';
			}else{
				$image='./images/';
			}
		while($row=Model::fetch_array($a)){
		echo $row[t_pic];
			$html='<dl>';
					$html.='<dd><img src="'.$image.$row[t_pic] .'" height=100 width=100 title="" /></dd>';
					$html.='<dd>'.$row[t_name].'</dd>';
					$html.='<dd>性别:'.$row[t_sex].'</dd>';
					$html.='<dd>票数:'.$row[t_num].'</dd>';
					$html.='<dd>投票介绍:'.$row[t_content].'</dd>';
					$html.='<dd>给她投票:<input type="checkbox" name="['.$row[t_id].']"></dd>';
			$html.='</dl>';
			echo $html;
		}
		
		echo '<div style="padding-top:300px"><input type="submit" value="提交投票" />
		</div>
	</form>';
	} 

	function classsel(){		//查询分类
		$a=Model::s('class');
			$html='<div id="" class="style1">';
			$html.='<h2>投票分类</h2>';
			$html.='<ul>';
		while($row=Model::fetch_array($a)){
					$html.='<li>';
					$html.='<a href="./index.php?action=sel&sel=allclass&class_id='.$row[c_id].'">分类名称:'.$row[c_name].'</a>';
					if($_SESSION['login']==1){
						$html.='<span style="float:right"><a href="./index.php?action=del&del=class&id='. $row[c_id] .'">删除</a></span>';
					}
					$html.='</li>';
					
		}
			$html.='</ul>';
		$html.='</div>';
		echo $html;
	}

}

/* 登陆 */
class Login {
	var $user;
	var $passwd;
	var $VIEW;
	var $out;
	// sql获取用户名,密码 
	function __construct(){	
		$a=Model::s('options'," WHERE options.options_name='admin' or options.options_name='passwd'");
		// $a=Model::fetch_array($a);
		while($row=Model::fetch_array($a)){
			$data[]=$row;
		}
		// print_r($data);
		$this->user = $data[0][1];
		$this->passwd = $data[1][1];

	}
	function getView(){
				$html ='<div class="dengruxiao">管理员登录</div>
		<form action="index.php?action=login" method="post"> 
			名字 (必填):<br/><input type="text" name="user" id="firstname"><br/>
			密码:<br/><input type="password" name="passwd" id="pwd"><br/>
			<input type="submit" value="确认">
		</form>
	</div>';
		echo $html;
	}
	 // 获取表单提交的用户名,密码 
	function user_passwd($user,$pwd){
		if($user == $this->user && $pwd==$this->passwd){
			$this->out .= "<b>用户名密码正确</b>";
			$_SESSION['login']=1;
			echo "<script>location.href='./admin/index.php'</script>";
			exit;
		}
		if($user != $this->user){
			$this->out .= "<b>用户名错误</b>";
		}
		if($pwd != $this->passwd){
			$this->out .= "<b>密码错误</b>";
		}
		echo $this->out;
		echo "<a href='index.php?action=login'>点击返回登陆页面</a>";
	}
}

?>