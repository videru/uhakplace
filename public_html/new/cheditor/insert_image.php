<?php
include_once("./_common.php");

if ($_REQUEST['do'] == "submit") {

    if (!preg_match("/\.(gif|png|jp[e]?g)$/i", $_FILES['AttachFile']['name']))
        alert("�׸� ������ GIF, JPG, PNG ���ϸ� �����մϴ�.");

    require_once "./imageupload-class.php";
    $attach = new uploader;

    //////////////////////////////////////////////////////////////////////////
    // �̹��� ������ ����� ���丮 ��θ� �����մϴ�.
    // $save_as_directory�� �۹̼��� 777�� �����մϴ�.

    $ym = date("ym", $g4[server_time]);

    //$save_as_directory = "/usr/local/apache/htdocs/cheditor2/attach/";
    $save_as_directory = "$g4[path]/data/$g4[editor]/$ym/";

    @mkdir($save_as_directory, 0707);
    @chmod($save_as_directory, 0707);

    //////////////////////////////////////////////////////////////////////////
    // $save_as_directory�� URL ��θ� �Է��մϴ�.
    //$save_as_url = "$g4[url]/data/$g4[editor]/$ym/";
    $save_as_url = "$g4[path]/data/$g4[editor]/$ym/";

    //////////////////////////////////////////////////////////////////////////
    // �ɼ�:
    //
    // $attach->max_filesize(102400);        // �̹��� ���ε� �ִ� ũ��
    // $attach->max_image_size(1024, 1024);  // �̹��� ����, ���� �ִ� �ȼ� ũ��

    $success = $attach->upload("AttachFile", "", "");

    if ($success) {
        // $attach->save_file("���� ���� ���丮", ���� �ɼ�);
        //
        // ���� �̸��� �ѱ� �Ǵ� ���Ǿ� ���� �ȵ� Ư�����ڰ� ���� ���, �߶�����ϴ�.
        //
        // ���� �ɼ�:
        // 1 = ���� �̸��� ������ ���� �ϸ� ���� ���ϴ�.
        // 2 = ���� �̸��� ������ ������ ���, ���� �̸� �ڿ� _copy,jpg, _copy1.jpg ... ������ �̸��� ���Դϴ�.
        // 3 = ���� �̸��� ������ ������ ���, ���ε����� �ʽ��ϴ�.

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
<title>�̹��� �ֱ�</title>
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
  font-family: ����;
}
</STYLE>
</head>
<body bgcolor="#dedfdf" oncontextmenu="return false">
<center>
<form action="insert_image.php?do=submit" name="insertImage" method=post style="inline" enctype="multipart/form-data">

<fieldset><legend><font color="blue">�̸� ����</font></legend>
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
<fieldset><legend><font color="blue">�׸� ����</font></legend>
<table border="0" width="100%" cellspacing="0" cellpadding="4">
  <tr>
    <td>
      <font>������ �׸� ����:</font>
    </td>
  </tr>
  <tr>
    <td>
      <input type="file" size="37" name="AttachFile" onChange="display_image();">
    </td>
  </tr>
  <tr>
    <td>
      <font>�׸� ���� (�ɼ�):</font>
    </td>
  </tr>
  <tr>
    <td><input type="text" name="description" id="description" size="50"></td>
  </tr>
</table>
</fieldset>
<br>
<fieldset><legend><font color="blue">�ɼ�</font></legend>
<table border="0" cellpadding="4" cellspacing="1" width="100%">
  <tr bgcolor="#c0c0c0">
    <td>
      <font><b>���̾ƿ�</b></font>
    </td>
    <td>
      <font><b>����</b></font>
    </td>
  </tr>
  <tr bgcolor="#dedfdf">
    <td width="50%">
      <font>����:
      <select size="1" name="alignment" id="alignment" style="font-size:9pt">
      <option value="" selected>����</option>
      <option value="Baseline">���ؼ�</option>
      <option value="Top">����</option>
      <option value="Middle">���</option>
      <option value="Bottom">�Ʒ���</option>
      <option value="Toptext">���ڿ� ����</option>
      <option value="Absmiddle">���� ������ ���</option>
      <option value="Absbottom">���� ������ �Ʒ���</option>
      <option value="Left">����</option>
      <option value="Right">������</option>
      </select></font>
    </td>
    <td width="50%"><font>���ο���:</font>
      <input type="text" name="h" id="h" size="3" value="0">
    </td>
  </tr>
  <tr bgcolor="#dedfdf">
    <td>
      <font>���� �β�:
      <input type="text" name="b" id="b" size="3" value="0"></font>
    </td>
    <td>
      <font>���ο���:
      <input type="text" name="v" id="v" size="3" value="0"></font>
    </td>
  </tr>
  <tr bgcolor="#c0c0c0">
    <td>
      <font><b>�̹��� ���� ��</b></font>
    </td>
    <td>
      <font><b>�̹��� ���� ��</b></font>
    </td>
  </tr>
  <tr bgcolor="#dedfdf">
    <td>
      <font>���� �ȼ�:
      <input type="text" name="imageWidth" id="imageWidth" size="5" value="0"></font>
    </td>
    <td>
      <font>���� �ȼ�:
      <input type="text" name="imageHeight" id="imageHeight" size="5" value="0"></font>
    </td>
  </tr>
</table>
</fieldset>
<br>
<input type="button" onClick="insertImage.submit();" value="Ȯ��" class="button">
<input type="button" value="���" onClick="window.close();" class="button">
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
        alert("�׸� ������ GIF, JPG, PNG ���ϸ� �����մϴ�. �ٽ� �����Ͽ� �ֽʽÿ�.");
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
