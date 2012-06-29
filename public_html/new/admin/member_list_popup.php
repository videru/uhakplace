<?
/* =====================================================
	
  최종수정일 : 
 ===================================================== */
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
	list($is_multi,$form_name,$f_key,$f_value,$f_text,$f_display) = explode('|',$form_info);
	if($f_key=='') $f_key="mb_num";
	$rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['member']);

	if(is_array($ss)) {
		foreach($ss as $__k => $__v) {
			switch ($__k) {
				/***********************************************************************/
				// 검색어로 검색
				// 1=>'회원아이디',2=>'회원성명',3=>'주민번호',4=>'회원주소',5=>'전화번호', 6=>'휴대폰',7=>'이메일'
				case '0' : 
					if($kw!='' && $__v!='') {
						$ss_kw=$dbcon->escape_string($kw,DB_LIKE);
						switch ($__v) {
							case '1' : $rs_list->add_where("mb_id LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '2' : $rs_list->add_where("mb_name LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '3' : $jumin=$dbcon->escape_string(rg_password_encode($kw));
												 $rs_list->add_where("mb_jumin = '$jumin'"); break;
							case '4' : $rs_list->add_where("(mb_address1 LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."' OR mb_address2 LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."') "); break;
							case '5' : $rs_list->add_where("mb_tel1 LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '6' : $rs_list->add_where("mb_tel2 LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
							case '7' : $rs_list->add_where("mb_email LIKE '%$ss_kw%' escape '".$dbcon->escape_ch."'"); break;
						}
						unset($ss_kw);
					}
					break; 
				/***********************************************************************/
				// 필터 조건에 의한 필터링
				case '1' : // 회원상태
					if($__v != '') { $rs_list->add_where("'$__v' =  mb_state"); } break;
				case '2' : // 회원레벨
					if($__v !== '') { $rs_list->add_where("'$__v' =  mb_level"); } break;
			}
		}
	}

	switch ($ot) {
		case 10 : $rs_list->add_order("mb_num DESC");		break;
		default : $rs_list->add_order("mb_num DESC");		break;
	}
	
	$page_info=$rs_list->select_list($page,20,10);

	$MENU_L='m2';	
?>
<? include("_header.php"); ?>
<script>
function member_mail(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한명이상 선택 하세요.');
		return;
	}
	list_form.mode.value='check';
	list_form.action='member_mail.php';
	list_form.submit();
}
function member_del(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('한명이상 선택 하세요.');
		return;
	}
	list_form.mode.value='delete';
	list_form.action='?<?=$p_str?>';
	list_form.submit();
}
var values=new Array();
var texts=new Array();
</script>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="site_content">
  <tr>
    <td bgcolor="#F7F7F7">회원선택</td>
  </tr>
</table>
<br>
<table width="100%" cellspacing="0" style="border-collapse:collapse;table-layout:auto">
<form name="search_form" method="get" enctype="multipart/form-data">
<input type="hidden" name="form_info" value="<?=$form_info?>">
	<tr> 
		<td>
상태 : <select name="ss[1]" onChange="search_form.submit()">
<option value="">=전체=</option>
<?=rg_html_option($_const['member_states'],"$ss[1]")?>
</select>
레벨 : <select name="ss[2]" onChange="search_form.submit()">
<option value="">=전체=</option>
<?=rg_html_option($_level_info,"$ss[2]")?>
</select>							
검색: <select name="ss[0]">
<? $ss_list = array(1=>'회원아이디',2=>'회원성명',3=>'주민번호',4=>'회원주소',5=>'전화번호',
						6=>'휴대폰',7=>'이메일'); ?>
<?=rg_html_option($ss_list,"$ss[0]")?>
			</select>
			<input name="kw" type="text" id="kw" value="<?=$kw?>" size="10" class="input"> <input type="submit" name="검색" value="검색" class="button"> 
			<input type="button" value="취소" onclick="location.href='?'" class="button">
		</td>
		<td align="right">Total : 
			<?=$page_info['total_rows']?>
			(<?=$page_info['page']?>/<?=$page_info['total_page']?>)</td>
    </tr>
</form>
</table>
<br>
<? if($is_multi) { ?>
<script>
var values=new Array();
var texts=new Array();
</script>
<? } ?>
<form name="list_form" method="post" enctype="multipart/form-data" action="?<?=$p_str?>">
<input type="hidden" name="form_info" value="<?=$form_info?>">
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="site_list" onmouseover="list_over_color(event,'#FFE6E6',1)" onmouseout='list_out_color(event)'>
	<tr align="center" bgcolor="#F0F0F4">
