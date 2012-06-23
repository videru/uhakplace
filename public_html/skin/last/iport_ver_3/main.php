<?
		if($total < $notice){
		$total++;
?>
<div class="iport_ver_3_content iport_ver_3_font_content">
	<div class="iport_ver_3_div_content1">
		<img src="<?=$skin_url?>images/icon_2.gif"/>
		<a href="<?=$view_url?>"><?=$bd_subject?></a> <?=$i_comment_count?>
	</div>
	<div class="iport_ver_3_div_date1 iport_ver_3_font_content">
		<?=$bd_write_date?>
	</div>
	<div class="iport_ver_3_div_content2 iport_ver_3_font_content2">
		<?	
			$bd_content =  rg_cut_string(strip_tags($bd_content), $str, $more);
			$bd_content = str_replace("\n", " ", $bd_content); 
			$bd_content = str_replace("\r", " ", $bd_content); 
			echo $bd_content;
		?> 
	</div>		
</div>
<? }else{ ?>
<div class="iport_ver_3_content iport_ver_3_font_content">
	<div class="iport_ver_3_div_content3">
		<img src="<?=$skin_url?>images/icon_3.gif"/>
		<a href="<?=$view_url?>"><?=$bd_subject?></a> <?=$i_comment_count?>
	</div>
	<div class="iport_ver_3_div_date2 iport_ver_3_font_content">
		<?=$bd_write_date?>
	</div>
</div>
<? } ?>