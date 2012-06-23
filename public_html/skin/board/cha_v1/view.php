<? if (!defined('RGBOARD_VERSION')) exit; ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td height="1" bgcolor="#CCCCCC"></td>
	</tr>
</table>
<table border="0" cellpadding="5" cellspacing="0" width="100%" style="table-layout:fixed">
	<tr>
		<td width="120" align="center" bgcolor="#E8ECF1"><strong>작성자</strong></td>
		<td>
		<div style="float:left;">
		<?=$bd_name_layer?>
		<?=($bd_email || $bd_home)?"(":""?>
		<?=($bd_email!='')?"<img src=\"{$skin_url}images/mail_icon.gif\" align=\"absmiddle\"> $bd_email ":""?>
    <?=($bd_email && $bd_home)?",":""?>
		<?=($bd_home!='')?" <img src=\"{$skin_url}images/home_icon.gif\" align=\"absmiddle\"> $bd_home ":""?>
		<?=($bd_email || $bd_home)?")":""?>
		</div>
		<div style="float:right;">[<?=rg_date($data['bd_write_date'],$vcfg['date_format'])?>]</div>
		</td>
		<tr>
		<td colspan="2" height="1" bgcolor="#CCCCCC"></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#E8ECF1"><strong>제목</strong></td>
		<td><div style="float:left;"><?=($vcfg['use_category'] && $_category_name_array[$cat_num]!='')?"[".$_category_name_array[$cat_num]."]":""?><?=$bd_subject?></div><div style="float:right;">
		조회수 : <?=$bd_view_count?>
		<? if($vcfg['btn_vote_yes'] || $vcfg['btn_vote_no']) { ?>
		(<?=($vcfg['btn_vote_yes'])?"추천 : {$bd_vote_yes}":""?><?=($vcfg['btn_vote_yes'] && $vcfg['btn_vote_no'])?" / ":""?><?=($vcfg['btn_vote_no'])?"반대 : {$bd_vote_no}":""?>)
<? } ?>
		</div></td>
	</tr>
		<tr>
		<td colspan="2" height="1" bgcolor="#CCCCCC"></td>
	</tr>
<?
	if(is_array($bd_links) && (count($bd_links) > 0)) {
?>
	<tr>
    <td align="center" bgcolor="#E8ECF1"><strong>링크</strong></td>
	  <td>
<?
		foreach($bd_links as $k => $v) {
			if($v['url']=='') continue;
			if($v['name']=='') $v['name']=$v['url'];
?>
<a href="<?=$v['link_url']?>" target="_blank"><?=$v['name']?>&nbsp;(Click : <?=number_format($v['hits'])?>)</a><br>
<? 	} ?>
		</td>
  </tr>
  	<tr>
		<td colspan="2" height="1" bgcolor="#CCCCCC"></td>
	</tr>
<?
	}
?>
<?
	if($vcfg['use_download']) {
?>
	<tr>
    <td align="center" bgcolor="#E8ECF1"><strong>첨부파일</strong></td>
		<td>
<?
		foreach($bd_files as $k => $v) {
			if($v['name']=='') continue;
?>
<a href="<?=$v['down_url']?>"><?=$v['name']?>&nbsp;(Down :<?=number_format($v['hits'])?>)</a><br>
<? 	} ?>
		</td>
	</tr>
		<tr>
		<td colspan="2" height="1" bgcolor="#CCCCCC"></td>
	</tr>
<?
	}
?>
	<tr>
		<td colspan="2" align="center" style='word-break:break-all'>
		<div style="float:right;"><A href="javascript:changesize('+')"><img src="<?=$skin_url?>images/view_plus.gif" width="27" height="19" alt='확대보기' border="0"></a>
		<A href="javascript:changesize('-')"><img src="<?=$skin_url?>images/view_minor.gif" width="27" height="19" alt='축소보기' border="0"></a></div>
<?
	if($vcfg['view_image']) {
?>
<img id="view_image_width" height="0" width="100%"><br />
<script language="JavaScript" type="text/JavaScript">
if(onload) var set_img_old_onload=onload;
onload=set_img_width_init;
</script>
<?
		foreach($bd_files as $k => $v) {
			if(!rg_file_type_chk($v['type'],'image')) continue;
?>
<img src="<?=$v['view_url']?>" onclick="view_image_popup(this)" style="cursor:hand;" id="view_image"><br><br>
<? 	}
	}
