<?php
include_once("_common.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>그림 넣기</title>
<meta http-equiv="content-type" content="text/html; charset=<?=$g4[charset]?>" />
<link rel="stylesheet" type="text/css" href="dialog.css" />
<script type="text/javascript" src="AC_OETags.js"></script>
<script type="text/javascript">
//<![CDATA[
var AppWidth = "250";
var AppHeight = "175";
var AppID = "cheditorPreview";

// ----------------------------------------------------------------------------------
// 관련 함수


function CHEditorImagePreview () {
// ----------------------------------------------------------------------------------
// callBack function

  document.getElementById(AppID).CHEditorImagePreview("1", "1");
}


function CHXUploadRUN() {
// ----------------------------------------------------------------------------------
// Preview 출력
//
  chxupload_RUN("src", "ImagePreview",
          "width", AppWidth,
          "height", AppHeight,
          "align", "middle",
          "id", AppID,
          "classid", AppID,
          "quality", "high",
          "bgcolor", "#ebe9ed",
          "name", AppID,
          "allowScriptAccess","sameDomain",
          "type", "application/x-shockwave-flash",
          "pluginspage", "http://www.adobe.com/go/getflashplayer");
}

var imageArray = new Array();

function insertImageList(filename, filepath)
{
  var oSel = document.getElementById('fm_insert_image');
  var opt = new Option(filename, filepath, true);
  var idx = oSel.length;
  imageArray[idx] = new Object();
  imageArray[idx]["fileorig"] = filename;
  imageArray[idx]["filepath"] = filepath;
  imageArray[idx]["filename"] = getFilename(filepath);
  oSel.options[idx] = opt;
}

function popupClose()
{
  var el = document.getElementById('fm_insert_image');
  if (el.length > 0) {
    for (var i=0; i<el.length; i++)
      el.options[i].selected = true;

    deleteImage();
  }

  if (navigator.userAgent.toLowerCase().indexOf("msie")  != -1)
    document.getElementById(AppID).style.display = 'none';
  parent.window.popupClose();
}

function doSubmit ()
{
  if (navigator.userAgent.toLowerCase().indexOf("msie")  != -1)
    document.getElementById(AppID).style.display = 'none';
  parent.window.insertImage(imageArray);
}

function chkImgFormat (el)
{
    var file = getFilename(el.value);
    var allowSubmit = false;
    var extArray = new Array(".gif", ".jpg", ".jpeg", ".png");

    extArray.join(" ");
    if (!file) return false;

    var ext = file.slice(file.lastIndexOf(".")).toLowerCase();

    for (var i = 0; i < extArray.length; i++) {
        if (extArray[i] == ext) {
            allowSubmit = true;
            break;
        }
    }

    if (allowSubmit) {
      var fileName = el.value;

      while (fileName.indexOf("\\") != -1) {
        fileName = fileName.slice(fileName.indexOf("\\") + 1);
      }
      fileName = getFilename(fileName);

      var el = document.getElementById("fm_insert_image");
        for (var i=0; i<el.length; i++) {
            if (fileName == el.options[i].text) {
              alert("선택하신 그림은 목록에 이미 추가되어 있습니다.");
              allowSubmit = false;
              break;
            }
        }
      if (allowSubmit) {
        document.getElementById("submit_btn").disabled = false;
        document.insertImage.submit();
      }
    }
    else {
        document.getElementById("submit_btn").disabled = true;
        alert("그림 삽입은 GIF, JPG, PNG 파일만 가능합니다. 다시 선택하여 주십시요.");
        return false;
    }
}

function previewImage (source) {
  if (navigator.appName.indexOf("microsoft") != -1)
    window[AppID].CHEditorImagePreview(source, 0, 0);
  else
    document[AppID].CHEditorImagePreview(source, 0, 0);
}

function checkImageComplete (img) {
  if (img.complete != true) {
      setTimeout("checkImageComplete(document.getElementById('"+img.id+"'))", 250);
  }
  else {
    var txt = document.createTextNode(img.width + ' X ' + img.height);
    document.getElementById('imageSize').innerHTML = '';
    document.getElementById('imageSize').appendChild(txt);
    for (var i=0; i < imageArray.length; i++) {
      if (imageArray[i]['filename'] == img.id) {
        imageArray[i]['width'] = img.width;
        imageArray[i]['height'] = img.height;
      }
    }
  }
}

function attachSuccess (filepath) {
  var file = getFilename(filepath);
  var fileName = document.getElementById('AttachFile').value;
  while (fileName.indexOf("\\") != -1) {
    fileName = fileName.slice(fileName.indexOf("\\") + 1);
  }
  fileName = getFilename(fileName);

  document.insertImage.attachImage.value = filepath;

  var img = new Image();
  img.src = filepath;
  img.id = getFilename(filepath);

  insertImageList(fileName, filepath);

  document.getElementById('tmpImage').appendChild(img);
  checkImageComplete(img);

  document.getElementById('delete_btn').disabled = false;
  previewImage(img.src);
}

function outputImageSize (w, h) {
  var txt = document.createTextNode(w + ' X ' + h);
  document.getElementById('imageSize').innerHTML = '';
  document.getElementById('imageSize').appendChild(txt);
}

function showImageSize (w, h) {
    outputImageSize(w, h);
}

function selectedPreview (el) {
  if (el.length < 1) return false;
  for (i=0; i<el.length; i++) {
    if (el.options[i].selected == true) {
      document.insertImage.attachImage.value = el.options[i].value;
      document.getElementById('delete_btn').disabled = false;
      showImageSize(imageArray[i]['width'], imageArray[i]['height']);
      previewImage(el.options[i].value);
      break;
    }
  }
  return false;
}

function getFilename (file) {
  while (file.indexOf("/") != -1)
    file = file.slice(file.indexOf("/") + 1);
  return file;
}

function deleteImage () {
  var el = document.getElementById("fm_insert_image");
  var img = new Array;

  for (i=0; i<el.length; i++) {
    if (el.options[i].selected == true) {
      img.push(getFilename(el.options[i].value));
    }
  }
  snd_req(img.join(' '));
}

function deleteList () {
  var el = document.getElementById("fm_insert_image");
  var img = new Array;

  for (i=0; i<el.length; i++) {
    if (el.options[i].selected == true) {
      img.push(el.options[i].text);
    }
  }

  for (i=0; i<el.length; i++) {
    for (j=0; j<img.length; j++) {
      if (el.options[i].text == img[j]) {
        el.options[i] = null;
        imageArray.splice(i,1);
      }
    }
  }

  outputImageSize (0, 0)
  document.getElementById('delete_btn').disabled = true;
  document.insertImage.attachImage.value = '';
  if (el.length < 1) previewImage("");
  else {
      el.options[el.length-1].selected = true;
      selectedPreview(el);
  }
}

function create_request_object(params) {
  var http_request = false;

    if (window.XMLHttpRequest) {
      http_request = new XMLHttpRequest();
      if (http_request.overrideMimeType) {
          http_request.overrideMimeType('text/xml');
      }
    }
    else if (window.ActiveXObject) {
      try {
          http_request = new ActiveXObject("Msxml2.XMLHTTP");
      }
      catch (e) {
          try {
            http_request = new ActiveXObject("Microsoft.XMLHTTP");
          }
          catch (e) {}
      }
    }

    if (!http_request) {
      return false;
    }

    http_request.onreadystatechange = function() { handle_response(http_request); };
    http_request.open("GET", params, true);
    http_request.send(null);
}

function snd_req(img) {
    create_request_object("insert_image.php?do=delete&img="+img);
}

function handle_response (http_request) {
    if(http_request.readyState == 4){
      if (http_request.status == 200) {
        deleteList();
      }
    }
}
function setWrapper () {
  var wrapper = document.getElementById('tmpImage');
  wrapper.style.width = '0px';
  wrapper.style.height = '0px';
  wrapper.style.fontSize = '0px';

  if (navigator.userAgent.toLowerCase().indexOf('opera') != -1)
    wrapper.style.visibility = 'hidden';
  else
    wrapper.style.display = 'none';
}
//]]>
</script>
</head>
<body oncontextmenu="return true" onload="setWrapper();">
<div style="text-align:center">
<script language="javascript" type="text/javascript">CHXUploadRUN();</script>
</div>
<div id="imageSize" style="margin-bottom:3px;font-size:8pt;font-family:verdana;font-weight:bold;text-align:center">0 X 0</div>
<div id="tmpImage"></div>
<fieldset><legend><span class="normal">그림 파일 선택</span></legend>
<div style="padding:5px 0px 2px 5px">
<span class="normal">그림 파일:</span>
</div>
<div style="padding-left:5px">
<form action="insert_image.php" name="insertImage" method="post" enctype="multipart/form-data" target="do_action">
<input type="hidden" name="do" value="submit" />
<input type="hidden" name="attachImage" />
<input type="file" size="30" id="AttachFile" name="AttachFile" onchange="chkImgFormat(this)" />
</form>
</div>
<div style="padding:5px;float:left;width:240px">
<select id="fm_insert_image" name="insert_image" multiple style="font-size:9pt;width:100%;height:50px" onchange="selectedPreview(this)">
</select>
</div>
<div style="float:right;padding-top:5px">
<button id="delete_btn" class="button" onclick="deleteImage()" disabled="true">삭제</button>
</div>
</fieldset>
<div style="margin:10px 0px 10px 0px">
<fieldset><legend><span class="normal">레이아웃</span></legend>
<div style="padding:5px 0px 5px 5px; text-align:center">
<form id="fm_align">
<input type="radio" name="alignment" value="top" checked="checked" /><img src="icons/image_align_top.gif" width="23" height="25" alt="" align="middle" />
<input type="radio" name="alignment" value="left" /><img src="icons/image_align_left.gif" width="23" height="25" alt="" align="middle" />
<input type="radio" name="alignment" value="right" /><img src="icons/image_align_right.gif" width="23" height="25" alt="" align="middle" />
<input type="radio" name="alignment" value="middle" /><img src="icons/image_align_middle.gif" width="23" height="25" alt="" align="middle" />
<input type="radio" name="alignment" value="bottom" /><img src="icons/image_align_bottom.gif" width="23" height="25" alt="" align="middle" />
<input type="radio" name="alignment" value="break" /><img src="icons/image_align_breakline.gif" width="23" height="25" alt="" align="middle" />
</form>
</div>
</fieldset>
</div>
<div style="text-align:center;">
    <button onclick="doSubmit()" id="submit_btn" class="button" disabled="true">확인</button>&#160;
    <button onclick="popupClose()" class="button">취소</button>
</div>
</body>
</html>
