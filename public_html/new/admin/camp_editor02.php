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

<!-- form �� submit() �մϴ�. -->
function doSubmit (theform)
{
    // textarea 'fm_post'�� �����Ϳ��� �Է��� ���븦 �ֽ��ϴ�.
    document.getElementById("fm_post").value = myeditor.outputBodyHTML();

    alert(theform.fm_write.value);

    // theform.submit() or return false;
}

<!-- ȭ���� �������� �ʰ� ���� ��� �Է��� �� �ֵ��� �ϱ� ���ؼ��Դϴ�. -->
<!-- form�� submit() �� ���� �� �Լ��� ������� �ʽ��ϴ�. -->

</script>
<textarea id="fm_post" name="<?=$control?>" style="display:none">
<?=$strValue?>
</textarea>
<script type="text/javascript" language="javascript">
myeditor.config.editorHeight = '420px';             // ������ �������Դϴ�.
myeditor.config.editorWidth = '100%';                // ������ �������Դϴ�.
myeditor.config.editorPath = '../cheditor4';                  // ������ ��ġ ����Դϴ�. ��� ���� '/'�� ������ �ʽ��ϴ�.
myeditor.inputForm = 'fm_post';                     // �Է� textarea�� ID �̸��Դϴ�.
myeditor.run();                                     // �����͸� �����մϴ�.
</script>

				  </td>
                </tr>
            </table></td>
          </tr>
    </table>

</form>
 </BODY>
</HTML>
