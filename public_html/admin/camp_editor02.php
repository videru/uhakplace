<?
	include_once("../include/lib.php");

    $strValue ="";
	if ($num != "") {
	    $rs_list1 = new $rs_class($dbcon);
		$rs_list1->clear();
		$rs_list1->set_table($_table['camp']);
		$rs_list1->where_sql="num =$num";
		$rs_list1->select();
		$rs=$rs_list1->fetch();

		$strValue = rg_html_entity($rs[$control]);
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE> New Document </TITLE>
 <script type="text/javascript" language="javascript" src="../cheditor4/cheditor.js"></script>
 </HEAD>

 <BODY leftmargin=0 topmargin=0>
 <form name="theform" method="POST" style="margin:0px">
<!--  <input type="text" name="aaa"> -->
  <table border=0 cellpadding=0 cellspacing=0 width="100%">
    <tr>
        <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="1" bgcolor="E5E5E5">
          <tr>
            <td bgcolor="FBFBFB"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td bgcolor="#FFFFFF">
<script type="text/javascript" language="javascript">
var myeditor = new cheditor("myeditor");

<!-- form 을 submit() 합니다. -->
function doSubmit (theform)
{
    // textarea 'fm_post'에 에디터에서 입력한 내용를 넣습니다.
    document.getElementById("fm_post").value = myeditor.outputBodyHTML();

    alert(theform.fm_write.value);

    // theform.submit() or return false;
}

<!-- 화면을 갱신하지 않고 글을 계속 입력할 수 있도록 하기 위해서입니다. -->
<!-- form을 submit() 할 경우는 이 함수를 사용하지 않습니다. -->

</script>
<textarea id="fm_post" name="<?=$control?>" style="display:none">
<?=$strValue?>
</textarea>
<script type="text/javascript" language="javascript">
myeditor.config.editorHeight = '420px';             // 에디터 세로폭입니다.
myeditor.config.editorWidth = '100%';                // 에디터 가로폭입니다.
myeditor.config.editorPath = '../cheditor4';                  // 에디터 설치 경로입니다. 경로 끝에 '/'를 붙이지 않습니다.
myeditor.inputForm = 'fm_post';                     // 입력 textarea의 ID 이름입니다.
myeditor.run();                                     // 에디터를 실행합니다.
</script>

				  </td>
                </tr>
            </table></td>
          </tr>
    </table>

</form>
 </BODY>
</HTML>
