<?
/***************************************************************************
 *  AUTHOR			: Arrack(zeng.mz@gmail.com)
 *	DESCRIPTION		: 表單元件
 ***************************************************************************/
	//MySQL 簡稱的function
	function mfa($rs){return mysql_fetch_array($rs);}
	function mq($sql){return my_mysql_query($sql);}
	function mnr($rs){return mysql_num_rows($rs);}
	function mnrsql($sql){return mnr(mq($sql));}
	function mgd($sql,$onerrorstop=false,$errormsg="nodata"){return mysql_getdata($sql,$onerrorstop,$errormsg);}
	function mgd_value($sql,$field){return mgdv($sql,$field);}

	function mgdv($sql,$field,$default=NULL){
		$row=mysql_getdata($sql);
		$t=$row[$field];
		if(is_null($default)==false && ($t=='' || is_null($t)==true)){
			$t=$default;
		}
		return $t;
	}

	function get_insert_sql($tablename,$fc,$fd,$extra=''){
		if(is_array($fc) && is_array($fd)){
			foreach ($fc as $key => $value) {
				$fc[$key] = "`".$value."`";
			}
			foreach ($fd as $key => $value) {
				$fd[$key] = "'".$value."'";
				$fe[$key]=$fc[$key]."=".$fd[$key];
			}
			$str_add_1=implode(",",$fc);
			$str_add_2=implode(",",$fd);

			$sql="INSERT INTO `$tablename`($str_add_1) ";
			$sql.="values($str_add_2) $extra";
			return $sql;
		}else{
			return '';
		}
	}

	function get_update_sql($tablename,$fc,$fd,$extra){
		if(is_array($fc) && is_array($fd)){
			foreach ($fc as $key => $value) {
				$fc[$key] = "`".$value."`";
			}
			foreach ($fd as $key => $value) {
				$fd[$key] = "'".$value."'";
				$fe[$key]=$fc[$key]."=".$fd[$key];
			}
			$sql="update `$tablename` set ";
			$sql.=implode(",",$fe);
			$sql.="$extra";
			return $sql;
		}
	}

	function my_mysql_query($sql){
		if(!$rst=mysql_query($sql)){
			if(DEBUGMODE==1){
				echo "<div style='font-size:16px;'>sql:".$sql."</br></br>error:";
				echo mysql_error();
				echo "</br></br>on ".$_SERVER['PHP_SELF']."</div>";
				exit();
			}else{
				echo "發生了不可預期的錯誤，請洽系統管理員:mysql_query error;";
				exit();
			}
			return false;
		}
		return $rst;
	}

	function mysql_getdata($sql,$onerrorstop=false,$errormsg="nodata"){
		if(!$rowt=mysql_fetch_array(my_mysql_query($sql),MYSQL_ASSOC)){
			if($onerrorstop){
				if(DEBUGMODE==1){echo $sql."</br>";echo mysql_error()."</br>";}
				echo $errormsg;exit();
			}
			return false;
		}
		return $rowt;
	}

	//相容舊版本
	function get_sql_data($sql,$field_name,$str_space){return mysql_getdata_all($sql,$field_name,$str_space);}
	function mysql_getdata_all($sql,$field_name,$str_space){
		$rs=my_mysql_query($sql);
		$num_max=mysql_num_rows($rs);
		$i=0;
		while($row=mysql_fetch_array($rs,MYSQL_ASSOC)){
			$i++;
			$strtemp.=$row[$field_name];
			if($i < $num_max){
				$strtemp.=$str_space;
			}
		}
		return $strtemp;
	}

	function my_mysql_fetch_array($rs){
		if(!$row=mysql_fetch_array($rs)){
			if(DEBUGMODE==1){
				echo "<div style='font-size:16px;'>rs:".var_export($rs,true)."</br>";
				echo "</br></br>on ".$_SERVER['PHP_SELF']."</div>";exit();
			}else{
				echo "DEBUGMODE disable:mysql_fetch_array error;";exit();
			}
			return $row;
		}else{
			return false;
		}

	}

	function merge_sql($sql,$arg,$arg2=" and "){
		$sqlt=" ".$sql." ";
		$argt=" ".$arg." ";
		if($arg==''){return $sql;}

		$a1=strpos($sqlt," where ") > 0;
		$a2=strpos($argt," where ") > 0;

		if($a1===true && $a2===false){
			return($sql.$arg2.$arg);
		}elseif($a1===false && $a2===false){
			return($sql.' where '.$arg);
		}else{
			return($sql.$arg);
		}
	}

	function mysql_copy_record($tablenamet,$change_id_field,$id,$newid){
		$sql="select *from $tablenamet where $change_id_field=$id limit 0,1";
		$rst=mq($sql);
		$fields = mysql_num_fields ($rst);
		while ($i < $fields) {
			//$type = mysql_field_type ($rst, $i);
			$name = mysql_field_name ($rst, $i);
			$flags = mysql_field_flags ($rst, $i);
			if(strpos($flags,"auto_increment")==0){
				$field_new[]=$name;
				if($name!=$change_id_field){
					$value[]=$name;
				}else{
					$value[]=$newid;
				}
			}
			$i++;
		}
		$sql="insert into $tablenamet(".implode(",",$field_new).") \n";
		$sql.="select ".implode(",",$value)." from $tablenamet where $change_id_field='$id'";
		mq($sql);
		return mysql_insert_id();
	}

	function mysql_copy_record_totable($tablenamet,$tablenamet2,$id_field,$id){
		$sql="select *from $tablenamet where $id_field=$id limit 0,1";
		$rst=mq($sql);
		$fields = mysql_num_fields ($rst);
		while ($i < $fields) {
			$name = mysql_field_name ($rst, $i);;
			$field_new[]=$name;$value[]=$name;
			$i++;
		}
		$sql="insert into $tablenamet2(".implode(",",$field_new).") \n";
		$sql.="select ".implode(",",$value)." from $tablenamet where $id_field='$id'";
		mq($sql);
	}

	function mysql_insert_data($tablenamet,$field,$data,$exsql='',$field_update='',$field_create=''){
		$field=explode(",",$field);
		foreach($field as $v){
			$field_caption[]=$v;
			$field_data[]=$data[$v];
		}
		if($field_update!==''){$field_caption[]=$field_update;$field_data[]=date("Y-m-d H:i:s");}
		if($field_create!==''){$field_caption[]=$field_create;$field_data[]=date("Y-m-d H:i:s");}

		foreach ($field_caption as $key => $value) {$field_caption[$key] = "`".$value."`";						}
		foreach ($field_data as $key => $value) {$field_data[$key] = "'".$value."'";$field_edit[$key]=$field_caption[$key]."=".$field_data[$key];}
		$str_add_1=implode(",",$field_caption);	$str_add_2=implode(",",$field_data);

		$sql="INSERT INTO `$tablenamet`($str_add_1) ";
		$sql.="values($str_add_2) $exsql";
		//echo $sql;
		mq($sql);
	}

	function mysql_update_data($tablenamet,$field,$data,$exsql='',$field_update=''){
		$field=explode(",",$field);
		foreach($field as $v){
		$field_caption[]=$v;
		$field_data[]=$data[$v];
		}
		if($field_update!==''){$field_caption[]=$field_update;$field_data[]=date("Y-m-d H:i:s");}

		foreach ($field_caption as $key => $value) {$field_caption[$key] = "`".$value."`"; }
		foreach ($field_data as $key => $value) {$field_data[$key] = "'".$value."'";$field_edit[$key]=$field_caption[$key]."=".$field_data[$key];}
		$str_add_1=implode(",",$field_caption); $str_add_2=implode(",",$field_data);

		$sql="update `$tablenamet` set ";
		$sql.=implode(",",$field_edit);
		$sql.="$exsql limit 1";

		////echo $sql;
		mq($sql);
	}
?>