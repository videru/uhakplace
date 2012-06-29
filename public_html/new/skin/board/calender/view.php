<? if ($_REQUEST[skin_path]) exit; ?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td height="1" bgcolor="#CCCCCC"></td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="table-layout:fixed">
	<tr height="25px">
		<td width="90" align="center" bgcolor="#E8ECF1"><strong>일시</strong></td>
		<td style="padding-left:10px;">
		<?=rg_date($bd_ext5,'%Y-%m-%d')?>
		</td>
		<td width="90" align="center" bgcolor="#E8ECF1"><strong>일정</strong></td>
		<td style="padding-left:10px;">
		<?=($vcfg['use_category'] && $_category_name_array[$cat_num]!='')?"[".$_category_name_array[$cat_num]."] ":""?> <?=$bd_subject?>
		</td>
	</tr>
		<tr>
		<td colspan="4" height="1" bgcolor="#CCCCCC"></td>
	</tr>
	<tr>
		<td colspan="4" align="center" style="padding-top:5px;word-break:break-all">
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
			if($v['name']=='') continue;
			list($is_image)=explode('/',$v['type']);
			if($is_image!='image') continue;
?>
<img src="<?=$v['view_url']?>" onclick="view_image_popup(this)" id="view_image" style="cursor:pointer; border:2px solid #e4e4e4;"><br /><br />
<? 	}
	}
?>		
<div id="ct" align="left"><?=$bd_content?>
</div>
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
<br />
<div style="float:left;"><a onclick="toggle_display_object(more_info,span_design,'▶','◀')" style="cursor:pointer;"><strong>추가정보</strong><span id="span_design"><?=$sub_cfg_toggle?></span></a></div>
<div id='more_info' style='float:right;display:none;'>
	작성자 : <span onClick="rg_bbs_layer('<?=$bbs_code?>','<?=$bd_num?>','<?=$bd_name?>','<?=$mb_id?>','<?=$open_homepage?>','<?=$open_email?>','<?=$open_profile?>','<?=$open_memo?>')" style='cursor:pointer;'><?=($mb_icon)?$mb_icon:$bd_name?></span>
	<?=($bd_email || $bd_home)?"(":""?>
	<?=($bd_email!='')?"<a href=\"{$_path['member']}mail.php?to={$bd_email}\" target=\"_blank\"><img src=\"{$skin_url}images/mail_icon.gif\" align=\"absmiddle\" border=\"0\"> $bd_email</a>":""?>
	<?=($bd_email && $bd_home)?",":""?>
	<?=($bd_home!='')?"<a href=\"{$bd_home}\" target=\"_blank\"><img src=\"{$skin_url}images/home_icon.gif\" align=\"absmiddle\" border=\"0\"> $bd_home</a> ":""?>
	<?=($bd_email || $bd_home)?")":""?>
	조회수 : <b><?=$bd_view_count?></b>건
	작성일 : <b><?=rg_date($data['bd_write_date'],$vcfg['date_format'])?></b>
	<? if($vcfg['btn_vote_yes'] || $vcfg['btn_vote_no']) { ?>
	<?=($vcfg['btn_vote_yes'])?"추천 : {$bd_vote_yes}":""?><?=($vcfg['btn_vote_yes'] && $vcfg['btn_vote_no'])?" / ":""?><?=($vcfg['btn_vote_no'])?"반대 : {$bd_vote_no}":""?>)
	<? } ?>
	<?
		if(is_array($bd_links) && (count($bd_links) > 0)) {
			foreach($bd_links as $k => $v) {
			if($v['url']=='') continue;
			if($v['name']=='') $v['name']=$v['url'];
		?>
		링크 : <a href="<?=$v['link_url']?>" target="_blank"><b><?=$v['name']?></b>&nbsp;(Click : <?=number_format($v['hits'])?>)</a>
		<? 	
		} 
	}
		if($vcfg['use_download'] && (is_array($bd_files) && (count($bd_files) > 0))) {
			foreach($bd_files as $k => $v) {
			if(!file_type_chk($v['type'],'image')) {
		?>
		첨부파일 : <a href="<?=$v['down_url']?>"><b><?=$v['name']?></b>&nbsp;(Down :<?=number_format($v['hits'])?>)</a>&nbsp;&nbsp;
		<? 	
		}
		}
	}
	?>
		</div>
		</td>
	</tr>

<? if($vcfg['view_signature']) { ?>
		<tr>
    <td colspan="4" bgcolor="#E8ECF1">
	<?=$mb_signature?>
	</td>
	</tr>
		<tr>
		<td colspan="4" height="1" bgcolor="#CCCCCC"></td>
	</tr>
<? } ?>
</table>
<?
	if($vcfg['view_comment']) // 코멘트 표시여부 
		if(file_exists($skin_path."view_comment.php")) include($skin_path."view_comment.php");
?>
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
<br /><br />
<table width="100%" border="0">
	<tr>
		<td>
<? 
		$bd_subject=$data[$s]['bd_subject'];
		$bd_num=$data[$s]['bd_num'];//$view_url,chk_nums
		$view_url="view.php?$_get_param[3]&bd_num={$data[$s]['bd_num']}";
		$bd_depth=$data[$s]['bd_depth'];//$i_reply
		$bd_comment_count=$data[$s]['bd_comment_count'];//$i_comment_count
		$bd_write_date=$data[$s]['bd_write_date'];//$i_new 
		$bd_secret=$data[$s]['bd_secret'];//$i_secret
		$bd_delete=$data[$s]['bd_delete'];//$i__delete
		$bd_notice=$data[$s]['bd_notice'];//$i_notice
		include('list_main_process.php'); 
?>
		</td>
	</tr>
</table>
<? } ?>