?>		
<div id="ct" align="left"><?=$bd_content?></div>
<SCRIPT LANGUAGE="JavaScript">
	document.all.ct.style.fontSize=11;
	document.all.ct.style.lineHeight=1.6;
	function changesize(flag){
		obj = document.all.ct.style.fontSize;
		num = eval(obj.substring(0,obj.length-2)*1);
		if(!isNaN(num)){
			if(flag=='+'){
				document.all.ct.style.fontSize = eval(num + 1);
			}else{
				if(num > 1)
				document.all.ct.style.fontSize = eval(num - 1);
				else
				alert('이미 폰트의 최소 사이즈입니다.');
			}
		}
	}
</script>
		</td>
	</tr>

<? if($vcfg['view_signature']) { ?>
	<tr>
    <td align="center" bgcolor="#E8ECF1"><strong>서명</strong></td>
		<td>
<?=$mb_signature?>
		</td>
	</tr>
		<tr>
		<td colspan="2" height="1" bgcolor="#CCCCCC"></td>
	</tr>
<? } ?>
</table>
<br />
<?
	if($vcfg['view_comment']) // 코멘트 표시여부 
		if(file_exists($skin_path."view_comment.php")) include($skin_path."view_comment.php");
?>
<br />
<table cellpadding="0" cellspacing="0" width="100%"> 
<?
	if($prev_data) { ?>
		   <tr> 
       <td width="100%" height="1" bgcolor="#e7e7e7"> 
           <p></p> 
       </td> 
   </tr> 
	   <tr height=26> 
       <td> 
           <table cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;"> 
               <tr> 
                   <td width="55"><img src="<?=$skin_url?>images/prev.gif" border=0></td> 
                   <td nowrap><b><a href="<?=$url_view_prev?>"><?=$prev_data['bd_subject']?></a></b></td> 
                   <td width="70" align="right"> 
                      <?=$prev_data['bd_name']?>
                   </td> 
               </tr> 
           </table> 
		          </td> 
   </tr>
	<? } 
	if($next_data) { ?>
	   <tr> 
       <td width="100%" height="1" bgcolor="#e7e7e7"> 
           <p></p> 
       </td> 
   </tr> 
   <tr height=26> 
       <td> 
           <table cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed;"> 
               <tr> 
                   <td width="55"><img src="<?=$skin_url?>images/next.gif" border=0></td> 
                   <td nowrap><b><a href="<?=$url_view_next?>"><?=$next_data['bd_subject']?></a></b></td> 
                   <td width="70" align="right"> 
                      <?=$next_data['bd_name']?>
                   </td> 
               </tr> 
           </table>
		     </td> 
   </tr> 
	<? } 
	?>
	   <tr> 
       <td width="100%" height="1" bgcolor="#e7e7e7"> 
           <p></p> 
       </td> 
   </tr> 
</table>
<br />

<table width="100%" border="0">
	<tr>
		<td align="left">
<? if($vcfg['btn_modify']) { ?>	
<img src="<?=$skin_url?>images/modify.gif" onClick="location.href='<?=$url_modify?>'" style="cursor:pointer" align="absmiddle">
<? } ?>
<? if($vcfg['btn_del']) { ?>	
<img src="<?=$skin_url?>images/delete.gif" onClick="location.href='<?=$url_delete?>'" style="cursor:pointer" align="absmiddle">
<? } ?>
<? if($vcfg['btn_reply']) { ?>	
<img src="<?=$skin_url?>images/reply.gif" onClick="location.href='<?=$url_reply?>'" style="cursor:pointer" align="absmiddle">
<? } ?>
<? if($vcfg['vote_yes']) { ?>	
<img src="<?=$skin_url?>images/vote_good.gif" onClick="location.href='<?=$url_vote_yes?>'" style="cursor:pointer" align="absmiddle">
<? } ?>
<? if($vcfg['vote_no']) { ?>	
<img src="<?=$skin_url?>images/vote_bad.gif" onClick="location.href='<?=$url_vote_no?>'" style="cursor:pointer" align="absmiddle">
<? } ?>
		</td>
		<td align="right">
<? if($vcfg['btn_list']) { ?>
		<img src="<?=$skin_url?>images/list.gif" onClick="location.href='<?=$url_list?>'" style="cursor:pointer" align="absmiddle">
<? } ?>
		</td>
	</tr>
</table>
<? if($vcfg['view_list']) { ?>
<br>
<table width="100%" border="0">
	<tr>
		<td>
<? include('list_main_process.php'); ?>
		</td>
	</tr>
</table>
<? } ?>
