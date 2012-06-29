<? if (!defined('RGBOARD_VERSION')) exit; ?>
	<tr height="25">
<? if($_bbs_auth['cart']) { ?>
		<td align="center"><input type=checkbox name="chk_nums[]" value="<?=$bd_num?>" class=none></td>
<? } ?>
		<td align="center"><?=$i_no?></td>
<? if($_bbs_info['use_category']) { ?>
		<td align="center"><?=$cat_name?><br></td>
<? } ?>
		<td><?=$i_reply?> <?=$i_secret?> <a href="<?=$view_url?>"><?=$bd_subject?></a> <?=$i_comment_count?> <?=$i_new?></td>
		<td align="center"><?=$bd_name_layer?></td>
		<td align="center"><?=$bd_write_date?></td>
		<td align="center"><?=$bd_view_count?></td>
		<td align="center"><?=$bd_vote_yes?> / <?=$bd_vote_no?></td>
		</tr>