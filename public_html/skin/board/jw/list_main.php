<?$bd_content=strip_tags($bd_content);
$bd_content = ereg_replace("&nbsp;","",$bd_content);

?>
<script>
	
function Save(url)
{
	alert(url);
	$.get(url,function(msg){
		alert(msg);
	});
}
	
</script>

<tr><td colspan="4" height="10" ></td></tr>
<TR bgColor='<?=($i%2==1)?"#F7F7F7":"#FFFFFF"?>' height="78">
  <td>
    <table width="%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td colspan="4" align="left" style="padding: 0 0 2px 0"><? if($_bbs_auth['cart']) { ?><input type=checkbox name="chk_nums[]" value="<?=$bd_num?>" class=none><? } ?> <?=$i_reply?> <?=$i_secret?> <a href="<?=$view_url?>"><span class="tt5"><strong><?=$bd_subject?></strong></span></a> <?=$i_comment_count?> <?=$i_new?></td>
      </tr>
	  <tr>
	    <td><?
	$bd_files=unserialize($bd_files); 
	if(is_array($bd_files) && (count($bd_files) > 0)) {
		$v=current($bd_files);
		foreach($bd_files as $k => $v) { 
			$v['view_url']= $_url['bbs']."down.php?bbs_code=".$_get_param[3]."&bd_num=".$bd_num."&key=".$k."&mode=view"; 
				
		
		}
			list($is_image)=explode('/',$v['type']);
			if($is_image=='image') {
			?>
			
			<a href="<?=$view_url?>"><img src="<?=$v['view_url']?>" onerror="javascript:LoadImg(this,'<?=$v['view_url']?>')" width="90" height="68" align="left" border="0"></a>
			<?
			}
		} 
?></td>
    <td>

    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr height="50" >
        <td align="left" valign="top" style="padding: 0 0 0 2px"><a href="<?=$view_url?>"><?=rg_cut_string($bd_content, 300, "...")?></a></td>
     </tr>
	 <tr>
        <td align="left" style="padding: 2px 0  0 2px"><a href="<?=$view_url?>"><span class="tt4"><span onclick="rg_bbs_layer('<?=$bbs_code?>','<?=$bd_num?>','<?=$bd_name?>','<?=$mb_id?>','<?=$open_homepage?>','<?=$open_email?>','<?=$open_profile?>','<?=$open_memo?>')" style="cursor:pointer"><?=$mb_icon?> <?=$bd_name?></span> | <?=$bd_write_date?> | <?=$bd_view_count?></span></a>
 
 </td>
 </tr>
 </table>
 
 
 </td>
	  </tr>
    </table>
  </td>
</tr>
		<tr><td colspan="4" height="10" ></td></tr>
		<tr><td colspan="4" height="1" bgcolor="#cccccc"></td></tr>
		<? ++$i; ?>
