<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />

<style>
#gall a img{ border: 2px solid #e4e4e4; }
#gall a:hover img{ border: 2px solid #4B9FBE;	}
</style>
 <!-- ????? ???? -->
<form name="list_form" method="post" enctype="multipart/form-data" action="?">
<?=$_post_param[3]?>
<input name="mode" type="hidden" value="">
<table border="0" cellpadding="0" cellspacing="0" width="692" bordercolordark="white" bordercolorlight="#E1E1E1" onmouseover="list_over_color(event,'#FFFFDD',1)" onmouseout='list_out_color(event)'>
	<tr align="center" bgcolor="#E8ECF1" height="30">
<? 
$colspan=6; //?? ??
?>

		<tr><td colspan="<?=$colspan?>" height="2" bgcolor="#ffb59c"></td></tr>

<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"50\">
		<td align=\"center\" colspan=\"".$colspan."\"><B>???(???) ?? ??? ??4??.</td>
	</tr>";
	}

	$no = $page_info['start_no'];
	if(isset($bd_num)) $o_bd_num=$bd_num;
	while($data=$rs_list->fetch()) {
		$i_no=--$no;
		include("list_data_process_new.php");
		
		if($bd_delete > 0) include($_skin_list_delete); // ??f??	
		else if($bd_secret > 0) include($_skin_list_secret); // ??б?
		else if($bd_notice > 0) include($_skin_list_notice); // ???????		
		else if($o_bd_num==$bd_num) include($_skin_list_current); // ?????
		else include($_skin_list_main);
	}
?>


		<tr><td colspan="<?=$colspan?>" height="2" bgcolor="#ffb59c"></td></tr>
</table>
</form>

 <!-- ??? ?? -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td height="16"></td>
	</tr>				
				<tr>
					<td align="right" >
<? if($_bbs_auth['write']) { ?>
					<img src="<?=$skin_url?>images/write.gif" onclick="location.href='write_new.php?<?=$_get_param[3]?>'" style="cursor:pointer" align="absmiddle">
<? } ?>
<? if($_bbs_auth['admin']) { ?>
<script>
function board_manager(){
	if(!chk_checkbox(list_form,'chk_nums[]',true)){
		alert('?????? ???? ?????.');
		return;
	}
	window_open('', "board_manager", 'scrollbars=no,width=355,height=200');
	document.list_form.action = '<?=$_url['bbs']?>board_manager.php';
	document.list_form.target='board_manager';
	document.list_form.submit();
}
</script>
					<img src="<?=$skin_url?>images/bbs_admin.gif" onclick="board_manager();" style="cursor:pointer" align="absmiddle">
<? } ?>
					</td>
                </tr>
	<tr>
		<td align="center" style="padding-top:12px;">
<?=rg_navi_display($page_info,$_get_param[2]); ?>
		</td>
	</tr>
	<tr>
		<td height="16"></td>
	</tr>
	<tr>
		<td align="center" >
			<table width="100%" border="0" cellpadding="0" cellspacing="0" >
                <tr>
					<td>
						<table width="650" cellspacing="0" border="0" cellpadding="0" align="center">
						<form name="search_form" action="?" method="get" enctype="multipart/form-data" onsubmit="return validate(this)">
						<?=$_post_param[0]?>
							<tr align="center"> 
								
								<td width="565" background="<?=$skin_url?>images/searchbg.gif">&nbsp;
									<input type="checkbox" name="ss[sn]" value="1" <?=$checked_sn?>>이름&nbsp;
									<input type="checkbox" name="ss[st]" value="1" <?=$checked_st?>>제목&nbsp;
									<input type="checkbox" name="ss[sc]" value="1" <?=$checked_sc?>>내용&nbsp;&nbsp;
									<input name="kw" type="text" id="kw" value="<?=$kw?>" size="14" hname="" style="border:0px;width:200px;height:18px;background-image:url('<?=$skin_url?>images/search_form.gif');" required>
									<input type="image" src="<?=$skin_url?>images/s_search.gif" align="absmiddle">
								</td>
								
						  </tr>
						  </form>
		        </table>
				  </td>
				</tr>
			</table>
		</td>
	</tr>
</table>


