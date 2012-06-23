<? 
if(!function_exists('anicon_html')) { 
include "../anicon/anicon.php"; 
}  
$ani_con = anicon_html($bd_ext2,$site_url); 
echo $ani_con; 
?>
<script type="text/javascript">

var iframeids=["myframe"] // iframe 에 사용할 ID 를 지정 해 주세요

var iframehide="yes"

function resizeCaller() {
var dyniframe=new Array()
for (i=0; i<iframeids.length; i++){
if (document.getElementById)
resizeIframe(iframeids[i])
if ((document.all || document.getElementById) && iframehide=="no"){
var tempobj=document.all? document.all[iframeids[i]] : document.getElementById(iframeids[i])
tempobj.style.display="block"
}
}
}

function resizeIframe(frameid){
var currentfr=document.getElementById(frameid)
if (currentfr && !window.opera){
currentfr.style.display="block"
if (currentfr.contentDocument && currentfr.contentDocument.body.offsetHeight) //ns6 syntax
currentfr.height = currentfr.contentDocument.body.offsetHeight; 
else if (currentfr.Document && currentfr.Document.body.scrollHeight) //ie5+ syntax
currentfr.height = currentfr.Document.body.scrollHeight;
if (currentfr.addEventListener)
currentfr.addEventListener("load", readjustIframe, false)
else if (currentfr.attachEvent)
currentfr.attachEvent("onload", readjustIframe)
}
}

function readjustIframe(loadevt) {
var crossevt=(window.event)? event : loadevt
var iframeroot=(crossevt.currentTarget)? crossevt.currentTarget : crossevt.srcElement
if (iframeroot)
resizeIframe(iframeroot.id);
}

function loadintoIframe(iframeid, url){
if (document.getElementById)
document.getElementById(iframeid).src=url
}

if (window.addEventListener)
window.addEventListener("load", resizeCaller, false)
else if (window.attachEvent)
window.attachEvent("onload", resizeCaller)
else
window.onload=resizeCaller

</script>
<?
/* =====================================================

===================================================== */
$bd_content = ereg_replace("<P>"," ",$bd_content);
$bd_content = ereg_replace("</P>","<br>",$bd_content);
?>
<? if(isset($_REQUEST['skin_path'])) exit; ?>

<table border="0" cellpadding="0" cellspacing="0" width="692">
    <tr>
		<td colspan="7" height="1" bgcolor="#3694D4"></td>
    </tr>	
	<tr height="32">
		<td colspan="4" background="<?=$skin_url?>images/view_subject_bg.gif" style="padding:5px 0 0 17px"><font color="#329ce0"><strong><?=$bd_subject?></strong></font></td>
	</tr>	
	<tr height="30">
		<td width="64" align="right" bgcolor="#F0F0F4"  background="<?=$skin_url?>images/view_subject_bg2.gif"><img src="<?=$skin_url?>images/view_date.gif"></td>
		<td width="140" background="<?=$skin_url?>images/view_subject_bg2.gif"><?=$bd_write_date?></td>
		<td width="42" bgcolor="#F0F0F4" background="<?=$skin_url?>images/view_subject_bg2.gif"><img src="<?=$skin_url?>images/view_view.gif"></td>
		<td width="463" background="<?=$skin_url?>images/view_subject_bg2.gif"><?=$bd_view_count?></td>
	</tr>
<?
	if($vcfg['use_download']) {
?>

	
	<tr height="25">
    <td align="center" bgcolor="#F0F0F4"><strong>첨부파일</strong></td>
    <td colspan="2" >&nbsp;
<?
		foreach($bd_files as $k => $v) {
			if($v['name']=='') continue;
?>
<a href="<?=$v['down_url']?>"><?=$v['name']?>&nbsp;&nbsp;Down:<?=number_format($v['hits'])?></a><br>
<? 	} ?>
		</td>
	</tr>
    <tr>
		<td colspan="7" height="1" bgcolor="#3694D4"></td>
    </tr>
<?
	}