<? if($is_multi) { ?>
		<td width="20"><input type="checkbox" onClick="set_checkbox(list_form,'chk_nums[]',this.checked)" class="none"></td>
<? } ?>
		<td width="40" >번호</td>
		<td>아이디</td>
		<td>상태</td>
		<td>레벨</td>
		<td>가입</td>
		<td>로그인</td>
		<td>접속</td>
<? if(!$is_multi) { ?>
		<td width="80">
			선택
		</td>
<? } ?>
		</tr>
<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\">
		<td align=\"center\" colspan=\"12\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$no = $page_info['start_no'];
	while($R=$rs_list->fetch()) {
		$no--;
		$value=$R[$f_key];
		$text=$f_display;
		$text=str_replace('[mb_num]',$R[mb_num],$text);
		$text=str_replace('[mb_id]',$R[mb_id],$text);
		$text=str_replace('[mb_name]',$R[mb_name],$text);
		$text=str_replace('[mb_nick]',$R[mb_nick],$text);
?>
<script>values[<?=$R[mb_num]?>]='<?=$value?>';texts[<?=$R[mb_num]?>]='<?=$text?>';</script>
	<tr height="25">
<? if($is_multi) { ?>
		<td align="center"><input type=checkbox name="chk_nums[]" value="<?=$R[mb_num]?>" class=none></td>
<? } ?>
		<td align="center"><?=$no?></td>
		<td align="center"><?=$R[mb_id]?></td>
		<td align="center"><?=$_const['member_states'][$R[mb_state]]?></td>
		<td align="center"><?=$_level_info[$R[mb_level]]?></td>
		<td align="center"><?=rg_date($R[join_date],'%Y-%m-%d')?></td>
		<td align="center"><?=rg_date($R[login_date],'%Y-%m-%d')?></td>
		<td align="center"><?=$R[login_count]?></td>
<? if(!$is_multi) { ?>
		<td width="80" align="center">
			<input type="button" value="선택" class="button" onClick="member_select(<?=$R[mb_num]?>)">		</td>
<? } ?>
		</tr>
<?
}
?>
</table>
</form>
<table width="100%">
	<tr>
<? if($is_multi) { ?>
		<td width="80">
			<input type="button" value="선택" class="button" onClick="member_select_multi()">
		</td>
<? } ?>
		<td align="center">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
</table>
<? 
	list($is_multi,$form_name,$f_key,$f_value,$f_text,$f_display) = explode('|',$form_info);
//	if($f_value!='') $f_value='opener.'.$form_name.'.'.$f_value;
//	if($f_text!='') $f_text='opener.'.$form_name.'.'.$f_text;
?>
<script>
	function member_select(num)
	{	
		<? if($f_value!='') { ?>
		<?=$f_value?>.value=values[num];
		<? } ?>

		<? if($f_text!='') { ?>
		<?=$f_text?>.value=texts[num];
		<? } ?>
		self.close();
	}
	
	function member_select_multi()
	{	
		var rtn_value = new Array();
		var rtn_text = new Array();
		var j=0
		var list_form=document.forms['list_form']
		for(i=0;i<list_form.length;i++)
			if(list_form[i].type=="checkbox" && list_form[i].name=='chk_nums[]')
				if(list_form[i].checked) {
					rtn_value[j]=values[list_form[i].value];
					rtn_text[j]=texts[list_form[i].value];
					j++;
				}

		<? if($f_value!='') { ?>
		
		if(window.opener.document.getElementById('<?=$f_value?>') != null) {
			obj=window.opener.document.getElementById('<?=$f_value?>');
		} else {
			obj=window.opener.document.<?=$form_name?>.<?=$f_value?>
		}
		
		if(obj.value=='')
			obj.value=rtn_value;
		else
			obj.value=obj.value+','+rtn_value;
			
		<? } ?>

		<? if($f_text!='') { ?>
		
		if(window.opener.document.getElementById('<?=$f_text?>') != null) {
			obj=window.opener.document.getElementById('<?=$f_text?>');
		} else {
			obj=window.opener.document.<?=$form_name?>.<?=$f_text?>
		}

		if(obj.value=='')
			obj.value=rtn_text;
		else
			obj.value=obj.value+','+rtn_text;
			
		<? } ?>
		
		self.close();
	}
</script>
<script language="JavaScript" type="text/JavaScript">
	var f = document.mb_form;
	function formcheck2()
	{
		if(!list_checkbox(document.mb_list,'bg_num[]')) {
			alert('하나 이상선택해주세요.');
			return false;
		}
		return true;
	}
</script>
<? include("_footer.php"); ?>