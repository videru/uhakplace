<? if (!defined('RGBOARD_VERSION')) exit; ?>
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
<table border="1" cellpadding="3" cellspacing="0" width="100%" bordercolordark="white" bordercolorlight="#E1E1E1">
<? if($_bbs_auth['comment']) { // �ڸ�Ʈ ���⿩�� ?>
	<tr>
		<td>
			<table border="0" cellspacing="0" width="100%">
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
							<tr>
								<td>
									<textarea name="bc_content" cols="60" rows="5" style="width:100%" class="input"></textarea>
								</td>
								<td width="80">
									<input type="submit" value="����ϱ�" class="button" style="width:95%;height:70">
								</td>
							</tr>
						</table>
					</td>
				</tr>
<? if($vcfg['input_name']) { ?>
				<tr>
					<td>
						<table width="100%" style="table-layout:fixed" cellpadding="3" >
							<tr>
								<td>
						<? if($_mb[mb_level]>9) { ?>
		�ۼ��� <input name="bc_write_date1" type="text" value="<?=$bc_write_date1?>" class="input" size="4">��<input name="bc_write_date2" type="text" value="<?=$bc_write_date2?>" class="input" size="2">��<input name="bc_write_date3" type="text" value="<?=$bc_write_date3?>" class="input" size="2">��  
<? } ?>						
								�ۼ��� : <input type="text" name="bc_name" value="<?=$bc_name?>" class="input">
								</td>
								<td>
								��ȣ : <input type="password" name="bc_pass" class="input">
								</td>
							</tr>
						</table>
					</td>
				</tr>
<? } else { ?>
				<tr>
					<td>
						<table width="100%" style="table-layout:fixed" cellpadding="2" >
							<tr>
								<td>
								�ۼ��� : <?=$bc_name?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
<? } ?>
<? if($vcfg['spam_chk']) { ?>
	<tr>
		<td>���Թ��� : <?=$spam_chk_img?> ������ ���ڸ� �Է����ּ���.
		<input name="spam_chk" type="text" class="input" size="10">
		<input name="spam_chk_code" type="hidden" value="<?=$spam_chk_code?>"></td>
	</tr>
<? } ?>

				</form>
			</table>
		</td>
	</tr>
<? } ?>
<?
	include("clist_pre_process.php");
	while($data_comment=$rs_comment->fetch()) {
		include("clist_data_process.php");
?>
	<tr>
		<td>
			<table border="0" cellspacing="0" width="100%">
				<tr>
					<td>
						<table width="100%" cellpadding="3" >
							<tr>
								<td>
								�ۼ��� : <?=$bd_name_layer?>
								
								
<? if($comment_delete_chk) { ?>
								-  <a href="<?=$comment_delete_url?>">x</a>
<? } ?>
								</td>
								<td align="right">
								�ۼ��� : <?=$bc_write_date?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" cellpadding="3" >
							<tr>
								<td>
								<?=$bc_content?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
<? } ?>	
</table>