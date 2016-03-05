<?php
class Model extends DB
{

	/* 查询 */
	function s($table,$other=false)
	{
		$sql='SELECT * FROM '.$table."$other";
		// echo $sql;
		return parent::sel($sql);
	}
	/* 增加 */
	function add($table,$other=false)
	{
		$sql="INSERT INTO $table VALUES (";
		if(is_array($other)){
			$i=0;
			$num=count($other);
			while($i<($num-1)){
				$sql.="'".$other[$i++]."',";
			}
			$sql .="'".end($other)."'";
		}else{
			$sql.=$other;
		}
		$sql.=');';
		// echo $sql;
		return	parent::sel($sql);
		// echo "add";
	}
	/* 删除 */
	function del($table,$other)
	{
	// DELETE FROM `t_user` WHERE `t_user`.`t_id` = 325 LIMIT 1
		$sql='DELETE FROM ';
		$sql.=$table;
		$sql.=' ' . $other;
		$sql.=' LIMIT 1';
		// echo $sql;
		return parent::sel($sql);
	}
	/* 修改 */
	function update($table,$other)
	{
		$sql="UPDATE $table SET ";
		$sql.="$other";
		$sql.=" LIMIT 1";
		// echo $sql;
		parent::sel($sql);
	}
}

?>