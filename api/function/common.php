<?
/***************************************************************************
 *  AUTHOR			: Arrack(zeng.mz@gmail.com)
 *	DESCRIPTION		: 通用函數
 ***************************************************************************/
	//取得資料
	require_once("function_mysql.php");
	/** Other */
	function iif($exp,$y="",$n=""){if($exp){return $y;}else{return $n;}}
	function ifb($var,$value=""){if($var==""){return $value;}else{return "";}}	//如果內容是空的
	function ifnb($var,$value=""){if($var!=""){return $value;}else{return "";}}	//如果內容不是空的
	function set_default(&$var,$val=""){if($var=="" || is_null($var)==true || isset($var)==false){$var=$val;}return $var;}
	function hsc($content=""){return htmlspecialchars($content);}

	function getfullurl($filename="") {
		if($filename==""){$filename=$_SERVER["REQUEST_URI"];}

		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://".$_SERVER["SERVER_NAME"];
		if ($_SERVER["HTTPS"] == "on") {
			if ($_SERVER["SERVER_PORT"]!= "443") {$pageURL.=":".$_SERVER["SERVER_PORT"];}
		}else{
			if ($_SERVER["SERVER_PORT"]!= "80") {$pageURL.=":".$_SERVER["SERVER_PORT"];}
		}
		$pageURL.=$filename;
		return $pageURL;
	}


	function merge_url($url,$arg){if(strpos($url,'?')>0){return($url.'&'.$arg);}else{return($url.'?'.$arg);}}

	function send_no_cache_header () {
		header ( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
		header ( "Last-Modified: " . gmdate ( "D, d M Y H:i:s" ) . " GMT" );
		header ( "Cache-Control: no-store, no-cache, must-revalidate" );
		header ( "Cache-Control: post-check=0, pre-check=0", false );
		header ( "Pragma: no-cache" );
	}

	function NOW($d=''){
		if($d==''){
			return strtotime(date('Y-m-d H:i:s'));
		}else{
			return date($d);
		}
	}
?>