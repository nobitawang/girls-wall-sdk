<?php
require_once('_conn.php');

$id = safeget($_GET['id']);

if ($id!='') {
	$sql = 'select * from share where sid="' . $id  . '"';
	$row=mgd($sql);
	$ids = $row['data'];
	$ids = json_decode($ids, true);

	output_json($ids);
	exit();
}