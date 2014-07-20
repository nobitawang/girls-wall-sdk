<?php
require_once('_conn.php');
$id = safeget($_GET['id']);
$id = intval($id);


if ($id !='') {
	$sql = "delete from pic where id = '".$id."' limit 1";
	mq($sql);
	echo $id;
	output_json(['status' => 'success','id' => $id]);
}