?>
<? if($bd_home) { ?>
	<tr >
    <td align="center" bgcolor="#F0F0F4"><strong>홈페이지</strong></td>
	  <td>&nbsp;<?=$bd_home?></td>
  </tr>
    <tr>
		<td colspan="7" height="1" bgcolor="#3694D4"></td>
    </tr>
<? } ?>
    <tr>
		<td colspan="7" height="12"></td>
    </tr>	
	<tr>
		<td colspan="7" style='word-break:break-all' style="padding:0 0 0 10px">
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
<img src="<?=$v['view_url']?>" onload="if ( this.width > 720) { this.width = 720; }" onclick="view_image_popup(this)" style="cursor:hand;" id="view_image"><br><br>
<? 	}
	}
?>		
		<?=$bd_content?>
		
	<br><br>
<img src="../img/psk_bt.jpg">	
		</td>
	</tr>

    <tr>
		<td colspan="7" height="16"></td>
    </tr>	
    <tr>
		<td colspan="7" height="1" bgcolor="#DFDFDF"></td>
    </tr>
</table>

<?
	if($vcfg['view_comment']) // 코멘트 표시여부 
		if(file_exists($skin_path."view_comment.php")) include($skin_path."view_comment.php");
?>

<table width="692" border="0" >
  <tr>
	<td colspan="2" height="16"></td>
  </tr>		
<tr>
		<td align="left" width="50%" >
<? if($vcfg['btn_modify']) { ?>	
<img src="<?=$skin_url?>images/modify.gif" onClick="location.href='<?=$url_modify?>'" style="cursor:pointer" align="absmiddle">
<? } ?>
<? if($vcfg['btn_del']) { ?>	
<img src="<?=$skin_url?>images/delete.gif" onClick="location.href='<?=$url_delete?>'" style="cursor:pointer" align="absmiddle">
<? } ?>
<? if($vcfg['btn_reply']) { ?>	
<img src="<?=$skin_url?>images/reply.gif" onClick="location.href='<?=$url_reply?>'" style="cursor:pointer" align="absmiddle">
<? } ?>
		</td>
		<td align="right"  width="50%" >
<? if($vcfg['btn_list']) { ?>
		<img src="<?=$skin_url?>images/list.gif" onClick="location.href='<?=$url_list?>'" style="cursor:pointer" align="absmiddle">
<? } ?>
		</td>
	</tr>
		</td>
	</tr>
	<tr>
		<td colspan="2" height="10"></td>
    </tr>
	<tr>
		<td colspan="2"><img src="<?=$skin_url?>images/pn_list_top.gif"></td>
    </tr>
<? if($prev_data) { ?>    
	<tr>
		<td colspan="2" style="padding: 0 0 0 10px"><img src="<?=$skin_url?>images/prev.gif" onClick="location.href='<?=$url_view_prev?>'" style="cursor:pointer" align="absmiddle"><img src="<?=$skin_url?>images/pn_list_line.gif" align="absmiddle"><a href="<?=$url_view_prev?>"><?=$prev_data['bd_subject']?></a></td>
    </tr>
	<tr>
		<td colspan="2" ><img src="<?=$skin_url?>images/pn_list_line2.gif"></td>
    </tr>
<? } ?>
 <? if($next_data) { ?>   
	<tr>
		<td colspan="2" style="padding: 0 0 0 10px"><img src="<?=$skin_url?>images/next.gif" onClick="location.href='<?=$url_view_next?>'" style="cursor:pointer" align="absmiddle"><img src="<?=$skin_url?>images/pn_list_line.gif" align="absmiddle"><a href="<?=$url_view_next?>"><?=$next_data['bd_subject']?></a></td>
    </tr>	
<? } ?>	
	<tr>
		<td colspan="2"><img src="<?=$skin_url?>images/pn_list_bottom.gif"></td>
    </tr>
</table>
<? if($vcfg['view_list']) { ?>
<br>
<table width="692" border="0" >
	<tr>
		<td>
<? include('list_main_process.php'); ?>
		</td>
	</tr>
</table>
<? } ?>
