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
		<input type="button" value="찬성" onClick="location.href='<?=$url_vote_yes?>'" class="button">
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
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="default_bbs_content">
	<tr>
		<th width="120">작성자</th>
		<td><?=$bd_name_layer?></td>
	</tr>
	<tr>
		<th>작성일</th>
		<td><?=rg_date($data['bd_write_date'],$vcfg['date_format'])?></td>
	</tr>
<? if($bd_home) { ?>
	<tr>
    <th>홈페이지</th>
	  <td><?=$bd_home?></td>
  </tr>
<? } ?>
<? if($vcfg['use_category']) { ?>
	<tr>
    <th>분류</th>
	  <td><?=$_category_name_array[$cat_num]?></td>
  </tr>
<? } ?>
<? if($vcfg['btn_vote_yes'] || $vcfg['btn_vote_no']) { ?>
	<tr>
    <th>&nbsp;</th>
	  <td><? if($vcfg['btn_vote_yes']) { ?>찬성 : <?=$bd_vote_yes?><? } ?>
				<? if($vcfg['btn_vote_yes'] && $vcfg['btn_vote_no']) { ?> / <? } ?>
				<? if($vcfg['btn_vote_no']) { ?>반대 : <?=$bd_vote_no?><? } ?></td>
  </tr>
<? } ?>
	<tr>
		<th>제목</th>
		<td><?=$bd_subject?></td>
	</tr>
	<tr>
		<th>내용</th>
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
			if($v['name']=='') continue;
			list($is_image)=explode('/',$v['type']);
			if($is_image!='image') continue;
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
    <th>링크</th>
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
    <th>첨부파일</th>
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
    <th>서명</th>
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
		<input type="button" value="찬성" onClick="location.href='<?=$url_vote_yes?>'" class="button">
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
