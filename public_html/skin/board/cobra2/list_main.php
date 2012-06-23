	<tr height="32" <?if($bd_notice > 0) {?>bgcolor="#f4f4f4"<?}?>>
       <td >&nbsp;</td>
<? if($_bbs_auth['cart']) { ?>
		<td align="center"><input type=checkbox name="chk_nums[]" value="<?=$bd_num?>" class=none></td>
<? } ?>
		<td align="center"><?=$i_no?></td>
		<td>&nbsp;</td>
		<td><?=$i_reply?> <?=$i_secret?> <a href="<?=$view_url?>"><?if($bd_ext4==1){?><strong><?}?><?if($bd_ext5==1){?><font color="#2591cf"><?}elseif($bd_ext5==2){?><font color="#ff0000"><?}?><?=$bd_subject?><?if($bd_ext4==1){?></strong><?}?><?if($bd_ext5==1){?></font><?}?></a> <?=$i_comment_count?> <?=$i_new?></td>
		<td>&nbsp;</td>
		<td align="center"><?=$bd_name?></td>
		<td>&nbsp;</td>
		<td align="center"><?=$bd_write_date?></td>
		<td>&nbsp;</td>
		<td align="center"><?=$bd_view_count?></td>
       <td >&nbsp;</td>
		</tr>
		    <tr>
		<td colspan="12" height="1" <?if($bd_notice > 0) {?>bgcolor="#ffffff"<?}else{?>bgcolor="#eaecef"<?}?>></td>
    </tr>