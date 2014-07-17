<?php
require_once('_conn.php');
//$url = 'http://emma.pixnet.cc/mainpage/album/categories/hot/1?format=json&pretty_print=1&count=1000';
//$datas = gethtml($url);
$datas = file_get_contents('list.json');
$datas = json_decode($datas, true);

$ids = implode("','", $_SESSION['ids']);


if ($ids!='') {
	$sql = "select * from pic where id not in ('$ids') order by score desc,id limit 300";
} else {
	$sql = "select * from pic order by score desc,id limit 300";
}
$rst=mq($sql);

$i = 0;
while($row=mfa($rst)) {

	$data = array();
	$data['id'] = $row['id'];
	$data['set_id'] = $row['set_id'];
	$data['thumb'] = $row['thumb'];
	$data['link'] = $row['link'];
	$data['title'] = $row['title'];

	if ($i<= 20) {
		$data['score'] = (20 - $i) * 10 + 100;	
	} else {
		$data['score'] = 100;
	}

	$output[] = $data;
	$i++;
}

output_json($output);
exit();