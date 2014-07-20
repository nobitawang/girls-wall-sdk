<?

/***************************************************************************

 *  AUTHOR          : Arrack(zeng.mz@gmail.com)

 *  DESCRIPTION     :

 ***************************************************************************/

    function before_serialize($mixed){

        if (is_array($mixed)) {

            foreach($mixed as $key => $value) {

                $mixed[$key] = before_serialize($value);

            }

        } elseif (is_string($mixed)) {

            $mixed = str_replace('\"','"',$mixed);

            $mixed = str_replace('"','&quot;',$mixed);

        }

        return $mixed;

    }



    function myserialize($mixed){

        return serialize(before_serialize($mixed));

    }



    function safeget($strIn,$default=""){



        if(is_array($strIn)){

            $t=$strIn;

            foreach($t as $k => $v){

                $v=str_replace("\'","",$v);

                $v=str_replace("'","",$v);

                $v=str_replace("\'","",$v);

                $v=str_replace(";","",$v);

                $v=str_replace("\t","",$v);

                $v=str_replace("\r","",$v);

                $v=str_replace("\n","",$v);

                $v=trim($v);



                if($v=="" && $default!=""){$v=$default;}

                $strIn[$k]=$v;

            }

        }else{

            $strIn=str_replace("\'","",$strIn);

            $strIn=str_replace("'","",$strIn);

            $strIn=str_replace("\'","",$strIn);

            $strIn=str_replace(";","",$strIn);

            $strIn=str_replace("\t","",$strIn);

            $strIn=str_replace("\r","",$strIn);

            $strIn=str_replace("\n","",$strIn);

            $strIn=trim($strIn);



            if(($strIn=="" || is_null($strIn)) && $default!=""){$strIn=$default;}

        }



        return $strIn;

    }



    //取得分類ID

    function safegetcid($cid,$tablename,$field="id",$extrasql=" isshow=1 order by orderid ",$onerrorstop=false,$errormsg="nodata1"){

        $cid=safeget($cid,"-1");

        //echo $cid.$extrasql."<br>";

        $sql=merge_sql("select * from $tablename where id='$cid' ",$extrasql);

        if(!$row=mfa(mq($sql))){

            $sql=merge_sql("select * from $tablename ",$extrasql);

            if(!$row=mfa(mq($sql))){

                if($onerrorstop){echo $errormsg;exit();}

            }

            $cid=$row[$field];

        }

        return $cid;

    }



    //適用帳號登入

    function safeget3($strIn){

        $strIn=str_replace("\'","",$strIn);

        $strIn=str_replace("'","",$strIn);

        $strIn=str_replace(";","",$strIn);

        $strIn=str_replace("-","",$strIn);

        return $strIn;

    }



    function safeget2($strIn){$strIn=str_replace("'","\'",$strIn);return $strIn;}

    function safesql($strIn){return safe_html($strIn);}

    function safe_html($varhtml){

        //$varhtml=addslashes($varhtml);

        $varhtml=str_replace("\'","'",$varhtml);

        $varhtml=str_replace("'","\'",$varhtml);

        return $varhtml;

    }



    function str_string($strWord,$intLen){

        $strString="";

        for($i=0;$i<$intLen;$i++){

            $strString=$strString.$strWord;

        }

        return $strString;

    }



    function get_password($strWord){return md5(crypt($strWord,"aj"));}



    function numeric($var, $type = 'int'){

        if( is_numeric($var) ){

            if( $type === 'float'){return (float)$var;}else{return (int)$var;}

        }else{return 0;}

    }



    function get_mulit_data($value){

        if($value!="" && is_array($value) ){$v=implode(",",$value);}else{$v=$value;}

        return $v;

    }



    function change_qs($var,$val,$CUSTOM_QUERY_STRING=""){

        $url=iif($CUSTOM_QUERY_STRING=="",$_SERVER['QUERY_STRING'],$CUSTOM_QUERY_STRING);

        $t=explode("&",$url);

        $l=strlen($var);

        $isfind=0;

        foreach($t as $v){

            if($v!=""){

                $v2=explode("=",$v);

                if($v2[0]==$var){$v2[1]=$val;$isfind=1;}

                $url_s[]=$v2[0]."=".$v2[1];

            }

        }

        if($isfind==0){$url_s[]=$var."=".$val;}

        if(is_array($url_s)){$url_all=implode("&",$url_s);}

        return $url_all;

    }



    function filter_qs($var,$CUSTOM_QUERY_STRING=""){

        $url=iif($CUSTOM_QUERY_STRING=="",$_SERVER['QUERY_STRING'],$CUSTOM_QUERY_STRING);



        if (is_array($var)) {

            foreach ($var as $v) {

                $url = filter_qs($v,$url);

            }

            return $url;

        } else {

            $t=explode("&",$url);

            $l=strlen($var);

            foreach($t as $v){

                $v2=explode("=",$v);

                $data[$v2[0]] = $v2[1];

            }



            foreach($data as $k => $v){

                if($v!=""){

                    if($k!=$var){$url_s[]=$k."=".$v;}

                }

            }

            if(is_array($url_s)){$url_all=implode("&",$url_s);}

            return $url_all;

        }

    }



    function filter_qs_to_post($var,$CUSTOM_QUERY_STRING=""){

        $url=filter_qs($var,$CUSTOM_QUERY_STRING);



        $t=explode("&",$url);



        foreach($t as $v){

            $v2=explode("=",$v);

            $data[$v2[0]] = $v2[1];

        }



        $txt = '';

        foreach($data as $k => $v){

            echo get_textbox($k,array($k=>$v),"hidden");

        }

        return $txt;

    }



    function filter_qs_each($splitter,$CUSTOM_QUERY_STRING=""){

        $t=explode(',',$splitter);

        $url=iif($CUSTOM_QUERY_STRING=="",$_SERVER['QUERY_STRING'],$CUSTOM_QUERY_STRING);



        if(is_array($t)){

            foreach($t as $v){

                $url=filter_qs($v,$url);

            }

        }

        return $url;

    }



?>