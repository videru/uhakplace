<?

	if($_SERVER['REQUEST_METHOD']=='POST') {

		
	if($name != "Ambubrimb"){	//�����ۼ���		
	
			
    $name1 = trim($name);
	$text1 = trim($text);
	$tel1 = trim($tel);

	if($name1 != "" and $text1 != "" and $tel1 != ""){


			$rs->clear();
	    	$rs->set_table($_table['sms']);
	    	$rs->add_field("text","$text");	
	    	$rs->add_field("name","$name");		
	    	$rs->add_field("tel","$tel");	
	    	$rs->add_field("reg_date",time());	
	    	$rs->add_field("gubun","2");	
			$rs->insert();
	
		$rs->commit();
		echo "<script>alert('���۵Ǿ����ϴ�.');</script>";
	}
    else{
   
	 if($text1 ==""){	 
	 echo "<script>alert('������ �Է��ϼ���.');</script>";
	 }elseif($name1 ==""){
	 echo "<script>alert('�̸��� �Է��ϼ���.');</script>";
	 }elseif($tel1 ==""){
	 echo "<script>alert('����ó�� �Է��ϼ���.');</script>";
	 }


    }



	}
 
	}


?> 
<script language="javascript">
<!--

function sendit()
{

	var f = document.add_form;

	if(f.text.value.length == 0){
		alert("������ �Է��ϼ���.");
		f.text.focus();
		return;
	}	
	
	
	if(f.name.value.length == 0){
		alert("�̸��� �Է��ϼ���.");
		f.name.focus();
		return;
	}


   if(f.tel.value.length == 0){
		alert("����ó�� �Է��ϼ���.");
		f.tel.focus();
		return;
	}



	//	f.action = "../";
		f.submit();
	//	alert("���۵Ǿ����ϴ�.");	

}

//-->
</script>
<script language="javascript">
<!--

var stmnLEFT = 1080; // ��ũ�Ѹ޴��� ���� ��ġ
var stmnGAP1 = 400; // ������ ����κ��� ����
var stmnGAP2 = 0; // ��ũ�ѽ� ������ ��ܰ� �ణ ���. �ʿ������ 0���� ����
var stmnBASE = 100; // ��ũ�Ѹ޴� �ʱ� ������ġ (�ƹ����Գ� �ص� ����� ������ stmnGAP1�� �ణ ���̸� �ִ°� ���� ����)
var stmnActivateSpeed = 200; // �������� �����ϴ� �ӵ� (���ڰ� Ŭ���� �ʰ� �˾�����)
var stmnScrollSpeed = 10; // ��ũ�ѵǴ� �ӵ� (Ŭ���� �ʰ� ������)

var stmnTimer;

function ReadCookie(name) {
var label = name + "=";
var labelLen = label.length;
var cLen = document.cookie.length;
var i = 0;

while (i < cLen) {
var j = i + labelLen;

if (document.cookie.substring(i, j) == label) {
var cEnd = document.cookie.indexOf(";", j);
if (cEnd == -1) cEnd = document.cookie.length;
return unescape(document.cookie.substring(j, cEnd));
}
i++;
}
return "";
}

function SaveCookie(name, value, expire) {
var eDate = new Date();
eDate.setDate(eDate.getDate() + expire);
document.cookie = name + "=" + value + "; expires=" + eDate.toGMTString()+ "; path=/";
}

function RefreshStaticMenu()
{
var stmnStartPoint, stmnEndPoint, stmnRefreshTimer;

stmnStartPoint = parseInt(STATICMENU.style.top, 10);


stmnEndPoint = document.body.scrollTop + stmnGAP2;

stmnLimit = parseInt(window.document.body.scrollHeight) - parseInt(STATICMENU.offsetHeight);
if (stmnEndPoint > stmnLimit) stmnEndPoint = stmnLimit;

if (stmnEndPoint < stmnGAP1) stmnEndPoint = stmnGAP1;

stmnRefreshTimer = stmnActivateSpeed;

if ( stmnStartPoint != stmnEndPoint ) {
stmnScrollAmount = Math.ceil( Math.abs( stmnEndPoint - stmnStartPoint ) / 15 );
STATICMENU.style.top = parseInt(STATICMENU.style.top, 10) + ( ( stmnEndPoint<stmnStartPoint ) ? -stmnScrollAmount : stmnScrollAmount );
stmnRefreshTimer = stmnScrollSpeed;
}

stmnTimer = setTimeout ("RefreshStaticMenu();", stmnRefreshTimer);
}

