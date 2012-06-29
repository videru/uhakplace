<?

if($bc_write_date){
$bc_write_date1 = date(Y, $bc_write_date);
$bc_write_date2 = date(m, $bc_write_date);
$bc_write_date3 = date(d, $bc_write_date);
}else{
$bc_write_date1 = date(Y);
$bc_write_date2 = date(m);
$bc_write_date3 = date(d);
}
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<?
	include("clist_pre_process.php");
	while($data_comment=$rs_comment->fetch()) {
	include("clist_data_process.php");
?>

	<tr>
		<td bgcolor="#CCCCCC" height="1"></td></tr><tr><td style="padding:5px 0px 5px 5px;">
			<table border="0" cellspacing="0" cellpadding="5" width="100%">
				<tr>
					<td width="120">
								<span onclick="rg_bbs_layer('<?=$bbs_code?>','<?=$bd_num?>','<?=$bc_name?>','<?=$mb_id?>','<?=$open_homepage?>','<?=$open_email?>','<?=$open_profile?>','<?=$open_memo?>')" style="cursor:pointer"><?=$mb_icon?> <?=$bc_name?></span>					
								<br />
								<?=$bc_write_date?>
					</td>
					<td valign="top" bgcolor="#EFFAF9" style="border:1px solid #E7E7E7;">
								<?=$bc_content?><? if($comment_delete_chk) { ?>
								<img src="<?=$skin_url?>images/c_del.gif" onClick="location.href='<?=$comment_delete_url?>'" style="cursor:pointer" align="absmiddle" alt=" 코멘트 삭제 ">
								<? } ?>
					</td>
				</tr>		
			</table>
		</td>
	</tr>
<? } ?>	

	<tr>
	  <td style="padding:10px 0px 10px 0;" align="center"><?=rg_navi_display($page_info,"&bbs_code={$bbs_code}&bd_num={$bd_num}"); ?></td>
	</tr>
	<tr>
		<td bgcolor="#CCCCCC" height="1"></td>
	</tr>
<? if($_bbs_auth['comment']) { // 코멘트 쓰기여부 ?>
	<tr>
		<td>
			<table border="0" cellspacing="0" cellpadding="5" width="100%" style="border-top:1px solid #CCCCCC; border-bottom:1px solid #CCCCCC;" bgcolor="#f7f7f7">
				<form name="comment_form" action="?" method="post" onSubmit="return validate(this)">
				<?=$_post_param[3]?>
				<input type="hidden" name="mode" value="comment_write">
				<input type="hidden" name="bd_num" value="<?=$bd_num?>">				
				
<input type="hidden" name="bc_write_date1" value="<?=$bc_write_date1?>">
<input type="hidden" name="bc_write_date2" value="<?=$bc_write_date2?>">
<input type="hidden" name="bc_write_date3" value="<?=$bc_write_date3?>">				
				<tr>
					<td>
						<table width="100%" cellpadding="3" >
							<tr height="50px">
								<td width="15px" align="center">
									<SCRIPT LANGUAGE="JavaScript"> 
										<!-- //textarea 세로크기 조절
										function formresize(mode) {
											if (mode == "up") {
											  document.comment_form.bc_content.rows = document.comment_form.bc_content.rows + 3;
											   } else if (mode == "down") {
									        if (3 < document.comment_form.bc_content.rows) {
											 document.comment_form.bc_content.rows = document.comment_form.bc_content.rows - 3;
												  }
											  }
											document.comment_form.bc_content.focus();
											}
										//--> 
									</SCRIPT>
								<a style="cursor:pointer" title="입력창 세로길이 줄이기" onclick="formresize('down')">△</a><br>
								<a style="cursor:pointer" title="입력창 세로길이 늘리기" onclick="formresize('up')">▽</a>
								</td>
								<td>
									<textarea name="bc_content" cols="60" rows="3" style="width:100%" class="input"></textarea>
								</td>
								<td width="70" valign="top">
									<input type="image" src="<?=$skin_url?>images/comment_ok.gif" align="absmiddle"> 
								</td>
							</tr>
						</table>
					</td>
				</tr>

<? if($vcfg['input_name'] || $vcfg['spam_chk']) { ?>
				<tr>
					<td style="padding-left:30px;">
			<? if($_mb[mb_level]>9) { ?>
		작성일 <input name="bc_write_date1" type="text" value="<?=$bc_write_date1?>" class="input" size="4">년<input name="bc_write_date2" type="text" value="<?=$bc_write_date2?>" class="input" size="2">월<input name="bc_write_date3" type="text" value="<?=$bc_write_date3?>" class="input" size="2">일  
<? } ?>				
							<? if($vcfg['input_name']) {?>
							작성자  <input type="text" name="bc_name" value="" class="input">&nbsp;&nbsp;
							암호  <input type="password" name="bc_pass" class="input">&nbsp;&nbsp;
							<?}?>
							<? if($vcfg['spam_chk']) { ?>
							스팸방지  
							<input name="spam_chk" type="text" class="input" size="10">
							<input name="spam_chk_code" type="hidden" value="<?=$spam_chk_code?>"> <?=$spam_chk_img?>
							<?}?>
					</td>
				</tr>
<? } ?>
				</form>
			</table>
		</td>
	</tr>
<? } ?>
</table>