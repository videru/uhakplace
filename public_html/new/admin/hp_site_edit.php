<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table(	$_table['hp_site']);
		$rs->add_where("num=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // 정보가 올바르지 않다면
			rg_href('','정보를 찾을수 없습니다.','back');
		}
		$data=$rs->fetch();		
		
	} else {
		$data=$rs->fetch();		
	}
	
 	
		// 학교 삭제
	if($mode=='delete') {	
		$rs->clear();
		$rs->set_table($_table['hp_site']);
		$rs->add_where("num=$num");
		$rs->delete();
		
		$rs->commit();
		rg_href("hp_site_list.php?$_get_param[3]");
	}


	if($_SERVER['REQUEST_METHOD']=='POST') {



            $rs->clear();
	    	$rs->set_table($_table['hp_site']);	
			$rs->add_field("code","$code");		
			$rs->add_field("national","$national");		
			$rs->add_field("title","$title");		            
			$rs->add_field("content","$content");

		if($mode=='modify') {
			$rs->add_where("num=$num");
			$rs->update();
		} else {
			$rs->insert();
			$num=$rs->get_insert_id();		
		}

	    	rg_href("hp_site_list.php?$_get_param[3]");


	}

?>	
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>

<?
include_once('../editor/func_editor.php');
$content = "$data[content]";
?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>페이지관리</b></font></td>
  </tr>
</table>
<form name="mb_form" method="post" action="?<?=$_get_param[3]?>" Onsubmit="return(chk());" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="num" value="<?=$num?>" />
<input type="hidden" name="code" value="<?=$data[code]?>" />
<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title"><b>페이지정보 <? if($mode=='modify') { ?>수정<?}else{?>등록<? } ?></td>
   </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="800" align=center bgcolor="#FFFFFF">
    <tr>  
     <td>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 
  </table>

<table width="770" align="center" border="0" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
	
   <tr>
      <td bgColor=#f5f5f5 align="center" height="20">코드</td>
      <td bgcolor="#FFFFFF" colspan="3">&nbsp;<input type="text" name="code" value="<?=$data[code]?>" class="cc" size="10" maxlength="10" style='border-width:1; border-color:rgb(136,136,136); border-style:solid;'> *코드 값 수정을 원할 경우 문의 주세요.</td>               
   </tr>
     <tr> 
      <td bgColor=#f5f5f5 align="center">국가</td>
      <td bgcolor="#FFFFFF" colspan="3">&nbsp;<select name="national" class="select2">
        <?=rg_html_option($_const['national'],$data['national'])?>
        </select>
	</td>
   </tr> 
   <tr>
      <td bgColor=#f5f5f5 align="center">페이지이름</td>
      <td bgcolor="#FFFFFF" colspan="3">&nbsp;<input type="text" name="title" value="<?=$data[title]?>" class="cc" size="80" maxlength="150" style='border-width:1; border-color:rgb(136,136,136); border-style:solid;'></td>               
   </tr>
   <tr> 
      <td bgcolor=#f5f5f5 align="center">페이지정보</td>
      <td bgcolor="#FFFFFF" colspan="3">&nbsp;<?=myEditor(1,'../editor','mb_form','content','100%','500');?></td>
   </tr>
</table>



<br>
<table width="200" border="0"  align=center>
	<tr>
		<td width="100" align="center"><INPUT onfocus=this.blur() type=image src="images/bt_write.gif" onClick="editor_wr_ok();"></td>
		<td width="100" align="center"><img src="images/bt_list2.gif" onClick="history.back();" style="hand:cursor"></td>
	</tr>
</table>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>
<script type="text/javascript">
 function pop()
 {
  window.open('../phil/school_cost.php?&num=<?=$num?>', 'window' ,'toolbar=no,width=400,height=550,fullscreen=no,directories=no,status=no,scrollbars=yes,resize=no,menubar=no,location=no');
 }   
</script>