function ToggleAnimate() {
if (!ANIMATE.checked) {
RefreshStaticMenu();
SaveCookie("ANIMATE", "true", 300);
} else {
clearTimeout(stmnTimer);
STATICMENU.style.top = stmnGAP1;
SaveCookie("ANIMATE", "false", 300);
}
}

function InitializeStaticMenu() {
STATICMENU.style.left = stmnLEFT;
if (ReadCookie("ANIMATE") == "false") {
ANIMATE.checked = true;
STATICMENU.style.top = document.body.scrollTop + stmnGAP1;
} else {
ANIMATE.checked = false;
STATICMENU.style.top = document.body.scrollTop + stmnBASE;
RefreshStaticMenu();
}
}


function closeWin10() { 

	document.all['STATICMENU'].style.visibility = "hidden";
}

//-->
</script>
<script> 
<!--
function 
    clrImg(obj){
        obj.style.backgroundImage="";obj.onkeydown=obj.onmousedown=null;
    }
//-->
</script>

<div id="STATICMENU"  style="position:absolute;left:expression((document.body.clientWidth/2)+430); top:130px; z-index:100;">
<table border="0" cellspacing="0" cellpadding="0" width="136">
<tr>
<td>
<!------------------------------>
<table cellpadding="0" cellspacing="0" border="0" width="153">
<tr><td><img src="../img/sms_top.gif" border="0"></td></tr>
<tr><td height="145" background="../img/sms_bg.gif" align="center" valign="top">
  <table cellpadding="0" cellspacing="0" border="0" width="140">
   <form name="add_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
  <tr><td colspan="2"><textarea class="boxsms1" name="text" onkeydown="clrImg(this)" onmousedown="clrImg(this)" style="background-color:#FFFFFF;width:140px;border-color:CCCCCC;background-image:url(../img/smsd.gif);background-repeat:no-repeat;background-position:left;"></textarea></td></tr>
  <tr><td colspan="2" height="6"></td></tr>
  <tr><td class="location" width="45"><font color="330000">�̸�</font></td><td width="95"><input type="text" name="name"class="cc" style="background-color:#FFFFFF;color:#4c4c4c;width:95px;border-color:CCCCCC""></td></tr>
  <tr><td class="location" width="45"><font color="330000">����ó</font></td><td width="95"><input type="text" name="tel" class="boxsms2" style="background-color:#FFFFFF;color:#4c4c4c;width:95px;border-color:CCCCCC""></td></tr>
  <tr><td colspan="2" height="6"></td></tr>
  <tr><td colspan="2"><img src="../img/sms_btnsend.gif" style="cursor:hand" onclick="sendit();"/></td></tr>
  </form>
  </table>
</td></tr>
<tr><td height="5" background="../img/sms_bot.gif" ></td></tr>
</table>
<!-------------//--------------->
</td>
</tr>
<tr>
<td align="center" height="20" style="font-size:11px;" background="../img/sms_bot.gif" ><input id="ANIMATE" type="checkbox" onclick="closeWin10();"> SMS ����û ����</td>
</tr>
</table>

<br>
<!--SCRIPT ID='alimi' figure=y width=160 height=200 Qwhere='in' src=http://alimi.cafe24.com/php/alimi.js.php?id=uhakplace&SKIN=4&mode=new></SCRIPT-->
</div>

<script language="javascript">
<!--
InitializeStaticMenu(); // ��ũ�Ѹ޴��� �����ϴ� �ڹٽ�ũ��Ʈ
//-->
</script>

