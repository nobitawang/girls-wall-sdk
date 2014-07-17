<?php
require_once('_conn.php');
$ids = safeget($_POST['ids']);

if ($ids !='') {
	$ids = explode(',', $ids);
	$_SESSION['ids'] = $ids;
}
$sid = session_id();

if (is_array($_SESSION['ids'])) {
	foreach ($_SESSION['ids'] as $id) {
		$sql = "select * from pic where id ='$id'";
		if($row=mgd($sql)) {
			$data = array();
			$data['id'] = $row['id'];
			$data['set_id'] = $row['set_id'];
			$data['thumb'] = $row['thumb'];
			$data['link'] = $row['link'];
			$data['title'] = $row['title'];
			$data['score'] = $row['score'];

			$output[] = $data;
		}
	}
}

$sql='select * from share where sid = "' . $sid . '"';
// echo $sql;
if(mgd($sql)) {
	$sql = "update share set data = '" . json_encode($output) . "' where sid = '" . $sid . "'";
} else {
	$sql = "insert into share (sid,data) values ('" . $sid . "','" . json_encode($output) . "')";
}
//echo $sql;
mq($sql);

output_json($output);
?>