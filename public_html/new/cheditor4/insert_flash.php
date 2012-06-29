<?php
include_once("_common.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4[charset]?>" />
<title>플래쉬 무비</title>
<link rel="stylesheet" type="text/css" href="dialog.css" />
<script type="text/javascript">
//<![CDATA[
var oEditor = parent.chutil.oname;
function DoReset(el)
{
    document.getElementById(el).value = '';
    document.getElementById(el).focus();
}

function DoPaste(el)
{
    document.getElementById(el).focus();
    document.getElementById(el).value = '';
    var pasteText = document.getElementById(el).createTextRange();
    pasteText.execCommand("Paste", false, false);
}

function DoSubmit(el)
{
    var media = (el == 'embed') ? document.getElementById("fm_embed").value :
        "<embed src='"+document.getElementById("fm_linkurl").value+"'></embed>";
    eval("parent."+oEditor).doCmdPaste(media);
    popupClose();
}

function popupClose() {
    eval('parent.'+oEditor).popupWinClose();
}
//]]>
</script>
</head>
<body>
<form action="" style="display:inline">
<span class="normal">- 편집 화면에서 동영상을 보시려면 동영상을 더블 클릭하십시오.<br />
- 퍼오기 한 내용은 키보드 'Ctrl+V' 또는 '붙이기 버튼'을 클릭하십시오.
</span>
<fieldset style="margin-top:10px;padding:5px"><legend><span class="normal">HTML 태그 - &lt;EMBED&gt; 또는 &lt;OBJECT&gt;</span></legend>
<textarea name="embed" id="fm_embed" style="height:45px;width:460px;" /></textarea><br />
<div style="text-align:center"><button onclick="DoSubmit('embed')" class="button">확인</button>&#160;
<button onclick="DoPaste('fm_embed')" class="button">붙이기</button>&#160;
<button onclick="DoReset('fm_embed')" class="button">다시입력</button></div>
</fieldset>
<fieldset style="margin-top:5px;padding:5px"><legend><span class="normal">동영상 링크 주소 - HTTP</span></legend>
<textarea name="linkurl" id="fm_linkurl" style="height:45px;width:460px;" /></textarea>
<div style="text-align:center"><button onclick="DoSubmit('url')" class="button">확인</button>&#160;
<button onclick="DoPaste('fm_linkurl')" class="button">붙이기</button>&#160;
<button onclick="DoReset('fm_linkurl')" class="button">다시입력</button></div>
</fieldset>
<div class="spacer"></div>
<div style="text-align:center">
<button onclick="popupClose()" class="button">취소</button>
</div>
</form>
</body>
</html>
