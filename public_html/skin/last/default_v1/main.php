<? if (!defined('RGBOARD_VERSION')) exit; ?>
<?php /*?><?
	if(is_array($bd_files) && (count($bd_files) > 0)) {
		reset($bd_files);
		$v=current($bd_files);
		if($v['name']=='') continue;
		list($is_image)=explode('/',$v['type']);
		if($is_image!='image') continue;
?>
<img src="<?=$v['view_url']?>"><br><br>
<?
	}
?><?php */?>
<tr><td>
<a href="<?=$view_url?>"><?=$bd_subject?></a> <?=$i_comment_count?> <?=$i_new?> - [<?=$bd_write_date?>]<br />
</td></tr>