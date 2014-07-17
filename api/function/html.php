<?
/***************************************************************************
 *  AUTHOR                      : Arrack(zeng.mz@gmail.com)
 *      DESCRIPTION             : 取得HTML語法
 ***************************************************************************/
function output_json($data) {
    ob_end_clean();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}

function gethtml($url){
    // create curl resource
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, $url);

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);
    // close curl resource to free up system resources
    curl_close($ch);

    return $output;
}