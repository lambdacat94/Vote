<?php
class DB{
	private $conn;		//连接mysql
	public $sql;
	/*
	*构造函数
	*/
	function __construct()
	{
		if($this->conn=mysql_connect(SERVERIP,SERVERUSER,SERVERPWD))	
		{
			if(!mysql_select_db(SERVERTABLE))
			{
				echo ("数据表未找到!");
			}
			mysql_query("set names 'UTF8'");
			mysql_query("SET CHARACTER SET UTF8");
			mysql_query("SET CHARACTER_SET_RESULTS=UTF8");
		}else	{
			echo ("连接数据库失败!");
		}
	}
	/*
	*$sql可以直接执行sql语句
	*/
	function sel($sql)
	{
		return mysql_query($sql);
	}
	/*
    *获取一行结果集
	*/
	function fetch_array($query,$s=false)
	{
		if($s)
		{
			return mysql_fetch_array($query,$s);
		}else
		{
			return @mysql_fetch_array($query);
		}
	}
	/*
    *获取行的数目
	*/
	function num_rows($query)
	{
		return mysql_num_rows($query);
	}
	/*
	*遍历结果集
	*/
	function while_array($sql)
	{
		$i=0;
		$arr=DB::sel($sql);
		while($row=DB::fetch_array($arr))
		{
			$data[$i]=$row;
			$i++;
		}
		return $data;
	}
}
?>