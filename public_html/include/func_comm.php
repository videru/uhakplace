<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?
/* =====================================================


최종수정일 : 2007-07-14
2007-07-14 함수설명정리
 ===================================================== */
// 공통 함수
if (!defined('FUNC_COMM_INC_INCLUDED')) {  
    define('FUNC_COMM_INC_INCLUDED', 1);
// *-- FUNC_COMM_INC_INCLUDED START --*
	function rg_name_layer($mb_id,$bd_name,$mb_icon,$profile,$memo,$bbs_code,$bd_num,$homepage,$email) {
		$homepage = $homepage != '' ? base64_encode($homepage) : "";
		$email = $email != '' ? base64_encode($email) : "";
		
		if($mb_icon != '') $mb_icon= "<img src=\"$mb_icon\" align=absmiddle>";
		
		$str="<span onclick=\"rg_bbs_layer('$bbs_code','$bd_num','$bd_name','$mb_id','$homepage','$email','$profile','$memo',event)\" style=\"cursor:pointer;".($mb_id!=''?"font-weight:bold":"")."\">$mb_icon $bd_name</span>";
		return $str;
	}
/******************************************************************************
기능 : 최근글보기
사용법 : rg_lastest('게시판아이디','스킨',[목록수],[제목길이],
					['길이보다길때표시문자'],[추가조건],[정렬방법])
******************************************************************************/
	function rg_lastest($bbs_code,$skin='',$list=10,$subject_limit=0,
											$suffix='..',$where='',$order='') {
		global $dbcon,$rs_class,$_table,$_path,$_url,$_mb,$_auth;
		
		if($order=='') $order='bd_num DESC';
		
		$rs = new $rs_class($dbcon);
		$rs->clear();
		$rs->set_table($_table["bbs_cfg"]);
		$rs->add_where("bbs_code='$bbs_code'");
		$_bbs_info=$rs->fetch();
		if(!$_bbs_info) {
			return "게시판을 찾을 수 없습니다.";
		}
		$bbs_db_num = $_bbs_info['bbs_db_num']; // 디비 번호
		
		$skin_path=$_path['last_skin'].$skin.'/';
		$skin_url=$_url['last_skin'].$skin.'/';
		$more_url = $_url['bbs']."list.php?bbs_code=".$bbs_code;
		$_view_url = $_url['bbs']."view.php?bbs_code=$bbs_code&bd_num=";
		
		// 카테고리정보
		$_category_info=array();
		$_category_name_array=array();
		if($_bbs_info['use_category']) {
			$rs->clear();
			$rs->set_table($_table['bbs_category']);
			$rs->add_where("bbs_db_num=$bbs_db_num");
			$rs->add_order("cat_order");
			while($R=$rs->fetch()) {
				$_category_info[$R['cat_num']]=$R;
				$_category_name_array[$R['cat_num']]=$R['cat_name'];
			}
		}

		ob_start();
		if (file_exists($skin_path."setup.php")) include($skin_path."setup.php");
		
		if(empty($skin_new_icon)) $skin_new_icon = " <font color=red style=font-size:8pt>new</font>";
		if(empty($date_format)) $date_format = '%Y.%m.%d';
		
		if (file_exists($skin_path."header.php")) include($skin_path."header.php");

		$rs->clear();
		$rs->set_table($_table['bbs_body']);
		$rs->where_sql="bbs_db_num=$bbs_db_num AND bd_delete <> 1";
		if($where!='') $rs->where_sql.=" AND ".$where;
		$rs->order_sql=$order;
		$rs->set_limit($list);
		
		if($rs->num_rows()==0) {
			if(file_exists($skin_path."no_content.php")) include($skin_path."no_content.php");
		}
		
		while($R=$rs->fetch()) {
			extract($R);
			$view_url=$_view_url.$bd_num;
			// 글제목 자르기
			if($subject_limit>0) {
				$bd_subject=rg_cut_string($bd_subject,$subject_limit,$suffix);
			} else {
				$bd_subject=$bd_subject;
			}

			if(!$is_admin) {
				$bd_email = rg_get_text($bd_email);
				$bd_name = rg_get_text($bd_name);
				$bd_subject = rg_get_text($bd_subject);
			}
			if($cat_num)
				$cat_name=$_category_name_array[$cat_num];	// 카테고리명
			else
				$cat_name='';
			
			// 코멘트수
			if($bd_comment_count>0)
				$i_comment_count="<font color=blue style=font-size:8pt>[$bd_comment_count]</font>";
			else
				$i_comment_count='';		

			// 최근글 아이콘
			if(time() < ($bd_write_date+60*60*$new_time))
				$i_new = $skin_new_icon;
			else
				$i_new = '';
			$bd_write_date=rg_date($bd_write_date,$date_format); // 날자형식지정
			
			$bd_files=unserialize($bd_files);
			$bd_links=unserialize($bd_links);
			
			if(is_array($bd_links))
			foreach($bd_links as $k => $v) {
				if($v['url']=='') continue;
				if($v['name']=='') $v['name']=$v['url'];
				$bd_links[$k][link_url]=$_url['bbs']."link.php?bbs_code=$bbs_code&bd_num=$bd_num&key=$k";
			}	
			
			if(is_array($bd_files))
			foreach($bd_files as $k => $v) {
				if($v['name']=='') continue;
				$bd_files[$k]['view_url']=
							$_url['bbs']."down.php?bbs_code=$bbs_code&bd_num=$bd_num&key=$k&mode=view";
				$bd_files[$k]['down_url']=
							$_url['bbs']."down.php?bbs_code=$bbs_code&bd_num=$bd_num&key=$k&mode=down";
			}
			if(file_exists($skin_path."main.php")) include($skin_path."main.php");
		}
		if(file_exists($skin_path."footer.php")) include($skin_path."footer.php");

		$_result = ob_get_contents(); 
		ob_end_clean();
		return $_result;
	}
	
/******************************************************************************
기능 : 외부로그인
사용법 : rg_outlogin('스킨명','리턴URL')
******************************************************************************/
	function rg_outlogin($skin='',$ret_url=NULL) {
		global $dbcon,$rs_class,$_path,$_table,$_url,$_mb,$_auth;
		
		$skin_path = $_path['login_skin'].$skin.'/';
		$skin_url = $_url['login_skin'].$skin.'/';
		
		if($ret_url==NULL) $ret_url = $_SERVER['REQUEST_URI'];
		
		ob_start();
		if(file_exists($skin_path."header.php")) include($skin_path."header.php");


		if( $_mb && $_mb['mb_id']!='') {
			$mb_id = $_mb['mb_id'];
			
			
			$mb_level = $_mb['mb_level'];
			$mb_level_name = $_mb['mb_level_name'];
			$gr_level_name = $_mb['gr_level_name'];
			$mb_point = number_format($_mb['mb_point']);

			$modify_url	= $_url['member']."modify.php?ret_url=".urlencode($ret_url);
			$logout_url	= $_url['member']."login.php?logout&ret_url=".urlencode($ret_url);
//			$leave_url=$_url['member']."mb_leave.php?ret_url=".urlencode($ret_url);
			if(file_exists($skin_path."logout.php")) include($skin_path."logout.php");
			if($_auth['admin'] && file_exists($skin_path."admin.php")) include($skin_path."admin.php");
		} else {
			$login_action = $_url['member']."login.php";
			$password_url = $_url['member']."find_pass.php?url=".urlencode($ret_url);
			$join_url			= $_url['member']."join.php?url=".urlencode($ret_url);
			if(file_exists($skin_path."login.php")) include($skin_path."login.php");
		}
		if(file_exists($skin_path."footer.php")) include($skin_path."footer.php");

		$_result = ob_get_contents(); 
		ob_end_clean();
		return $_result;
	}

/******************************************************************************
기능 : 영,숫자로된 문자열을 생성
사용법 : rg_rnd_string(길이)
******************************************************************************/
	function rg_rnd_string($len) {
		$rnd_str="QWERTYUIOPASDFGHJKLZXCVBNM1234567890";
		$str="";
		$ll=strlen($rnd_str)-1;
		for($i=0;$i<$len;$i++) {
			$str.=$rnd_str[mt_rand(0,$ll)];
		}
		$str=trim($str);
		return $str;
	}

/******************************************************************************
기능 : 홈페이지 URL체크
홈페이지 입력시 http 로 시작하는지 체크하여 아닐 경우 http:// 를 붙인다.
	
사용법 : rg_homepage_chk('URL')
******************************************************************************/
	function rg_homepage_chk($str) {
		if($str == '')
			return '';

		if(strtolower($str) == 'http://')
			return '';

		if(eregi('^(http://)',strtolower($str)))
			return $str;

		return 'http://'.$str;
	}

/******************************************************************************
기능 : 포인트 설정
사용법 : rg_set_point(회원번호,포인트타입,증감포인ㅌ,
									'내역1','내역2','데이타')
******************************************************************************/
	function rg_set_point($mb_num,$po_type,$point,
										 $po_part1='',$po_part2='',$data=NULL){
		global $dbcon,$rs_class,$_table;
		$rs = new $rs_class($dbcon);
		
		if($point=='') return false; // 적립사용포인트 없음
		if($mb_num=='') return false;
		if(is_array($data)) $data=serialize($data);
		
		$rs->clear();
		$rs->set_table($_table['member']);
		$rs->add_field("mb_point");
		$rs->add_where("mb_num=$mb_num");
		$rs->select();
		if($rs->num_rows()<1) return false; // 회원정보 없음

		$tmp=$rs->fetch(); // 현재포인트
		$mb_point=$tmp['mb_point']+$point;

		$rs->clear_field();
		$rs->add_field("mb_point","$mb_point");
		$rs->update();

		$rs->clear();
		$rs->set_table($_table['point']);
		$rs->add_field("mb_num","$mb_num");
		$rs->add_field("po_type","$po_type");
		$rs->add_field("po_part1","$po_part1");
		$rs->add_field("po_part2","$po_part2");
		$rs->add_field("po_point","$point");
		$rs->add_field("po_current_point","$mb_point");
		$rs->add_field("po_date",time());
		$rs->add_field("po_data",$data);
		$rs->insert();
		
		$rs->clear();
	}
	
/*
/******************************************************************************
기능 : 포인트를 가져오는 함수 사용안함
사용법 : 
******************************************************************************/
/*	function get_point($mb_id){
		global $mysql;
	
		$mb_info=$dbcon->query_fetch("SELECT * FROM s_member WHERE mb_id='$mb_id'");
		if(!$mb_info) return false; // 회원정보 없음

		$point_info_rs=$dbcon->query("SELECT * FROM s_point
											WHERE chi_num=$chi_num AND mb_num=$mb_info['mb_num']");
		if( mysql_num_rows($point_info_rs) < 1 ) { 
			return 0;
		}
		$point_info=$dbcon->fetch($point_info_rs); // 현재포인트

		return $point_info['po_current_point'];
	}*/

/******************************************************************************
기능 : timestamp 형식의 데이타를 일정포멧으로 변경한다
사용법 : rg_date(timestamp,['포맷'],['0인경우반환값'])
strftime 포맷참고 
******************************************************************************/
	function rg_date($time,$format='%Y-%m-%d %H:%M:%S',$no_val='-') {
		if($time==0) return $no_val;
		if(!$format) $format='%Y-%m-%d %H:%M:%S';
		return strftime($format,$time);
	}
	
/******************************************************************************
기능 : 페이지 이동 함수(액셔이후 처리)
사용법 : rg_href('url','메시지','액션','타겟프레임','추가스크립트')
[액션]
back : 뒤로이동
close : 윈도우닫기
******************************************************************************/
	function rg_href($url='',$msg='',$action='',$target='',$exit=true){
		if($url=='' && $msg=='' && $action=='')
			return false;
		
		echo "<HTML>
<HEAD>
<META HTTP-EQUIV=Content-Type CONTENT=text/html;charset=euc-kr>
<SCRIPT LANGUAGE=JavaScript>
<!--
";

		if($msg != '') {
			$msg=str_replace("\r",'',$msg); // 개행문자 처리
			$msg=str_replace("\n",'\n',$msg); // 개행문자 처리
			$msg=str_replace("'","\'",$msg); // ' 문자 처리
			echo "\nalert('$msg');\n";
		}

		if($url != '') {
			$url=str_replace("'",'%27',$url);
			if($target)
				echo "\n$target.location.replace('$url');\n";
			else
				echo "\nlocation.replace('$url');\n";
		}

		switch($action) {
			case 'back' : 
					echo "\nhistory.back();\n";
					break;
			case 'close' : 
					echo "\nself.close();\n";
					break;
			case '';
					break;
		}

		echo "
//-->
</SCRIPT></html>
		";
		if($exit) exit;
	}
	
/******************************************************************************
기능 : 메일발송
base64로 인코딩 하여 메일을 보낸다.
사용법 : rg_mail('수신이메일','제목','내용',['발송자'],['회신메일주소'],
           ['참조'],['숨은참조'])
[내용]
항상 html 방식이다
******************************************************************************/
	// 
	function rg_mail($to,$subject,$message,$from='',$return='',$cc='',$bcc='') {
		$ip=$_SERVER['REMOTE_ADDR'];
		$server_name=$_SERVER['SERVER_NAME'];
		$server_addr=$_SERVER['SERVER_ADDR'];
		$header = "";

		if($from!='') $header .= "FROM: $from\n";
		if($cc!='') $header .= "cc : $cc\n";
		if($bcc!='') $header .= "bcc : $bcc\n";
		$header .= "MIME-Version: 1.0\n";
		$header .= "X-Mailer: rgboard mailer 4.0 ($server_name,$server_addr,remote-ip:$ip)\n";
		$header .= "Content-Type: text/html; charset=euc-kr\n";
		$header .= "Content-Transfer-Encoding: base64\n\n";

		$message = chunk_split(base64_encode($message)); // base64로 인코딩한다
		if($return!='') {
			$result=@mail($to,$subject,$message,$header,"-f{$return}");
			if($result)
				return $result;
			else
				return @mail($to,$subject,$message,$header);
		}
		else
			return @mail($to,$subject,$message,$header);
	}
				
/******************************************************************************
기능 : TEXT 형식 변환
사용법 : rg_conv_text('내용', [html허용여부])
[html허용여부]
0 : html불가
1 : html허용
2 : html+br br처리만한다
******************************************************************************/
	function rg_conv_text($str, $html='0')
	{
		if($html>0) { // 이미지에 스크립트삽입제거
			$source = "/<img .*src=[a-z0-9\"']*script:[^>]+>/i"; 
			$target = ""; 
			$str=preg_replace($source, $target, $str);
		}
		switch($html) {
			case '1' : // html 허용인경우
						$str = $str."<!--\"<--></xml></script></iframe>";
					break;		
			case '2' : // html + br 인경우
						$str = nl2br($str)."<!--\"<--></xml></script></iframe>";
					break;		
			default : // html 불가
						$str=rg_get_text($str,1);
						$str=rg_autolink($str);
					break;
		}
		return $str;
	}			
				
/******************************************************************************
기능 : HTML 엔티티로 변환 (글이 보여질때 내용을 치환)
사용법 : rg_get_text('내용', [br처리여부])
******************************************************************************/
	function rg_get_text($str, $nl2br=0)
	{
			$source[] = "/&/";
			$target[] = "&#038;";
			$source[] = "/  /";
			$target[] = "&nbsp; ";
			$source[] = "/</";
			$target[] = "&lt;";
			$source[] = "/>/";
			$target[] = "&gt;";
			$source[] = "/\"/";
			$target[] = "&#034;";
			$source[] = "/\'/";
			$target[] = "&#039;";
			$source[] = "/}/";
			$target[] = "&#125;";
			if ($nl2br) {
					$source[] = "/\n/";
					$target[] = "<br>";
			}

			return preg_replace($source, $target, $str);
	}

/******************************************************************************
기능 : HTML 엔티티로 변환 (디비의 내용을 form 으로 보낼때 변환)
사용법 : rg_html_entity('내용', 디코딩여부)
******************************************************************************/
	function rg_html_entity($str,$decode=0)
	{
		if($decode) {
			$source[] = "/&#038;/";
			$target[] = "&";
//			$source[] = "/&nbsp; /";
//			$target[] = "  ";
			$source[] = "/&lt;/";
			$target[] = "<";
			$source[] = "/&gt;/";
			$target[] = ">";
			$source[] = "/&#034;/";
			$target[] = "\"";
			$source[] = "/&#039;/";
			$target[] = "'";
		} else {
			$source[] = "/&/";
			$target[] = "&#038;";
//			$source[] = "/  /";
//			$target[] = "&nbsp; ";
			$source[] = "/</";
			$target[] = "&lt;";
			$source[] = "/>/";
			$target[] = "&gt;";
			$source[] = "/\"/";
			$target[] = "&#034;";
			$source[] = "/\'/";
			$target[] = "&#039;";
		}
		return preg_replace($source, $target, $str);
	}

/******************************************************************************
기능 : 현재 스크립트의 URL 을 얻는다
사용법 : rg_get_current_url()
******************************************************************************/
	function rg_get_current_url()
	{
			global $HTTP_SERVER_VARS;
			
			// 프로토콜 구하기 
			$protocol = strtolower($HTTP_SERVER_VARS["SERVER_PROTOCOL"]);
			$protocol = preg_replace('/(\/.*)/', '', $protocol);
			
			// 서버의 포트번호가 80이 아닐경우 포트번호 지정(알지보드 수정)
			$port = $HTTP_SERVER_VARS['SERVER_PORT'];
			$port = ($port!='80')?':'.$port:'';
			
			$host = $HTTP_SERVER_VARS['HTTP_HOST'];
			$url = $protocol.'://'.$host.$port.dirname($HTTP_SERVER_VARS['PHP_SELF']);
			
			// 끝에 / 이 없으면 붙이기
			if(!preg_match("/(\/)$/",$url)) $url .= '/';

			return $url;
	}	
	
/******************************************************************************
기능 : 날짜를 TimeStemp 형식으로 변환한다.
사용법 : rg_str2time('날짜')
[날짜]
2003-05-31 01:22:11
******************************************************************************/
	function rg_str2time($DateTimeStr) {
		$result=strtotime($DateTimeStr);
		// $Tmp=explode(" ", $DateTimeStr);
		// $Date=explode("-", $Tmp[0]);
		// $Time=explode(":", $Tmp[1]);

		// return mktime($Time[0],$Time[1],$Time[2],$Date[1],$Date[2],$Date[0]);
		return $result;
	}

/******************************************************************************
기능 : 배열을 이용하여 <option> 태그를 발생시킨다.
사용법 : rg_html_option('옵션목록',['기본값'],['키필드'],['텍스트필드'],[텍스트를 필드로사용여부])
[옵션목록]
배열또는 이중배열
******************************************************************************/
	function rg_html_option($options,$default=NULL,$key_field='',$text_field='',$text_key=false) {
		$_result = '';
//		$selected = false;

//		if($text_field=='')$text_field=$key_field;

		if(!is_array($options)) return false;

		reset($options);
		foreach($options as $key => $value) {
			if($key_field!='') {
				$o_key = $value[$key_field];
			} else {
				$o_key = ($text_key) ? $value : $key;
			}
			$o_text = ($text_field != '') ? $value[$text_field] : $value;
			
			$_result .= "<option value=\"$o_key\"";
			
			if(is_array($default) && in_array($o_key,$default)) {
				$_result .= " selected ";
			} else if(($default!=NULL) && ($o_key==$default)) {
				$_result .= " selected ";
			}
			$_result .= ">$o_text</option>\n";
		}
		return $_result;
	}
		
/******************************************************************************
기능 : 레코드셋의 필드를 이용하여 <option> 태그를 발생시킨다.
사용법 : 
******************************************************************************/
	function rg_html_option_rs($rs,$default=NULL,$key_field,$text_field='') {
		$_result = '';
		if(!$rs) return false;

		if($text_field=='')$text_field=$key_field;
		while ($R=$rs->fetch()) {
			$_result .= "<option value=\"{$R[$key_field]}\"";
			if(is_array($default) && in_array($R[$key_field],$default)) {
				$_result .= " selected ";
			} else if(($default!=NULL) && ($R[$key_field]==$default)) {
				$_result .= " selected ";
			}
			$_result .= ">{$R[$text_field]}</option>\n\n";
		}
		return $_result;
	}
	
/******************************************************************************
기능 : 배열을 이용하여 radio 태그를 발생시킨다.
사용법 : 
******************************************************************************/
	function rg_html_radio($form_name,$options,$default='',$key_field=NULL,$text_field='',$tag1='',$tag2='',$tag3='',$tag4='') {
		$_result = '';
		$selected = false;

		if(!is_array($options)) return false;
		
		reset($options);
		foreach($options as $key => $value) {
			if($key_field!='') {
				$o_key = $value[$key_field];
			} else {
				$o_key = ($text_key) ? $value : $key;
			}
			$o_text = ($text_field != '') ? $value[$text_field] : $value;
			
			$_result .= "$tag1<input type=\"radio\" name=\"$form_name\" value=\"$o_key\" $tag2 ";
			if(($default!=NULL) && (!$selected) && ($o_key==$default)) {
				$_result .= " checked ";
				$selected=true;
			}
			$_result .= ">$tag3$o_text$tag4\n";
		}
		return $_result;
	}
		
/******************************************************************************
기능 : 배열을 이용하여 checkbox 태그를 발생시킨다.
사용법 : 
******************************************************************************/
	function rg_html_checkbox($form_name,$options,$default='',$key_field=NULL,$text_field='',$tag1='',$tag2='',$tag3='',$tag4='') {
		$_result = '';

//		if($text_field=='')$text_field=$key_field;
		if(!is_array($options)) return false;
		
		reset($options);
		foreach($options as $key => $value) {
			if($key_field!='') {
				$o_key = $value[$key_field];
			} else {
				$o_key = ($text_key) ? $value : $key;
			}
			$o_text = ($text_field != '') ? $value[$text_field] : $value;

			$_result .= "$tag1<input type=\"checkbox\" name=\"$form_name\" value=\"$o_key\" $tag2";

			if(is_array($default) && in_array($o_key,$default)) {
				$_result .= " checked ";
			} else if(($default!=NULL) && ($o_key==$default)) {
				$_result .= " checked ";
			}
			$_result .= ">$tag3$o_text$tag4\n";
		}
		return $_result;
	}
	
/******************************************************************************
기능 : 사용자 정의 폼을 만든다.
사용법 : 
******************************************************************************/
	function rg_makeform($form_name, $type, $values, $default_value='') {
		if(func_num_args()>3) { // 기본값입력이 있다면 기본값 체크
			$m = true;
		} else {
			$m = false;
		}
								
		$select_box = false;
								
		$tmp = explode("|", $values);
		
		if($type=='2') { // 텍스트 박스 1번째 길이, 2번째 기본값
			if($m) $tmp[1]=$default_value;
			$result = "<input name=\"$form_name\" type=\"text\" id=\"$form_name\" value=\"$tmp[1]\" size=\"$tmp[0]\">\n";
			return $result;
		}
		
		if($type=='5') { // 텍스트 에리어 1번째 cols, 2번째 rows, 3번째 기본값
			if($m) $tmp[2]=$default_value;
			$result = "<textarea name=\"$form_name\" cols=\"$tmp[0]\" rows=\"$tmp[1]\">$tmp[2]</textarea>";
			return $result;
		}
		
		for ($i = 0; $i < sizeof($tmp); $i++) {
			$tmp[$i] = trim($tmp[$i]);
			if (ereg("^\!",$tmp[$i])) {
				$tmp[$i] = ereg_replace("^\!", "", $tmp[$i]);
				if ( !$m ||
					 ($m && $default_value == $tmp[$i])) {
					$default = 1; 
				}	else {
					$default = 0; 
				}
			}	elseif ($m && $default_value == $tmp[$i]) {
				$default = 1;
			}	else {
				$default = 0; 
			}
			switch ($type) {
				case 1 : // 라디오버튼
								$tmp[$i] = htmlspecialchars($tmp[$i]);
								$return .= "<input type=radio name=\"$form_name\" id=\"{$form_name}_$i\" VALUE=\"$tmp[$i]\"";
								if ($default) { $return .= " checked"; }
								$return .= "><label for=\"{$form_name}_$i\">$tmp[$i]</label>\n";
								break;
				case 3 : // 셀렉트박스
								$tmp[$i] = htmlspecialchars($tmp[$i]);
								$select_box = true;
								$return .= "<option value=\"$tmp[$i]\"";
								if ($default) { $return .= " selected"; }
								$return .= ">$tmp[$i]</option>\n";
								break;
				case 4 : // 체크박스 처음! 기본체크, 좌측문항, 우측값
								if(empty($tmp[$i+1])) break;
								$tmp[$i] = htmlspecialchars($tmp[$i]);
								$tmp[$i+1] = htmlspecialchars($tmp[$i+1]);
								$checkbox_value = trim($tmp[$i+1]);
								$checkbox = "<input type=\"checkbox\" name=\"$form_name\" id=\"{$form_name}\" value=\"$checkbox_value\"";
								if ($default || $default_value == $checkbox_value) {
									$checkbox .= " checked";
								}
								$checkbox .= ">";
								$tmp[$i]=str_replace("{}",$checkbox,$tmp[$i]);
								$return .= "<label for=\"{$form_name}\">$tmp[$i]</label>\n";
								$i++;
								break;				
			}	
		}
		if ($select_box) {
			$return = "<select name=\"$form_name\">\n$return</select>\n";
		} 
		return $return;
	} // *-- rg_makeform --*
	
/******************************************************************************
기능 : mb5함수를 이용해서 암호화 한다.
사용법 : 
******************************************************************************/
	function rg_password_encode($str) {
		$result=md5($str);

		// 3버전에서는 mysql 의 password 함수를 이용하였으나
		// 4버전에서는 호환성을 고려하여 md5 를 이용한다.
		// 만약 이전 (3버전대)버전에서 회원데이타를 이전할경우 아래 방식대로
		// 암호화를 하는 방법이 있다.
		
		// 문자열을 mysql password함수를 이용하여 암호화 한다.
		// 일부 서버에서 위 암호화 알고리즘이 듣지 않는것 같다
		// mysql 버전을 체크하여 암호화 한다
/*
		global $mysql;
		// mysql서버의 버전을 구한다
		list($tmp1,$tmp) = $dbcon->query_fetch("SHOW VARIABLES like 'version'");
		list($mysql_version)=explode('.',$tmp);
		
		// mysql 4.1 부터 password 함수가 old_password 로바뀌었다.
		if($mysql_version>3) { // 4.0 버전 이상이라면
			list($result) = $dbcon->query_fetch("SELECT old_password('$str')");
		} else { // 3.xx 버전 이하라면
			list($result) = $dbcon->query_fetch("SELECT password('$str')");
		}
*/		
		return $result;
	}

/******************************************************************************
기능 : 한글을 고려하여 문자를 자른다.
사용법 : 
******************************************************************************/
	function rg_cut_string($string, $length, $suffix="..") { 
		if (strlen($string) <= $length)
			return $string; 
		$cpos = $length - 1; 
		$count_2B = 0; 
		$lastchar = $string[$cpos]; 
		while (ord($lastchar)>127 && $cpos>=0) { 
			$count_2B++; 
			$cpos--; 
			$lastchar = $string[$cpos]; 
		}
		if($count_2B % 2) $length--;
		return substr($string, 0, $length).$suffix; 
	} 

	# 파일 크기 출력 함수
	# $bfsize 변수는 bytes 단위의 크기임
	#
	# number_formant() - 3자리를 기준으로 컴마를 사용
	function rg_human_fsize_lib($bfsize, $sub = "0") {
		$BYTES = number_format($bfsize) . " Bytes";
	
		if($bfsize < 1024) // Bytes 범위
			return $BYTES;
		else if($bfsize < 1048576) // KBytes 범위
			$bfsize = number_format(round($bfsize/1024)) . " KB";
		else if($bfsize < 1073741827) // MB 범위
			$bfsize = number_format(round($bfsize/1048576)) . " MB";
		else // GB 범위
			$bfsize = number_format(round($bfsize/1073741827)) . " GB";
	
		if($sub) $bfsize .= "($BYTES)";
	
		return $bfsize;
	}	
		
/******************************************************************************
기능 : URL들을 찾아내어 자동으로 링크를 구성해주는 함수
사용법 : 
******************************************************************************/
	function rg_autolink(&$str) {
	//  $agent = get_agent_lib();
	
		$regex['file'] = "gz|tgz|tar|gzip|zip|rar|mpeg|mpg|exe|rpm|dep|rm|ram|asf|ace|viv|avi|mid|gif|jpg|png|bmp|eps|mov";
		$regex['file'] = "(\.({$regex['file']})\") TARGET=\"_blank\"";
		$regex['http'] = "(http|https|ftp|telnet|news|mms):\/\/(([\xA1-\xFEa-z0-9:_\-]+\.[\xA1-\xFEa-z0-9,:;&#=_~%\[\]?\/.,+\-]+)([.]*[\/a-z0-9\[\]]|=[\xA1-\xFE]+))";
		$regex['mail'] = "([\xA1-\xFEa-z0-9_.-]+)@([\xA1-\xFEa-z0-9_-]+\.[\xA1-\xFEa-z0-9._-]*[a-z]{2,3}(\?[\xA1-\xFEa-z0-9=&\?]+)*)";
	
		# &lt; 로 시작해서 3줄뒤에 &gt; 가 나올 경우와
		# IMG tag 와 A tag 의 경우 링크가 여러줄에 걸쳐 이루어져 있을 경우
		# 이를 한줄로 합침 (합치면서 부가 옵션들은 모두 삭제함)
		$src[] = "/<([^<>\n]*)\n([^<>\n]+)\n([^<>\n]*)>/i";
		$tar[] = "<\\1\\2\\3>";
		$src[] = "/<([^<>\n]*)\n([^\n<>]*)>/i";
		$tar[] = "<\\1\\2>";
		$src[] = "/<(A|IMG)[^>]*(HREF|SRC)[^=]*=[ '\"\n]*({$regex['http']}|mailto:{$regex['mail']})[^>]*>/i";
		$tar[] = "<\\1 \\2=\"\\3\">";
	
		# email 형식이나 URL 에 포함될 경우 URL 보호를 위해 @ 을 치환
		$src[] = "/(http|https|ftp|telnet|news|mms):\/\/([^ \n@]+)@/i";
		$tar[] = "\\1://\\2_HTTPAT_\\3";
	
		# 특수 문자를 치환 및 html사용시 link 보호
		$src[] = "/&(quot|gt|lt)/i";
		$tar[] = "!\\1";
		
		// 3.0.11 에서 추가
		$src[] = "/&#034;/i";
		$tar[] = "\"";
		$src[] = "/&#039;/i";
		$tar[] = "'";
		$src[] = "/&#125;/";
		$tar[] = "}";
			
		$src[] = "/<a([^>]*)href=[\"' ]*({$regex['http']})[\"']*[^>]*>/i";
		$tar[] = "<A\\1HREF=\"\\3_orig://\\4\" TARGET=\"_blank\">";
		$src[] = "/href=[\"' ]*mailto:({$regex['mail']})[\"']*>/i";
		$tar[] = "HREF=\"mailto:\\2#-#\\3\">";
		$src[] = "/<([^>]*)(background|codebase|src)[ \n]*=[\n\"' ]*({$regex['http']})[\"']*/i";
		$tar[] = "<\\1\\2=\"\\4_orig://\\5\"";
	
		# 링크가 안된 url및 email address 자동링크
		$src[] = "/((SRC|HREF|BASE|GROUND)[ ]*=[ ]*|[^=]|^)({$regex['http']})/i";
		$tar[] = "\\1<A HREF=\"\\3\" TARGET=\"_blank\">\\3</a>";
		$src[] = "/({$regex['mail']})/i";
		$tar[] = "<A HREF=\"mailto:\\1\">\\1</a>";
		$src[] = "/<A HREF=[^>]+>(<A HREF=[^>]+>)/i";
		$tar[] = "\\1";
		$src[] = "/<\/A><\/A>/i";
		$tar[] = "</A>";
	
		# 보호를 위해 치환한 것들을 복구
		$src[] = "/!(quot|gt|lt)/i";
		$tar[] = "&\\1";

		$src[] = "/(http|https|ftp|telnet|news|mms)_orig/i";
		$tar[] = "\\1";
		$src[] = "'#-#'";
		$tar[] = "@";
		$src[] = "/{$regex['file']}/i";
		$tar[] = "\\1";
	
		# email 주소를 변형한 뒤 URL 속의 @ 을 복구
		$src[] = "/_HTTPAT_/";
		$tar[] = "@";
	
		# 이미지에 보더값 0 을 삽입
		$src[] = "/<(IMG SRC=\"[^\"]+\")>/i";
		$tar[] = "<\\1 BORDER=0>";
	
		# IE 가 아닌 경우 embed tag 를 삭제함
//		if($agent['br'] != "MSIE") {
//			$src[] = "/<embed/i";
//			$tar[] = "&lt;embed";
//		}
	
		$str = preg_replace($src,$tar,$str);
		return $str;
	}
		
/******************************************************************************
기능 : 주민번호 검사
사용법 : 
******************************************************************************/
	function rg_check_jumun($reginum) { 
		$weight = '234567892345'; // 자리수 weight 지정 
		$len = strlen($reginum); 
		$sum = 0; 
		
		if ($len <> 13) { return false; } 
		
		for ($i = 0; $i < 12; $i++) { 
			$sum = $sum + (substr($reginum,$i,1)*substr($weight,$i,1)); 
		} 
		
		$rst = $sum%11; 
		$result = 11 - $rst; 
		
		if ($result == 10) {$result = 0;} 
		else if ($result == 11) {$result = 1;} 
		
		$jumin = substr($reginum,12,1); 
		
		if ($result <> $jumin) {return false;} 
		return true; 
	} 
	
/******************************************************************************
기능 : 페이지 계산, 현재페이지 교정, 시작위치 지정
사용법 : 
******************************************************************************/
	function rg_navigation(&$page,$row_count,$page_size=20,$display_page=10) {
		if(empty($page_size)) $page_size = 20;
		if(empty($display_page)) $display_page = 10;
	
		$_result = array();
		$total_page=ceil($row_count/$page_size);
		if(empty($total_page)) $total_page = 1;

		if($page>$total_page) $page=$total_page;
		if(empty($page)) $page = 1;
	
		$start_row=($page-1)*$page_size;
		if($start_row<0)$start_row=0;
		
		$_result['page'] = $page;								// 현재페이지
		$_result['offset'] = $start_row;				// 페이지 시작 위치
		$_result['rows'] = $page_size;					// 목록에 보여줄 레코드 갯수
		$_result['total_rows'] = $row_count;		// 전체 개시물 갯수
		$_result['page_rows'] = $display_page;	// 목록의 페이지수 수
		$_result['total_page'] = $total_page;		// 전체 페이지 수
	
//		$start_page=floor(($page-1)/$display_page)*$display_page+1;
		$start_page=floor($page-$display_page/2)+1;
		if($start_page<1)$start_page=1;
		$end_page=$start_page+$display_page;
		if($end_page>$total_page)$end_page=$total_page+1; 
		if(($end_page-$start_page) < $display_page) $start_page=$end_page-$display_page;
		if($start_page<1) $start_page=1;
		if($end_page<=1) $end_page=2; 

//		$prior_page=$start_page-1;				// 이전 10페이지
		$prior_page=$page-$display_page;				// 이전 10페이지

//		$next_page=$end_page;					// 다음 10페이지
		$next_page=$page+$display_page;					// 다음 10페이지

		if($prior_page<1) $prior_page=1;
		if($next_page>$total_page) $next_page=$total_page; 
		if($start_page>1) $_result['first'] = 1;
		if($start_page>1) $_result['prior_step'] = $prior_page;
		if($page>1) $_result['prior'] = $page-1;
		$_result['pages']=array();
		for($i=$start_page;$i<$end_page;$i++)	$_result['pages'][] = $i;
		if($page<$total_page) $_result['next'] = $page+1;
		if($end_page<$total_page+1) $_result['next_step'] = $next_page;
		if($end_page<=$total_page) $_result['end'] = $total_page;
		$_result['start_no'] = $_result['total_rows']-$_result['offset']+1;

		return $_result;	
	}

/******************************************************************************
기능 : 네비게이션 표시
사용법 : 
******************************************************************************/
	function rg_navi_display($page_info,$p_str,$skin='') {
		$_result='';
		if(!empty($page_info['first']))
			$_result.=" <a href=\"?{$p_str}&page={$page_info['first']}\">[처음]</a> ";
		else
			$_result.=" [처음] ";
		
		if(!empty($page_info['prior_step']))
			$_result.=" <a href=\"?{$p_str}&page={$page_info['prior_step']}\">◁</a> ";
		else
			$_result.=" ◁ ";
		
		
		if(!empty($page_info['prior']))
			$_result.=" <a href=\"?{$p_str}&p={$page_info['prior']}\">＜</a> ";
		else
			$_result.=" ＜ ";
		
		for($i=0;$i<count($page_info['pages']);$i++) {
			if($page_info['pages'][$i] == $page_info['page'])
				$_result.=" [<font color=red>{$page_info['pages'][$i]}</font>] ";
			else
				$_result.=" <a href=\"?{$p_str}&page={$page_info['pages'][$i]}\">[{$page_info['pages'][$i]}]</a> ";
		}
		
		if(!empty($page_info['next']))
			$_result.=" <a href=\"?{$p_str}&page={$page_info['next']}\">＞</a> ";
		else
			$_result.=" ＞ ";
		
		if(!empty($page_info['next_step']))
			$_result.=" <a href=\"?{$p_str}&page={$page_info['next_step']}\">▷</a> ";
		else
			$_result.=" ▷ ";
		
		if(!empty($page_info['end']))
			$_result.=" <a href=\"?{$p_str}&page={$page_info['end']}\">[끝]</a> ";
		else
			$_result.=" [끝] ";
			
		return $_result;
	}



/******************************************************************************
기능 : 디렉토리의 파일 리스트를 받는 함수
사용법 : 
path  -> 파일리스트를 구할 디렉토리 경로
t     -> 리스트를 받을 목록
         f  : 지정한 디렉토리의 파일만 받음
         d  : 지정한 디렉토리의 디렉토리만 받음
         l  : 지정한 디렉토리의 링크만 받음
         fd : 지정한 디렉토리의 파일과 디렉토리만 받음
         fl : 지정한 디렉토리의 파일과 링크만 받음
         dl : 지정한 디렉토리의 디렉토리와 링크만 받음
         아무것도 지정하지 않았을 경우에는 fdl 모두 받음
regex -> 표현식을 사용할 수 있으며, regex 를 정의하면 t 는
         e 로 정의되어짐.
******************************************************************************/
	function rg_get_filelist($path='./',$t='',$regex='') {
		$t = $regex ? "e" : $t;
		if(is_dir($path)) {
			$p = opendir($path);
			while($i = readdir($p)) {
				switch($t) {
					case 'e'  :
						if($i != "." && $i != ".." && eregi("$regex",$i)) $file[] = $i;
						break;
					case 'f'  :
						if(is_file("$path/$i") && !is_link("$path/$i")) $file[] = $i;
						break;
					case 'd'  :
						if($i != "." && $i != ".." && is_dir("$path/$i")) $file[] = $i;
						break;
					case 'l'  :
						if(is_link("$path/$i")) $file[] = $i;
						break;
					case 'fd' :
						if($i != "." && $i != ".." && (is_dir("$path/$i") || is_file("$path/$i") && !is_link("$path/$i"))) $file[] = $i;
						break;
					case 'fl' :
						if(is_file("$path/$i")) $file[] = $i;
						break;
					case 'dl' :
						if($i != "." && $i != ".." && (is_dir("$path/$i") || is_link("$path/$i"))) $file[] = $i;
						break;
					default   :
						if($i != "." && $i != "..") $file[] = $i;
				}
			}
			closedir($p);
		} else {
			echo("$path is not directory");
			return 0;
		}
		sort($file);
		return $file;
	}	

/******************************************************************************
기능 : 접속한 사람이 사용하는 브라우져를 알기 위해 사용되는 함수
사용법 : 
******************************************************************************/
	function rg_get_agent() {
		$agent_env = $GLOBALS[HTTP_USER_AGENT];
	
		# $agent 배열 정보 [br] 브라우져 종류
		#                  [os] 운영체제
		#                  [ln] 언어 (넷스케이프)
		#                  [vr] 브라우져 버젼
		#                  [co] 예외 정보
		if(ereg("MSIE", $agent_env)) {
			$agent['br'] = "MSIE";
			# OS 별 구분
			if(ereg("NT", $agent_env)) $agent['os'] = "NT";
			else if(ereg("Win", $agent_env)) $agent['os'] = "WIN";
			else $agent['os'] = "OTHER";
			# version 정보
			$agent['vr'] = trim(eregi_replace("Mo.+MSIE ([^;]+);.+","\\1",$agent_env));
			$agent['vr'] = eregi_replace("[a-z]","",$agent['vr']);
		} else if(eregi("Gecko|Galeon",$agent_env) && !eregi("Netscape",$agent_env)) {
			$agent['br'] = "MOZL";
			# client OS 구분
			if(ereg("NT", $agent_env)) $agent['os'] = "NT";
			else if(ereg("Win", $agent_env)) $agent['os'] = "WIN";
			else if(ereg("Linux", $agent_env)) $agent['os'] = "LINUX";
			else $agent['os'] = "OTHER";
			# version 정보
			$agent['vr'] = eregi_replace("Mozi[^(]+\([^;]+;[^;]+;[^;]+;[^;]+;([^)]+)\).*","\\1",$agent_env);
			$agent['vr'] = str_replace("rv:","",$agent['vr']);
			# NS 와의 공통 정보
			$agent['co'] = "mozilla";
		} else if(ereg("Konqueror",$agent_env)) {
			$agent['br'] = "KONQ";
		} else if(ereg("Lynx", $agent_env)) {
			$agent['br'] = "LYNX";
		} else if(ereg("^Mozilla", $agent_env)) {
			$agent['br'] = "NS";
			# client OS 구분
			if(ereg("NT", $agent_env)) {
				$agent['os'] = "NT";
				if(ereg("\[ko\]", $agent_env)) $agent['ln'] = "KO";
			} else if(ereg("Win", $agent_env)) {
				$agent['os'] = "WIN";
				if(ereg("\[ko\]", $agent_env)) $agent['ln'] = "KO";
			} else if(ereg("Linux", $agent_env)) {
				$agent['os'] = "LINUX";
				if(ereg("\[ko\]", $agent_env)) $agent['ln'] = "KO";
			} else $agent['os'] = "OTHER";
			# version 정보
			if(eregi("Gecko",$agent_env)) $agent['vr'] = "6";
			else $agent['vr'] = "4";
			# Mozilla 와의 공통 정보
			$agent['co'] = "mozilla";
		} else $agent['br'] = "OTHER";
	
		return $agent;
	}
	
/******************************************************************************
기능 : 파일 다운로드
사용법 : 
******************************************************************************/
	function rg_file_download($server_name,$file_name,$type='application/octet-stream') {
		if($server_name=='' || $file_name=='') return 1;
		if($type=='') $type='application/octet-stream';
		$filesendsize=4096; 
		if(!($fp = @fopen($server_name, "rb")))
			 return false;

//		Header("Content-Type: application/octet-stream"); 
		Header("Content-Type: {$type}; name=$file_name"); 
		Header("Content-Disposition: attachment; filename=$file_name"); 
		$filesize = filesize($server_name); 
		for ($i = 0; $i <= $filesize; $i += $filesendsize) { 
			if(!$body = fread($fp, $filesendsize)) 
				return false;			 
			echo "$body"; // 화일내용을 읽어서 브라우저로 보내준다. 
		} 
		fclose($fp);
		return true;
	}	

/******************************************************************************
기능 : 파일 업로드
사용법 : 
	$upload_path 저장경로
	$upload_field 업로드 파일 필드명
	$ser_num  일련번호
 	$exist_files	기존 이미지(배열)
 	$del_chk 삭제여부(배열)
******************************************************************************/
	function rg_file_upload($upload_path,$upload_field,$ser_num,$exist_files=NULL,$del_chk=NULL)
	{
		global $_FILES;
		if(is_array($del_chk) && is_array($exist_files)) 
			foreach($del_chk as $k => $v)
				if($v=='1')
					if(@unlink($upload_path.$exist_files[$k][sname]))
						unset($exist_files[$k]);
						
		$file_name=$_FILES[$upload_field]['name'];
//		print_r($_FILES['mb_uppics']);
		$_tmp_files=array();
		if(is_array($file_name))
			foreach($file_name as $k => $v) {
				if($v == "none" || $v == '') continue;
				$_tmp_files[$k][name]=$_FILES[$upload_field]['name'][$k];
				$_tmp_files[$k][type]=$_FILES[$upload_field]['type'][$k];
				$_tmp_files[$k][size]=$_FILES[$upload_field]['size'][$k];
				$_tmp_files[$k][tmp_name]=$_FILES[$upload_field]['tmp_name'][$k];
				$_tmp_files[$k][hits]=$exist_files[$k][hits]; // 파일이 수정되도 다운회수는 그대로
			}
		unset($file_name);
		
		foreach($_tmp_files as $k => $v) {
			$tmp = mt_rand(100,999);
			$_tmp_files[$k][sname] = sprintf("%05d",$ser_num)."_{$tmp}_{$k}.file";
			if($exist_files[$k][sname]) unlink($upload_path.$exist_files[$k][sname]);
			if (file_exists($upload_path.$_tmp_files[$k][sname])) {
				$tmp = mt_rand(100,999);					
				$_tmp_files[$k][sname] = sprintf("%04d",$ser_num)."_{$tmp}_{$k}.file";
			}    
			if(!move_uploaded_file($_tmp_files[$k][tmp_name], $upload_path.$_tmp_files[$k][sname])) {
				return false;
			}
			unset($_tmp_files[$k][tmp_name]);
			$exist_files[$k]=$_tmp_files[$k];
		}
		return $exist_files;
	}
	
	function rg_file_upload_one($upload_path,$upload_field,$ser_num,$exist_file='',$del_chk='')
	{
		global $_FILES;
		if($del_chk!='' && $exist_file[sname]!='') 
			if(@unlink($upload_path.$exist_file[sname]))
				unset($exist_file);
						
		$_result['name']=$_FILES[$upload_field]['name'];
		$_result['type']=$_FILES[$upload_field]['type'];
		$_result['size']=$_FILES[$upload_field]['size'];
		$_result['tmp_name']=$_FILES[$upload_field]['tmp_name'];

		if($_result['name'] != "none" && $_result['name'] != '') {
			$tmp = mt_rand(100,999);
			$_result[sname] = sprintf("%05d",$ser_num)."_{$tmp}.file";
			if($exist_file[sname]) unlink($upload_path.$exist_file[sname]);
			if (file_exists($upload_path.$_result[sname])) {
				$tmp = mt_rand(100,999);					
				$_result[sname] = sprintf("%05d",$ser_num)."_{$tmp}.file";
			}    
			if(!move_uploaded_file($_result[tmp_name], $upload_path.$_result[sname])) {
				return false;
			}
			unset($_result[tmp_name]);
			$exist_file=$_result;
		}
		return $exist_file;
	}
	
/******************************************************************************
기능 : 파일의 확장명을 체크한다
사용법 : $exts 는 , 로 구분한다.
******************************************************************************/
	function rg_file_ext_chk($filename,$exts) {
		if($filename=='') return false;
		$exts=explode(',',strtolower($exts));
		rg_array_recursive_function($exts,'trim');
		$ext=trim(strtolower(substr($filename, strrpos($filename,'.')+1))); 
		return in_array($ext,$exts);
	}
	
/******************************************************************************
기능 : 파일의 타입을 체크한다
사용법 : $types 는 , 로 구분한다.
******************************************************************************/
	function rg_file_type_chk($type,$chk_types) {
		if($type=='') return false;
		$chk_types=explode(',',strtolower($chk_types));
		rg_array_recursive_function($chk_types,'trim');
		$types=explode('/',$type);
		foreach($types as $v) {
			if(in_array($v,$chk_types))
				return true;
		}
		return false;
	}

/******************************************************************************
기능 : 업로드된 파일을 전부 삭제한다.
사용법 : 
******************************************************************************/
	function rg_upload_file_delete($upload_path,$exist_files)
	{
		if(is_array($exist_files)) 
			foreach($exist_files as $v)
				@unlink($upload_path.$v['sname']);
	}
	
/******************************************************************************
기능 : 아이피 체크 list는 , 로 분리 리스트 안에 ip가 있는지
사용법 : 
******************************************************************************/
	function rg_chk_deny_ip($list,$ip='') {
		global $REMOTE_ADDR;
		if(!$ip) $ip = $REMOTE_ADDR;

		$is_exist = false;
		$list = explode(",", trim($list));
		foreach($list as $key => $val) {
				$val = trim($val);
				if ($val=='') continue;
				$reg_str = "/^({$val})/";
				$is_exist = preg_match($reg_str, $ip);
				if ($is_exist)
						break;
		}
		unset($key);
		unset($val);
		unset($list);

		return $is_exist;
	}
	
/******************************************************************************
기능 : $str 안에 $list 가 있는지 검사
사용법 : 
******************************************************************************/
	function rg_str_inword($list,$str) {
		$_result = '';
		$list = explode(",", trim($list));
		foreach($list as $key => $val) {
			$val = trim($val);
			if ($val=='') continue;
			$val = str_replace('/','\/',$val);
			$val = str_replace('(','\(',$val);
			$val = str_replace(')','\)',$val);
			$reg_str = "/({$val})/i";
			if (preg_match($reg_str, $str)) {
				$_result = $val;
				break;
			}
		}
		unset($key);
		unset($val);
		unset($list);
		
		return $_result;
	}

/******************************************************************************
기능 : $str 안에 $list 태그를 변환한다.
사용법 : 
******************************************************************************/
	function rg_script_conv($list,$str) {
		$source = array();
		$target = array();
		$list = explode(",", trim($list));
		while (list ($key, $val) = each ($list)) {
			$val = trim($val);
			if (!$val) continue;
			$source[] = "/<{$val}/i";
			$target[] = "<rg-{$val}";
			$source[] = "/<\/{$val}/i";
			$target[] = "</rg-{$val}";
			
		}
		$source[] = "/(\s+)(on)([a-z]+)(\s*)(\=)/i"; // XSS 대응
		$target[] = "$1&#111;&#110;$3$4$5";
		return preg_replace($source, $target, $str);
	}
	
/******************************************************************************
기능 : 하위 디렉토리와 파일을 전부 삭제한다.
사용법 : 
******************************************************************************/
	function rg_delete_board_file($path) { // 재귀적으로 파일을 지운다.
		if(is_dir($path)) {
			$p = opendir($path);
			while($i = readdir($p)) {
				if($i != "." && $i != "..") {
					if(is_dir("$path/$i")){
						rg_delete_board_file("$path/$i");
					} else {
						unlink("$path/$i");
					}
				}
			}
			closedir($p);
			rmdir($path);
		}
	}

/******************************************************************************
기능 : 아이피 일부분을 숨긴다
사용법 : 
******************************************************************************/
	function rg_hidden_ip($ip) {
		$ptn_src = '/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/';
		$ptn_dst = '\1.xxx.\3.xxx';
		return preg_replace($ptn_src,$ptn_dst,$ip);
	}




/******************************************************************************
기능 : 섬네일
사용법 : 
******************************************************************************/

 function thumbnail($file, $thumbpath, $max_side, $fixed = true) { 
        // 1 = GIF, 2 = JPEG 
        if(!$max_side) $max_side = 100; 
        if(file_exists($file)) {              
            $type = getimagesize($file); 
         
            if(!function_exists('imagegif') && $type[2] == 1) { 
                $error = 'Filetype not supported. Thumbnail not created.'; 
            } 
            elseif (!function_exists('imagejpeg') && $type[2] == 2) { 
                $error = 'Filetype not supported. Thumbnail not created.'; 
            } 
            else {     
                // create the initial copy from the original file 
                if($type[2] == 1) { 
                    $image = imagecreatefromgif($file); 
                } 
                elseif($type[2] == 2) { 
                    $image = imagecreatefromjpeg($file); 
                } 
                 
                if(function_exists('imageantialias')) 
                    imageantialias($image, TRUE); 
     
                $image_attr = getimagesize($file); 
     
                // figure out the longest side 
     
                if($image_attr[0] > $image_attr[1]): 
                    $image_width = $image_attr[0]; 
                    $image_height = $image_attr[1]; 
                                        
                    if($fixed) { 
                        $image_new_width  = $max_side; 
                        $image_new_height = (int)($max_side * 3 / 4); 
                        // 4:3 ratio 
                    } else { 
                        $image_new_width = $max_side; 
         
                        $image_ratio = $image_width / $image_new_width; 
                        $image_new_height = (int) ($image_height / $image_ratio); 
                    } 
                    //width > height 
                else: 
                    $image_width = $image_attr[0]; 
                    $image_height = $image_attr[1]; 
                    if($fixed) { 
                        $image_new_height = $max_side; 
                        $image_new_width  = (int)($max_side * 3 / 4); 
                        // 3:4 ratio 
                    } else { 
                        $image_new_height = $max_side; 
         
                        $image_ratio = $image_height / $image_new_height; 
                        $image_new_width = (int) ($image_width / $image_ratio); 
                    } 
                    //height > width 
                endif; 
     
                $thumbnail = imagecreatetruecolor($image_new_width, $image_new_height); 
                @ imagecopyresampled($thumbnail, $image, 0, 0, 0, 0, $image_new_width, $image_new_height, $image_attr[0], $image_attr[1]); 
                 
                $thumb = preg_replace('!(\.[^.]+)?$!', '.thumbnail'.'$1', basename($file), 1); 
                $thumbpath = str_replace(basename($file), $thumb, $file); 

                // move the thumbnail to it's final destination 
                if($type[2] == 1) { 
                    if (!imagegif($thumbnail, $thumbpath)) { 
                        $error = 'Thumbnail path invalid'; 
                    } 
                } 
                elseif($type[2] == 2) { 
                    if (!imagejpeg($thumbnail, $thumbpath)) { 
                        $error = 'Thumbnail path invalid'; 
                    } 
                }     
            } 
        } else { 
            $error = 'File not found'; 
        } 
     
        if(!empty($error)) { 
            die($error); 
        } else { 
            return $thumbpath; 
        } 
         
    } 








/******************************************************************************
기능 : 배열에 함수를 적용한다.(재귀호출...)
사용법 : 
******************************************************************************/
	function rg_array_recursive_function(&$array, $function)
	{
		if(is_array($array))
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				rg_array_recursive_function($array[$key], $function);
			} else {
				$array[$key] = $function($value);
			}
		}
	}
	
	function rg_base64($str,$decode=false) {
		if($str=='') return '';
		if($decode) {
			return base64_decode($str);
		} else {
			return base64_encode($str);
		}
	}

} // *-- FUNC_INC_INCLUDED END --*
?>