<?php
include_once("_common.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4[charset]?>" />
<title>CHEditor</title>
<link rel="stylesheet" type="text/css" href="dialog.css" />
<script type="text/javascript">
//<![CDATA[
var oEditor = parent.chutil.oname;

function UpdateProtocol()
{
	var protocolSel = document.getElementById("fm_protocol");
  var selectedItem        = protocolSel.selectedIndex;
  var selectedItemValue   = protocolSel.options[selectedItem].value;
  var selectedItemText    = protocolSel.options[selectedItem].text;
  var inputtedText        = document.getElementById("fm_link_value").value;

  var protocol = inputtedText.split(":");

  if (protocol[1]) {
    var datum = protocol[1].replace(/^\/\//, "");
    datum = datum.replace(/\\/, "");
    datum = datum.replace(/^\//, "");
  }
  else {
    if(inputtedText.indexOf(":") > 0)
      var datum = "";
    else {
      var datum = protocol[0];
      datum = protocol[0].replace(/^\/\/\//, "//");
    }
  }

  document.getElementById("fm_link_value").value = selectedItemValue + datum;
  document.getElementById("fm_link_value").focus();
}

function returnSelected()
{
  var text;
  var target = '';
  var title = '';

  if (document.getElementById("fm_link_value").value != "") {
    text = document.getElementById("fm_link_value").value;
  }
  else {
    alert("링크 URL을 입력하여 주십시오.");
    return false;
  }

  if (document.getElementById("fm_target").value != "") {
    target = document.getElementById("fm_target").value;
  }

  if (document.getElementById("fm_title").value != "") {
    title = document.getElementById("fm_title").value;
  }

  eval("parent."+oEditor).hyperLink(text, target, title);
  popupClose();
}

function getSelected () {
	var editor = eval("parent."+oEditor);
	var rng = editor._getSelection();
	var selectionType = editor._getSelectionType(rng);
	var link = null;
	
	if (selectionType == "Text" || selectionType == "None") {
		link = rng.parentElement();
	}
	else if (selectionType == "Control") {
		link = rng.item(0).parentNode;
	}
	else {
		return;
	}

    if (link.nodeName != "A") return;
    
    var protocol = link.href.split(":");
    
    if (protocol[0]) {
    	var protocolSel = document.getElementById("fm_protocol");
    	
    	for (var i=0; i<protocolSel.length; i++) {   	
    		if (protocolSel[i].value.indexOf(protocol[0].toLowerCase()) != -1) {
    			var oldTarget = link.target;
  				var targetSel = document.getElementById("fm_target");
  				
    			if (oldTarget) {
    				for (var j=0; j < targetSel.length; j++) {
    					if (targetSel[j].value == oldTarget.toLowerCase()) {
    						targetSel[j].selected = true;
    						break;
    					}
    				}
    			}
    			else {
					targetSel[0].selected = true;
				}    				
    			
    			protocolSel[i].selected = true;
    			
    			if (link.title) {
    				document.getElementById("fm_title").value = link.title;
    			}
    			break;
    		}
    	} 	
    }
    
    document.getElementById("fm_link_value").value = link.href;
}

function popupClose() {
    eval('parent.'+oEditor).popupWinClose();
}
//]]>
</script>
</head>
<body onload="getSelected()">
<form name="set" id="fm_set" action="">
<input type="hidden" value="" name="SelTxt" />
<table cellpadding="0" cellspacing="0" border="0" width="100%">
  <tr>
    <td>
      <fieldset>
      <table border="0" cellspacing="4">
        <tr>
          <td align="right" width="40"><span class="normal">유형:</span>
          </td>
          <td>
            <select name="protocol" id="fm_protocol" onchange="UpdateProtocol()">
            <option value="http://" selected="selected" />http
            <option value="https://" />https
            <option value="mailto:" />mailto
            <option value="file://" />file
            <option value="ftp://" />ftp
            <option value="gopher://" />gopher
            <option value="news:" />news
            <option value="telnet:" />telnet
            <option value="wias:" />wias
            <option value="javascript:" />javascript
            </select>
          </td>
          <td align="right"><span class="normal">타겟:</span>
          </td>
          <td>
            <select name="target" id="fm_target">
              <option value="" />없음
              <option value="_self" />_self
              <option value="_blank" selected="selected" />_blank
              <option value="_parent" />_parent
              <option value="_top" />_top
            </select>
          </td>
        </tr>
        <tr>
          <td align="right"><span class="normal">URL:</span>
          </td>
          <td colspan="3">
            <input type="text" name="link_value" id="fm_link_value" value="http://" size="50" />
          </td>
        </tr>
        <tr>
          <td align="right"><span class="normal">타이틀:</span>
          </td>
          <td colspan="3">
            <input type="text" name="title" id="fm_title" value="" size="50" />
          </td>
        </tr>
      </table>
      </fieldset>
    </td>
  </tr>
</table>
</form>
<div class="spacer"></div>
<div align="center">
<button class="button" onclick="returnSelected()">확인</button>&#160;<button class="button" onclick="popupClose()">취소</button>
</div>
</body>
</html>
