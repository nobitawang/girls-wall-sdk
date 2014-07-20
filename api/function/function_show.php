<?
/***************************************************************************
 *  AUTHOR			: Arrack(zeng.mz@gmail.com)
 *	DESCRIPTION		: 顯示相關
 ***************************************************************************/
	function getlink($caption,$link,$target=""){
		if($link==""){
			return $caption;
		}else{
			return '<a href="'.$link.'" target="'.$target.'">'.$caption.'</a>';
		}
	}


	//顯示金錢
	function getmoney($money,$endchar="",$decimals=0){
		return number_format(floatval($money), $decimals, '.', ',').$endchar;
	}

	function get_numeric($num){
		if($num==""){return "0";}
		$t="";$findpoint=false;
		for($i=0;$i<=strlen($num);$i++){
			$it=substr($num,$i,1);
			if($it=="." && $findpoint==false){
				$t.=$it;$findpoint=true;
			}
			if(is_numeric($it)){
				$t.=$it;
			}
		}
		return $t;
	}

	function show_img_ct($imgname,$w,$h,$title='',$default='',$path='upload/',$extra="",$autoresize=1){return '<table border="0" cellspacing="0" cellpadding="0" align="center"><tr><td width="'.$w.'" height="'.$h.'" align="center" valign="middle">'.show_img($imgname,$w,$h,$title,$default,$path,$extra,$autoresize).'</td></tr></table>';}
	function show_img($img,$w,$h,$title='',$default='',$path='upload/',$extra="",$autoresize=0){
		if($w!=0){$strw='" width="'.$w;}
		if($h!=0){$strh='" height="'.$h;}
		$fat=explode('/',$img);

		if(is_array($fat)){
			$fat[count($fat)-1]='';
			$tt=implode('/',$fat);
			$path=$path.$tt;
			$img=str_replace($tt,'',$img);
		}
		if($img!=""){$full_img=$path.$title.$img;
		}else{$full_img=$default;}

		if($full_img==''){return '';}
		if($autoresize==1){
			return resize_image_show($full_img,$w,$h,0,$extra);
		}else{
			if(is_file($full_img)){
				return '<img src="'.$full_img.$strw.$strh.'" border="0" '.$extra.' />';
			}else{
				trigger_error($full_img." not found", E_USER_NOTICE);
			}
		}
		return '' ;
	}

	function my_echo($var,$caption="",$usedump=0){
		if($usedump==0){
			echo '</br><div style="border: 1px solid #FF0000;">'.$caption.$var.'</div>';
		}else{
			echo '</br><div style="border: 1px solid #FF0000;">'.$caption;
			var_dump($var);
			echo '</div>';
		}
	}

	function get_age($var,$Type=1){
		//$Type=1 西元 or $Type=2 民國
		if($Type==1){$age=date("Y")-$var;}
		elseif($Type==2){$age=date("Y")-1911-$var;}

		if($age<0 || !is_numeric($age)){$age=0;}
		return $age;
	}

	function get_absurl($content,$absurl=""){
		//if($absurl==""){$absurl="http://".$_SERVER['HTTP_HOST'].$config_URI."";}
		$content=str_replace('src="','src="'.$absurl,$content);
		$content=str_replace('href="','href="'.$absurl,$content);
		$content=str_replace('background="','background="'.$absurl,$content);
		return $content;
	}

?>