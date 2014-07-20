<?
 /***************************************************************************
 *  FILE			: conn.php
 *  AUTHOR			: Arrack(zeng.mz@gmail.com)
 *	DESCRIPTION		:
 *
 *  DATE			AUTHOR		COMMENT
 *	-----------------------------------------------------------------------
 * 	2007/1/1		Arrack		Create
 * 	2009/4/13		Arrack		修正了MAIL讀取的方式
 ***************************************************************************/
	require_once("_config.inc.php");
	require_once("function/common.php");
    require_once("function/function_show.php");
    require_once("function/html.php");
    require_once("function/get.php");

	$conn= mysql_connect("$config_host","$config_username","$config_password") or die("MYSQL 連線錯誤，請檢查資料庫的帳號密碼是否正確，");
	$db	= mysql_select_db("$config_database",$conn) or die("資料庫不存在，請確認資料庫名稱是否正確:".$config_database);
	mysql_query("SET NAMES `utf8`");
	mysql_query("SET time_zone ='+8:00'");