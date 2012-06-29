<?php
include_once("./_common.php");

if ($_REQUEST['do'] == "submit") {

    if (!preg_match("/\.(gif|png|jp[e]?g)$/i", $_FILES['AttachFile']['name']))
        alert("그림 삽입은 GIF, JPG, PNG 파일만 가능합니다.");

    require_once "./imageupload-class.php";
    $attach = new uploader;

    //////////////////////////////////////////////////////////////////////////
    // 이미지 파일이 저장될 디렉토리 경로를 지정합니다.
    // $save_as_directory의 퍼미션은 777로 설정합니다.

    $ym = date("ym", $g4[server_time]);

    //$save_as_directory = "/usr/local/apache/htdocs/cheditor2/attach/";
    $save_as_directory = "$g4[path]/data/$g4[editor]/$ym/";

    @mkdir($save_as_directory, 0707);
    @chmod($save_as_directory, 0707);

    //////////////////////////////////////////////////////////////////////////
    // $save_as_directory의 URL 경로를 입력합니다.
    //$save_as_url = "$g4[url]/data/$g4[editor]/$ym/";
    $save_as_url = "$g4[path]/data/$g4[editor]/$ym/";

    //////////////////////////////////////////////////////////////////////////
    // 옵션:
    //
    // $attach->max_filesize(102400);        // 이미지 업로드 최대 크기
    // $attach->max_image_size(1024, 1024);  // 이미지 가로, 세로 최대 픽셀 크기

    $success = $attach->upload("AttachFile", "", "");

    if ($success) {
        // $attach->save_file("파일 저장 디렉토리", 저장 옵션);
        //
        // 파일 이름에 한글 또는 사용되어 서는 안될 특수문자가 있을 경우, 잘라버립니다.
        //
        // 저장 옵션:
        // 1 = 같은 이름의 파일이 존재 하면 덮어 씁니다.
        // 2 = 같은 이름의 파일이 존재할 경우, 파일 이름 뒤에 _copy,jpg, _copy1.jpg ... 식으로 이름을 붙입니다.
        // 3 = 같은 이름의 파일이 존재할 경우, 업로드하지 않습니다.

        $success = $attach->save_file($save_as_directory, 2);
    }

    if ($success) {
        $filename = $save_as_url . $attach->file['name'];

        echo '<script language=javascript>';
        //echo 'var obj = window.opener.chutil.myobj;';
        echo 'var obj = window.opener.saveobj;';
        echo 'var img = document.createElement("img");';
        echo "img.src    = \"$filename\";";
        if ($_REQUEST['description']) echo 'img.alt = "' . $_REQUEST['description'] . '";';
        if ($_REQUEST['alignment']) echo 'img.align = "' . $_REQUEST['alignment'] . '";';
        if ($_REQUEST['b']) echo 'img.border = "' . $_REQUEST['b'] . '";';
        if ($_REQUEST['v']) echo 'img.vspace = "' . $_REQUEST['v'] . '";';
        if ($_REQUEST['h']) echo 'img.hspace = "' . $_REQUEST['h'] . '";';
        echo 'img.width  = "' . $_REQUEST['imageWidth'] . '";';
        echo 'img.height = "' . $_REQUEST['imageHeight'] . '";';
            echo 'eval("window.opener."+obj).insertImage(img);';
            echo 'window.close();';
        echo '</script>';
    }
    else {
        if ($attach->errors) {
            while (list($k, $v) = each($attach->errors)) {
                echo $v . "<br>";
            }
        }
    }
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$g4[charset]?>">
<title>이미지 넣기</title>
<STYLE TYPE="text/css">
body {
  background-color: #eeeeee;
  margin: 5px;
  border: 0;
  padding: 5px;
}
.button {
  font-size: 9pt;
  padding-top: 3px;
  height: 24px;
  width: 6em;
}
img {
  border: 0;
}

font {
  font-size: 9pt;
  font-family: 굴림;
}
</STYLE>
</head>
<body bgcolor="#dedfdf" oncontextmenu="return false">
<center>
<form action="insert_image.php?do=submit" name="insertImage" method=post style="inline" enctype="multipart/form-data">

<fieldset><legend><font color="blue">미리 보기</font></legend>
<table border="0" width="100%" cellspacing="0" cellpadding="4">
  <tr>
    <td align="center">
      <table border="0" cellpadding="0" cellspacing="0" width="240">
        <tr>
          <td bgcolor="#999999">
            <table border="0" cellpadding="2" cellspacing="1" width="100%">
              <tr>
                <td bgcolor="white" height="184" valign="center" align="center">
                  <span id="show_image"></span>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</fieldset>
<br>
<fieldset><legend><font color="blue">그림 삽입</font></legend>
<table border="0" width="100%" cellspacing="0" cellpadding="4">
  <tr>
    <td>
      <font>삽입할 그림 선택:</font>
    </td>
  </tr>
  <tr>
    <td>
      <input type="file" size="37" name="AttachFile" onChange="display_image();">
    </td>
  </tr>
  <tr>
    <td>
      <font>그림 설명 (옵션):</font>
    </td>
  </tr>
  <tr>
    <td><input type="text" name="description" id="description" size="50"></td>
  </tr>
</table>
</fieldset>
<br>
<fieldset><legend><font color="blue">옵션</font></legend>
<table border="0" cellpadding="4" cellspacing="1" width="100%">
  <tr bgcolor="#c0c0c0">
    <td>
      <font><b>레이아웃</b></font>
    </td>
    <td>
      <font><b>간격</b></font>
    </td>
  </tr>
  <tr bgcolor="#dedfdf">
    <td width="50%">
      <font>맞춤:
      <select size="1" name="alignment" id="alignment" style="font-size:9pt">
      <option value="" selected>없음</option>
      <option value="Baseline">기준선</option>
      <option value="Top">위쪽</option>
      <option value="Middle">가운데</option>
      <option value="Bottom">아래쪽</option>
      <option value="Toptext">문자열 위쪽</option>
      <option value="Absmiddle">선택 영역의 가운데</option>
      <option value="Absbottom">선택 영역의 아래쪽</option>
      <option value="Left">왼쪽</option>
      <option value="Right">오른쪽</option>
      </select></font>
    </td>
    <td width="50%"><font>가로여백:</font>
      <input type="text" name="h" id="h" size="3" value="0">
    </td>
  </tr>
  <tr bgcolor="#dedfdf">
    <td>
      <font>괘선 두께:
      <input type="text" name="b" id="b" size="3" value="0"></font>
    </td>
    <td>
      <font>세로여백:
      <input type="text" name="v" id="v" size="3" value="0"></font>
    </td>
  </tr>
  <tr bgcolor="#c0c0c0">
    <td>
      <font><b>이미지 가로 폭</b></font>
    </td>
    <td>
      <font><b>이미지 세로 폭</b></font>
    </td>
  </tr>
  <tr bgcolor="#dedfdf">
    <td>
      <font>가로 픽셀:
      <input type="text" name="imageWidth" id="imageWidth" size="5" value="0"></font>
    </td>
    <td>
      <font>세로 픽셀:
      <input type="text" name="imageHeight" id="imageHeight" size="5" value="0"></font>
    </td>
  </tr>
</table>
</fieldset>
<br>
<input type="button" onClick="insertImage.submit();" value="확인" class="button">
<input type="button" value="취소" onClick="window.close();" class="button">
</form>
</center>
<script language=javascript>

function display_image()
{
    var file = document.insertImage.AttachFile.value;
    var allowSubmit = false;
    var extArray = new Array(".gif", ".jpg", ".png");

    extArray.join(" ");

    if (!file) return;

    while (file.indexOf("\\") != -1)
        file = file.slice(file.indexOf("\\") + 1);

    var ext = file.slice(file.indexOf(".")).toLowerCase();

    for (var i = 0; i < extArray.length; i++) {
        if (extArray[i] == ext) {
            allowSubmit = true;
            break;
        }
    }

    if (allowSubmit) {
        show_image.innerHTML = '';
        imgComplete();
    }
    else {
        alert("그림 삽입은 GIF, JPG, PNG 파일만 가능합니다. 다시 선택하여 주십시요.");
    }
}

function imgComplete ()
{
    var img = document.createElement("img");
    img.src = document.insertImage.AttachFile.value;

    var w = 240;
    var h = 180;
    var resizeW;
    var resizeH;

    if (img.complete == true) {
        if (img.width > w || img.height > h) {
            if (img.width > img.height) {
                resizeW = img.width > w ? w : img.width;
                resizeH = Math.round((img.height * resizeW) / img.width);
            }
            else {
                resizeH = img.height > h ? h : img.height;
                resizeW = Math.round((img.width * resizeH) / img.height);
            }
        }
        else {
            resizeW = img.width;
            resizeH = img.height;
        }

        document.insertImage.imageHeight.value = img.height;
        document.insertImage.imageWidth.value = img.width;

        img.width = resizeW;
        img.height = resizeH;

        show_image.appendChild(img);
    }
    else {
        setTimeout("imgComplete()", 100);
    }
}
</script>
</body>
</html>
