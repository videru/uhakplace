<? if (!defined('RGBOARD_VERSION')) exit; ?>
<table width="100%" border="0">
	<tr>
		<td align="left">
<? if($prev_data) { ?>
		<input type="button" value="이전" onClick="location.href='<?=$url_view_prev?>'" class="button">
<? } ?>
<? if($next_data) { ?>
		<input type="button" value="다음" onClick="location.href='<?=$url_view_next?>'" class="button">
<? } ?>
<? if($vcfg['btn_modify']) { ?>	
		<input type="button" value="수정" onClick="location.href='<?=$url_modify?>'" class="button">
<? } ?>
<? if($vcfg['btn_del']) { ?>	
		<input type="button" value="삭제" onClick="location.href='<?=$url_delete?>'" class="button">
<? } ?>
<? if($vcfg['btn_reply']) { ?>	
		<input type="button" value="답변" onClick="location.href='<?=$url_reply?>'" class="button">
<? } ?>
<? if($vcfg['btn_vote_yes']) { ?>	
		<input type="button" value="추천" onClick="location.href='<?=$url_vote_yes?>'" class="button">
<? } ?>
<? if($vcfg['btn_vote_no']) { ?>	
		<input type="button" value="반대" onClick="location.href='<?=$url_vote_no?>'" class="button">
<? } ?>
		</td>
		<td align="right">
<? if($vcfg['btn_list']) { ?>
		<input type="button" value="목록보기" onClick="location.href='<?=$url_list?>'" class="button">
<? } ?>
		</td>
	</tr>
</table>
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1" style="table-layout:fixed">
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>작성자</strong></td>
		<td><?=$bd_name_layer?></td>
	</tr>
	<tr>
		<td width="120" align="center" bgcolor="#F0F0F4"><strong>작성일</strong></td>
		<td><?=rg_date($data['bd_write_date'],$vcfg['date_format'])?></td>
	</tr>
<? if($bd_home) { ?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>홈페이지</strong></td>
	  <td><?=$bd_home?></td>
  </tr>
<? } ?>
<? if($vcfg['use_category']) { ?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>분류</strong></td>
	  <td><?=$_category_name_array[$cat_num]?></td>
  </tr>
<? } ?>
<? if($vcfg['btn_vote_yes'] || $vcfg['btn_vote_no']) { ?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>&nbsp;</strong></td>
	  <td><? if($vcfg['btn_vote_yes']) { ?>추천 : <?=$bd_vote_yes?><? } ?>
				<? if($vcfg['btn_vote_yes'] && $vcfg['btn_vote_no']) { ?> / <? } ?>
				<? if($vcfg['btn_vote_no']) { ?>반대 : <?=$bd_vote_no?><? } ?></td>
  </tr>
<? } ?>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>제목</strong></td>
		<td><?=$bd_subject?></td>
	</tr>
	<tr>
		<td align="center" bgcolor="#F0F0F4"><strong>내용</strong></td>
		<td style='word-break:break-all'>
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
		
		<?=$bd_content?></td>
	</tr>
<?
	if(is_array($bd_links) && (count($bd_links) > 0)) {
?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>링크</strong></td>
	  <td>
<?
		foreach($bd_links as $k => $v) {
			if($v['url']=='') continue;
			if($v['name']=='') $v['name']=$v['url'];
?>
<a href="<?=$v['link_url']?>" target="_blank"><?=$v['name']?>&nbsp;&nbsp;(<?=number_format($v['hits'])?>)</a><br>
<? 	} ?>
		</td>
  </tr>
<?
	}
?>
<?
	if($vcfg['use_download']) {
?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>첨부파일</strong></td>
		<td>
<?
		foreach($bd_files as $k => $v) {
			if($v['name']=='') continue;
?>
<a href="<?=$v['down_url']?>"><?=$v['name']?>&nbsp;&nbsp;Down:<?=number_format($v['hits'])?></a><br>
<? 	} ?>
		</td>
	</tr>
<?
	}
?>
<? if($vcfg['view_signature']) { ?>
	<tr>
    <td align="center" bgcolor="#F0F0F4"><strong>서명</strong></td>
		<td>
<?=$mb_signature?>
		</td>
	</tr>
<? } ?>
</table>

<?
	if($vcfg['view_comment']) // 코멘트 표시여부 
		if(file_exists($skin_path."view_comment.php")) include($skin_path."view_comment.php");
?>


<table width="100%" border="0">
	<tr>
		<td align="left">
<? if($prev_data) { ?>
		<input type="button" value="이전" onClick="location.href='<?=$url_view_prev?>'" class="button">
<? } ?>
<? if($next_data) { ?>
		<input type="button" value="다음" onClick="location.href='<?=$url_view_next?>'" class="button">
<? } ?>
<? if($vcfg['btn_modify']) { ?>	
		<input type="button" value="수정" onClick="location.href='<?=$url_modify?>'" class="button">
<? } ?>
<? if($vcfg['btn_del']) { ?>	
		<input type="button" value="삭제" onClick="location.href='<?=$url_delete?>'" class="button">
<? } ?>
<? if($vcfg['btn_reply']) { ?>	
		<input type="button" value="답변" onClick="location.href='<?=$url_reply?>'" class="button">
<? } ?>
<? if($vcfg['vote_yes']) { ?>	
		<input type="button" value="추천" onClick="location.href='<?=$url_vote_yes?>'" class="button">
<? } ?>
<? if($vcfg['vote_no']) { ?>	
		<input type="button" value="반대" onClick="location.href='<?=$url_vote_no?>'" class="button">
<? } ?>
		</td>
		<td align="right">
<? if($vcfg['btn_list']) { ?>
		<input type="button" value="목록보기" onClick="location.href='<?=$url_list?>'" class="button">
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
