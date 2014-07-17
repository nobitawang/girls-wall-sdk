<?
 /***************************************************************************
 *  FILE			: config.inc.php
 *  AUTHOR			: Arrack(zeng.mz@gmail.com)
 *	DESCRIPTION		: 設定檔
 *
 *  DATE			AUTHOR		COMMENT
 *	-----------------------------------------------------------------------
 ***************************************************************************/
 	ob_start();
	$SiteUrl="www.growpx.com.tw";
	$SiteName="";
	$config_host				="localhost";
	$config_username			="root";
	$config_password			="growpx999";
	$config_database			="h";
	$config_URI					="/";
	$debugmode=1;

/***************************************************************************
Don't Change
****************************************************************************/
	define("DEBUGMODE",$debugmode);
	error_reporting(E_ALL & ~E_NOTICE);
	if (function_exists(date_default_timezone_set)){
		date_default_timezone_set("Asia/Taipei");
	}
	if($_SESSION["already_start"]==""){
		@session_start();
		$_SESSION["already_start"]=1;
	}

	if (function_exists(date_default_timezone_set)){
		date_default_timezone_set("Asia/Taipei");
	}

	$CUR_DATE=date("Y-m-d H:i:s");
	$now=$CUR_DATE;

	$_SESSION['CKEditor_Enabled'] = true ;
	$_SESSION['CKEditor_baseUrl'] = $config_URI.'upload/';

	ini_set('display_errors','on');
	ini_set('error_reporting','2039');
	ini_set('output_buffering','9000');
	ini_set('max_execution_time','7200');
	ini_set('max_input_time','7200');
	ini_set('post_max_size','100M');
	ini_set('upload_max_filesize','100M');
	ini_set('default_charset','utf-8');
	ini_set('default_socket_timeout','600');
	ini_set('session.cache_expire','36000');
	ini_set('session.gc_maxlifetime','36000');
	
?>