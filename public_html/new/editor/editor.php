<script language='javascript' src='<?=$editor_Url?>/languages/<?=$lang?>/java.lang.js'></script>
<script language="javascript">
<!--
var _editor_url = "<?=$editor_Url?>";
var _contentValue = "<?=$contentForm?>";
var _contentName = "<?=$formName?>";
var _i_uploaded = "<?=$upload_image?>";
var _m_uploaded = "<?=$upload_media?>";

function editor_wr_ok(){
	document.<?=$formName?>.<?=$contentForm?>.value = SubmitHTML();
	//document.<?=$formName?>.submit();
}
//-->
</script>
<table align="center" border="0" cellpadding="1" cellspacing="3" width="100%">
	<tr>
		<td bgcolor="#EFEFEF">
		<script language="javascript">
		<!--
		document.write('<table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td height="2"></td></tr><tr><td><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td height="28"><img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/edit_4.gif" border="0" align="absmiddle" ONCLICK="newDoc()" TITLE="' + editor_lang[0] + '"> <img style="cursor:hand;" src="' + _editor_url + '/img/edit_1.gif" border="0" align="absmiddle" ONCLICK="htmltrue(\'cut\')" TITLE="' + editor_lang[1] + '"> <img style="cursor:hand;" src="' + _editor_url + '/img/edit_2.gif" border="0" align="absmiddle" ONCLICK="htmltrue(\'copy\')" TITLE="' + editor_lang[2] + '"> <img style="cursor:hand;" src="' + _editor_url + '/img/edit_3.gif" border="0" align="absmiddle" ONCLICK="htmltrue(\'paste\')" TITLE="' + editor_lang[3] + '"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/edit_5.gif" border="0" align="absmiddle" ONCLICK="htmltrue(\'outdent\')" TITLE="' + editor_lang[4] + '"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/edit_6.gif" border="0" align="absmiddle" ONCLICK="htmltrue(\'indent\')" TITLE="' + editor_lang[5] + '"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/edit_7.gif" border="0" align="absmiddle" NCLICK="htmltrue(\'superscript\')" TITLE="' + editor_lang[6] + '"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/edit_8.gif" border="0" align="absmiddle" ONCLICK="htmltrue(\'subscript\')" TITLE="' + editor_lang[7] + '"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/edit_9.gif" border="0" align="absmiddle" ONCLICK="htmltrue(\'undo\')" TITLE="' + editor_lang[8] + '"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/edit_10.gif" border="0" align="absmiddle" ONCLICK="htmltrue(\'redo\')" TITLE="' + editor_lang[9] + '"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_5.gif" border="0" TITLE="' + editor_lang[10] + '" ONCLICK="htmltrue(\'justifyleft\')" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_6.gif" border="0" TITLE="' + editor_lang[11] + '" ONCLICK="htmltrue(\'justifycenter\')" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_7.gif" border="0" TITLE="' + editor_lang[12] + '" ONCLICK="htmltrue(\'justifyright\')" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_10.gif" border="0" TITLE="' + editor_lang[13] + '" ONCLICK="htmltrue(\'insertorderedlist\')" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_11.gif" border="0" TITLE="' + editor_lang[14] + '" ONCLICK="htmltrue(\'insertunorderedlist\')" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_18.gif" align="absmiddle" border="0" oNCLICK="htmltrue(\'inserthorizontalrule\');" title="' + editor_lang[15] + '"></td></tr><tr><td height="28"><img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/edit_11.gif" border="0" TITLE="' + editor_lang[16] + '" ONCLICK="createHTML(\'fontname\',4);" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/edit_12.gif" border="0" TITLE="' + editor_lang[17] + '" ONCLICK="createHTML(\'fontsize\',7);" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_1.gif" name="item_1" border="0" TITLE="' + editor_lang[18] + '" ONCLICK="htmltrue(\'bold\');" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_2.gif" border="0" TITLE="' + editor_lang[19] + '" ONCLICK="htmltrue(\'italic\')" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_3.gif" border="0" TITLE="' + editor_lang[20] + '" ONCLICK="htmltrue(\'strikethrough\')" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_4.gif" border="0" TITLE="' + editor_lang[21] + '" ONCLICK="htmltrue(\'underline\')" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_8.gif" border="0" TITLE="' + editor_lang[22] + '" onclick="createHTML(\'forecolor\',5);" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_9.gif" border="0" TITLE="' + editor_lang[23] + '" onclick="createHTML(\'hilitecolor\',6);" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_12.gif" border="0" TITLE="' + editor_lang[24] + '" ONCLICK="createHTML(\'CreateLink\',8);" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_16.gif" border="0" onclick="createHTML(\'\',1);" align=absmiddle title="' + editor_lang[25] + '"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_19.gif" align="absmiddle" border="0" title="' + editor_lang[26] + '" onclick="createHTML(\'\',2);"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_20.gif" align="absmiddle" border="0" title="' + editor_lang[27] + '" onclick="createHTML(\'InsertImage\',3);" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_13.gif" border="0" TITLE="' + editor_lang[28] + '" onclick="createHTML(\'' + _i_uploaded + '\',9);" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_14.gif" border="0" TITLE="' + editor_lang[29] + '" onclick="createHTML(\'' + _m_uploaded + '\',10);" align="absmiddle"> <img style="cursor:hand;" src="' + _editor_url + '/img/item_22.gif" border="0" align="absmiddle" TITLE="' + editor_lang[78] + '" onclick="zoom_click();"><span id="zoomin" style="position:absolute;z-index:1"></span> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_17.gif" border="0" TITLE="' + editor_lang[30] + '" onclick="createHTML(\'\',11);" align="absmiddle"> <img style="cursor:hand;cursor:pointer;" src="' + _editor_url + '/img/item_21.gif" border="0" TITLE="' + editor_lang[31] + '" onclick="createHTML(\'\',12);" align="absmiddle"></td></tr><tr><td height="2"></td></tr></table></td></tr></table>');
		//-->
		</script>
		</td>
	</tr>
	<tr>
		<td>
		<TABLE BORDER="1" WIDTH=100% cellspacing="0" bordercolor="#EFEFEF" bordercolordark="white" bordercolorlight="#DBDBDB">
			<TR>
				<TD>
				<iframe id="gmEditor" WIDTH="<?=$textWidth?>" HEIGHT="<?=$textHeight?>" scrolling="auto" border=1 frameborder=0 framespacing=0 hspace=0 marginheight=0 marginwidth=0 vspace=0></iframe>
				<textarea cols=0 rows=0 style="display:none;" wrap='physical' name="<?=$contentForm?>"><?=$content?></textarea>
				<input type="hidden" name="editor_url" id="editor_url" value="<?=$editor_Url?>">
				<input type="hidden" name="editor_stom" id="editor_stom" value="<?=$lang?>">
				<script language="javascript" src='<?=$editor_Url?>/gmEditor.js'></script>
				</TD>
			</TR>
		</TABLE>
		</td>
	</tr>
</table>
