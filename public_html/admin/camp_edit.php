<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
	if ($national=="") {
		$national="3";
	}

	if ($national=="1") {
     $ss_list = $_const['area1']; // ������������
    }elseif($national=="2") {
     $ss_list = $_const['area2']; // ȣ������
	}elseif($national=="3") {
     $ss_list = $_const['area3']; //�ʸ�������
    }elseif($national=="4") {
     $ss_list = $_const['area4']; // ��������
    }

	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table($_table['camp']);
		$rs->add_where("num=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // ������ �ùٸ��� �ʴٸ�
			rg_href('','������ ã���� �����ϴ�.','back');
		}
		$data=$rs->fetch();		
	
	} else {
		$data=$rs->fetch();	
	}

   // ����
	if($mode=='delete') {	
		
		// �б� ����
		$rs->clear();
		$rs->set_table($_table['camp']);
		$rs->add_where("num=$num");
		$rs->delete();		
		$rs->commit();
		rg_href("camp_list.php?$_get_param[3]");
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {

			$rs->clear();
	    	$rs->set_table($_table['camp']);	
			$rs->add_field("office_tel","$office_tel");		
			$rs->add_field("msn","$msn");		
			$rs->add_field("check","$check");		
			$rs->add_field("admin_memo","$admin_memo");		            
			$rs->add_field("best","$best");		          
			$rs->add_field("national","$national");		
			$rs->add_field("section","$section");	
			$rs->add_field("movielink","$movielink");		               
			$rs->add_field("area","$area");	
			$rs->add_field("title","$title");		
			$rs->add_field("s_title","$s_title");		
			$rs->add_field("location","$location");		
			$rs->add_field("eng_etc","$eng_etc");		  
			$rs->add_field("etc_facility","$etc_facility");		           
			$rs->add_field("activity","$activity");		
			$rs->add_field("special","$special");		            
			$rs->add_field("homepage","$homepage");	
			$rs->add_field("info","$info");		    
			$rs->add_field("program","$program");	
			$rs->add_field("activity_info","$activity_info");				
			$rs->add_field("cost_info","$cost_info");	
	    
    	    $rs->add_field("after_info","$after_info");
			$rs->add_field("wk_pro","$wk_pro");
			$rs->add_field("schedule","$schedule");
		    $rs->add_field("camp_school","$camp_school");
	    	$rs->add_field("homestay","$homestay");
		    $rs->add_field("national_info","$national_info");
	    	$rs->add_field("camp_qna","$camp_qna");


		
		if($mode=='modify') {
			$rs->add_where("num=$num");
			$rs->update();
		} else {
			$rs->insert();
			$num=$rs->get_insert_id();		
		}
	
       // ���� ���ε�

        @mkdir("../data/camp/".$num."/", 0707);
        @chmod("../data/camp/".$num."/", 0707);   
	   
	     $school_path="../data/camp/".$num."/";

	    for($fi=1;$fi<42;$fi++) {
		if(${"del_file{$fi}"}) {
			@unlink($school_path.${"school_file{$fi}_name"});
			${"school_file{$fi}_name"} = '';
	
		 $rs->clear();
			$rs->set_table($_table['camp']);
		    if($del_file1){
			$rs->add_field("school_file1_name","$school_file1_name");
			}
			if($del_file2){
			$rs->add_field("school_file2_name","$school_file2_name");		
			}
			if($del_file3){			
			$rs->add_field("school_file3_name","$school_file3_name");
			}
			if($del_file4){
			$rs->add_field("school_file4_name","$school_file4_name");
			}
			if($del_file5){
			$rs->add_field("school_file5_name","$school_file5_name");	
			}
			if($del_file6){
			$rs->add_field("school_file6_name","$school_file6_name");
			}
			if($del_file7){
			$rs->add_field("school_file7_name","$school_file7_name");
			}
			if($del_file8){
			$rs->add_field("school_file8_name","$school_file8_name");
			}			
			if($del_file9){
			$rs->add_field("school_file9_name","$school_file9_name");
			}
			if($del_file10){
			$rs->add_field("school_file10_name","$school_file10_name");
			}			
			if($del_file11){
			$rs->add_field("school_file11_name","$school_file11_name");
			}
			if($del_file12){
			$rs->add_field("school_file12_name","$school_file12_name");		
			}
			if($del_file13){			
			$rs->add_field("school_file13_name","$school_file13_name");
			}
			if($del_file14){
			$rs->add_field("school_file14_name","$school_file14_name");
			}
			if($del_file15){
			$rs->add_field("school_file15_name","$school_file15_name");	
			}
			if($del_file16){
			$rs->add_field("school_file16_name","$school_file16_name");
			}
			if($del_file17){
			$rs->add_field("school_file17_name","$school_file17_name");
			}
			if($del_file18){
			$rs->add_field("school_file18_name","$school_file18_name");
			}			
			if($del_file19){
			$rs->add_field("school_file19_name","$school_file19_name");
			}
			if($del_file20){
			$rs->add_field("school_file20_name","$school_file20_name");
			}			
			if($del_file21){
			$rs->add_field("school_file21_name","$school_file21_name");
			}
			if($del_file22){
			$rs->add_field("school_file22_name","$school_file22_name");		
			}
			if($del_file23){			
			$rs->add_field("school_file23_name","$school_file23_name");
			}
			if($del_file24){
			$rs->add_field("school_file24_name","$school_file24_name");
			}
			if($del_file25){
			$rs->add_field("school_file25_name","$school_file25_name");	
			}
			if($del_file26){
			$rs->add_field("school_file26_name","$school_file26_name");
			}
			if($del_file27){
			$rs->add_field("school_file27_name","$school_file27_name");
			}
			if($del_file28){
			$rs->add_field("school_file28_name","$school_file28_name");
			}			
			if($del_file29){
			$rs->add_field("school_file29_name","$school_file29_name");
			}
			if($del_file30){
			$rs->add_field("school_file30_name","$school_file30_name");
			}	

			if($del_file31){
			$rs->add_field("school_file31_name","$school_file31_name");
			}
			if($del_file32){
			$rs->add_field("school_file32_name","$school_file32_name");		
			}
			if($del_file33){			
			$rs->add_field("school_file33_name","$school_file33_name");
			}
			if($del_file34){
			$rs->add_field("school_file34_name","$school_file34_name");
			}
			if($del_file35){
			$rs->add_field("school_file35_name","$school_file35_name");	
			}
			if($del_file36){
			$rs->add_field("school_file36_name","$school_file36_name");
			}
			if($del_file37){
			$rs->add_field("school_file37_name","$school_file37_name");
			}
			if($del_file38){
			$rs->add_field("school_file38_name","$school_file38_name");
			}			
			if($del_file39){
			$rs->add_field("school_file39_name","$school_file39_name");
			}
			if($del_file40){
			$rs->add_field("school_file40_name","$school_file40_name");
			}	
			if($del_file41){
			$rs->add_field("school_file41_name","$school_file41_name");
			}	


			$rs->add_where("num=$num");
			$rs->update();
				
		}
		
		$file = $_FILES["school_file$fi"];

			$temp=explode(".",$file[name]);
			$file[ext]=$temp[count($temp)-1];
			
			$file[server_name] = $file[name];
			
			if(${"school_file{$fi}_name"}) {
				if(@unlink($school_path.${"school_file{$fi}_name"})) {
					${"school_file{$fi}_name"} = '';
				}
			}
			
			if(@copy($file[tmp_name], $school_path.$file[server_name])) {
				${"school_file{$fi}_name"} = $file[name];
			} else {
			 
				if(@move_uploaded_file($file[tmp_name], $school_path.$file[server_name])) {
					${"school_file{$fi}_name"} = $file[name];
				} else {
					${"school_file{$fi}_name"} = '';
				}
			}
			// -- copy END -- 
		}



		    $rs->clear();
			$rs->set_table($_table['camp']);
		    if($school_file1_name){
			$rs->add_field("school_file1_name","$school_file1_name");
			}
			if($school_file2_name){
			$rs->add_field("school_file2_name","$school_file2_name");		
			}
			if($school_file3_name){			
			$rs->add_field("school_file3_name","$school_file3_name");
			}
			if($school_file4_name){
			$rs->add_field("school_file4_name","$school_file4_name");
			}
			if($school_file5_name){
			$rs->add_field("school_file5_name","$school_file5_name");	
			}
			if($school_file6_name){
			$rs->add_field("school_file6_name","$school_file6_name");
			}
			if($school_file7_name){
			$rs->add_field("school_file7_name","$school_file7_name");
			}
			if($school_file8_name){
			$rs->add_field("school_file8_name","$school_file8_name");
			}			
			if($school_file9_name){
			$rs->add_field("school_file9_name","$school_file9_name");
			}
			if($school_file10_name){
			$rs->add_field("school_file10_name","$school_file10_name");
			}			
			if($school_file11_name){
			$rs->add_field("school_file11_name","$school_file11_name");
			}
			if($school_file12_name){
			$rs->add_field("school_file12_name","$school_file12_name");		
			}
			if($school_file13_name){			
			$rs->add_field("school_file13_name","$school_file13_name");
			}
			if($school_file14_name){
			$rs->add_field("school_file14_name","$school_file14_name");
			}
			if($school_file15_name){
			$rs->add_field("school_file15_name","$school_file15_name");	
			}
			if($school_file16_name){
			$rs->add_field("school_file16_name","$school_file16_name");
			}
			if($school_file17_name){
			$rs->add_field("school_file17_name","$school_file17_name");
			}
			if($school_file18_name){
			$rs->add_field("school_file18_name","$school_file18_name");
			}			
			if($school_file19_name){
			$rs->add_field("school_file19_name","$school_file19_name");
			}
			if($school_file20_name){
			$rs->add_field("school_file20_name","$school_file20_name");
			}	
			if($school_file21_name){
			$rs->add_field("school_file21_name","$school_file21_name");
			}	
			if($school_file22_name){
			$rs->add_field("school_file22_name","$school_file22_name");		
			}
			if($school_file23_name){			
			$rs->add_field("school_file23_name","$school_file23_name");
			}
			if($school_file24_name){
			$rs->add_field("school_file24_name","$school_file24_name");
			}
			if($school_file25_name){
			$rs->add_field("school_file25_name","$school_file25_name");	
			}
			if($school_file26_name){
			$rs->add_field("school_file26_name","$school_file26_name");
			}
			if($school_file27_name){
			$rs->add_field("school_file27_name","$school_file27_name");
			}
			if($school_file28_name){
			$rs->add_field("school_file28_name","$school_file28_name");
			}			
			if($school_file29_name){
			$rs->add_field("school_file29_name","$school_file29_name");
			}
			if($school_file30_name){
			$rs->add_field("school_file30_name","$school_file30_name");
			}	

			if($school_file31_name){
			$rs->add_field("school_file31_name","$school_file31_name");
			}	
			if($school_file32_name){
			$rs->add_field("school_file32_name","$school_file32_name");		
			}
			if($school_file33_name){			
			$rs->add_field("school_file33_name","$school_file33_name");
			}
			if($school_file34_name){
			$rs->add_field("school_file34_name","$school_file34_name");
			}
			if($school_file35_name){
			$rs->add_field("school_file35_name","$school_file35_name");	
			}
			if($school_file36_name){
			$rs->add_field("school_file36_name","$school_file36_name");
			}
			if($school_file37_name){
			$rs->add_field("school_file37_name","$school_file37_name");
			}
			if($school_file38_name){
			$rs->add_field("school_file38_name","$school_file38_name");
			}			
			if($school_file39_name){
			$rs->add_field("school_file39_name","$school_file39_name");
			}
			if($school_file40_name){
			$rs->add_field("school_file40_name","$school_file40_name");
			}	
			if($school_file41_name){
			$rs->add_field("school_file41_name","$school_file41_name");
			}	


			$rs->add_where("num=$num");
			$rs->update();
				  
	
		
		$rs->commit();	
	
	
	
		rg_href("camp_list.php?$_get_param[3]");	
	
	}	

	$MENU_L='m5';

?>

<script language="JavaScript" type="text/JavaScript">
<!--
function chk()
{
	var f = document.school_form;
/*
	if(f.nation.value == "")
	{
		alert("������ ������ �ּ���");
		f.nation.focus();
		return false;
	}
	  var j = 0;
	  for (var i = 0; i < f.elements.length; i++)  {
		var oCheckbox = f.elements[i];
		if (oCheckbox.checked == true) {
		  j++;
		}
	  }
	  
	  if (j == 0)  {
		alert("�з��� ������ �ּ���");
		f.nation.focus();
		return false;
	  }
/*
	if(f.category.value == "")
	{
		alert("�з��� ������ �ּ���");
		f.category.focus();
		return false;
	}
*/

	if(f.title.value == "")
	{
		alert("�б����� ������ϴ�.");
		f.title.focus();
		return false;
	}
/*
	if(f.city.value == "")
	{
		alert("���ð� ������ϴ�.");
		f.city.focus();
		return false;
	}
*/

	f.info.value      = document.info_frm.myeditor.outputBodyHTML();	
	if(f.national.value == "3")
	{
	f.program.value   = document.program_frm.myeditor.outputBodyHTML();		
	f.special.value    = document.special_frm.myeditor.outputBodyHTML();
	f.activity_info.value    = document.activity_info_frm.myeditor.outputBodyHTML();
	f.cost_info.value    = document.cost_info_frm.myeditor.outputBodyHTML();
	}else{
	f.after_info.value    = document.after_info_frm.myeditor.outputBodyHTML();	
	f.wk_pro.value    = document.wk_pro_frm.myeditor.outputBodyHTML();
	f.schedule.value    = document.schedule_frm.myeditor.outputBodyHTML();
	f.camp_school.value    = document.camp_school_frm.myeditor.outputBodyHTML();	
	f.homestay.value    = document.homestay_frm.myeditor.outputBodyHTML();	
	f.national_info.value    = document.national_info_frm.myeditor.outputBodyHTML();	
	f.camp_qna.value    = document.camp_qna_frm.myeditor.outputBodyHTML();	
	}
}

//-->
</script>
<script>
var aaa='';	
function dnum(name) {

	dismenu = eval("dismenu_"+name+".style");
	if(aaa!=dismenu) 	{
		if(aaa!='') {
			aaa.display='none';
		}
		dismenu.display='block';
		aaa=dismenu;
	}
	else {
		dismenu.display='none';
		aaa='';
	}
}
</script>
<script language="JavaScript" type="text/JavaScript">
<!--		              
function change(fr) {
  if (fr.value == "") {    
  }
  else  {
   if  ("<?=$mode?>" == "modify") {    
	location.href = "?<?=$_get_param[3]?>&mode=modify&num=<?=$num?>&national="+fr.value;
   } else {
	location.href = "?<?=$_get_param[3]?>&mode=new&national="+fr.value;
   }
  }
}

/*

function change2(fr) {
  if (fr.value == "") {    
  }
  else  {
   if  ("<?=$mode?>" == "modify") {    
	location.href = "?<?=$_get_param[3]?>&mode=modify&num=<?=$num?>&national=<?=$national?>&k_no="+fr.value+"&d_no=<?=$d_no?>";
   } else {
	location.href = "?<?=$_get_param[3]?>&mode=new&num=<?=$national?>&k_no="+fr.value+"&d_no=<?=$d_no?>";
   }

  }

}



function change3(fr) {
  if (fr.value == "") {    
  }
  else  {
   if  ("<?=$mode?>" == "modify") {    
	location.href = "?<?=$_get_param[3]?>&mode=modify&num=<?=$num?>&national=<?=$national?>&k_no=<?=$k_no?>&d_no="+fr.value;
   } else {
	location.href = "?<?=$_get_param[3]?>&mode=new&num=<?=$national?>&k_no=<?=$k_no?>&d_no="+fr.value;
   }

  }

}

*/


//-->
</script>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>

<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>�б�����</b></font></td>
  </tr>
</table>
<form name="school_form" method="post" action="?<?=$_get_param[3]?>" Onsubmit="return(chk());" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="num" value="<?=$num?>" />
<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title"><b>�б����� <? if($mode=='modify') { ?>����<?}else{?>���<? } ?></td>
   </tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="800" align=center bgcolor="#FFFFFF">
    <tr>  
     <td>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 
  </table>

<table border="0" cellpadding="0" cellspacing="0" width="770" align="center">
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr> 
  <tr>
    <td width="130" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�б�����ó</td>
	<td width="365" bgcolor="#FFFFFF" ><input name="office_tel" type="text" value="<?=$data['office_tel']?>" class="cc" size=15></td>
	<td width="130" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�̸���</td>
	<td width="365" bgcolor="#FFFFFF" ><input name="msn" type="text" value="<?=$data['msn']?>" class="cc" size=40></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">Ư�̻��� <input type="checkbox" name="check" value="1" <? if($data[check] == "1") {echo "checked";} ?>></td>
	<td bgcolor="#FFFFFF" colspan="3"><textarea name="admin_memo"  style="width:98%;"  rows=4  class="cc"><?if(!$data['admin_memo']){?>�����ڸ޸�<?}?><?=$data['admin_memo']?></textarea></td>
  </tr>	
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>��õ�б�</strong></td>
	<td bgcolor="#FFFFFF" colspan="2" class="a_s_text_title"><input type="checkbox" name="best" value="1" <? if($data[best] == "1") {echo "checked";} ?>>&nbsp;��õ�б��� ��� üũ�ϼ���</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>  
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>����</strong></td>
	<td bgcolor="#FFFFFF" ><select name="national" class="input" id="national" onchange="change(this);" class="select">
         <?=rg_html_option($_const['national'],$national)?>
       </select>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>����</strong></td>
	<td bgcolor="#FFFFFF"><select name="area" class="select2">
        <?=rg_html_option($ss_list,$data['area'])?>
        </select>
	</td>
   </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>  
  <tr>
	<td height="8" colspan="4"></td>
  </tr>
<tr >
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>�ΰ�</strong></td>
	<td colspan="3"> <?if($data[school_file1_name]){?>
			  <img src=../data/camp/<?=$num?>/<?=$data[school_file1_name]?> width="80" height="30" align="absmiddle">
			  <?}?> 			  
			  <input name='school_file1' type=file class=cc style='width:40%;'>   &nbsp;&nbsp;                         
						 <?if($data[school_file1_name]){?>
						 <input name='del_file1' type=checkbox id="del_file1" value='1'>���� 
                          <?}?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr >
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>�ְ�/����</strong></td>
	<td colspan="3"><input name="s_title" type="text" value="<?=$data['s_title']?>" class="cc" size=10> (<input name="title" type="text" value="<?=$data['title']?>" class="cc" size=60>)</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>

<?if($national == 3){?>

  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>1.ķ������</strong> <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_0.display='none';" onclick="dnum(0);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
   <tr id="dismenu_0" style="DISPLAY: none;" >
	<td colspan="4" >
  <table width="100%" cellpadding="0" cellspacing="0">    
   
   <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>ķ������</strong></td>
	<td bgcolor="#FFFFFF"><select name="section"  class="select3">
        <?=rg_html_option($_const[camp_type],$data[section])?>
       </select>
    </td>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>Ȩ������</strong></td>
	<td >http://<input name="homepage" type="text" value="<?=$data['homepage']?>" class="cc" size=40></td>
  </tr> 

  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>   

  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>����/����Ʈ��ġ</strong></td>
	<td colspan="3"><input name="location" type="text" value="<?=$data['location']?>" class="cc" size=90></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>	
  <tr>
	<td width="130" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>����ܼ���</strong></td>
	<td colspan="3"><input name="eng_etc" type="text" value="<?=$data['eng_etc']?>" class="cc" size=90></td>
  </tr>	
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>�δ�ü�</strong></td>
	<td colspan="3"><input name="etc_facility" type="text" value="<?=$data['etc_facility']?>" class="cc" size=90></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>�ָ���Ƽ��Ƽ</strong></td>
	<td colspan="3"><input name="activity" type="text" value="<?=$data['activity']?>" class="cc" size=90></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>	
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>������</strong></td>
	<td colspan="3"><input name="movielink" type="text" value="<?=$data['movielink']?>" class="cc" size=80></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>	
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>2.ķ���䰭</strong> <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_1.display='none';" onclick="dnum(1);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4" id="dismenu_1" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4"><input type="hidden" name="info"><iframe src="camp_editor02.php?num=<?=$num?>&control=info" width="100%" height="510" frameborder=0 border=0 scrolling=no name="info_frm"></iframe></td>
	</tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>3.����Ư¡/TIP</strong> <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_2.display='none';" onclick="dnum(2);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4" id="dismenu_2" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">   
  <tr>
	<td colspan="4"><input type="hidden" name="special"><iframe src="camp_editor02.php?num=<?=$num?>&control=special" width="100%" height="510" frameborder=0 border=0 scrolling=no name="special_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>4.�������� �� �����α׷�</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_3.display='none';" onclick="dnum(3);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>  
  <tr>
	<td colspan="4" id="dismenu_3" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4"><input type="hidden" name="program"><iframe src="camp_editor02.php?num=<?=$num?>&control=program" width="100%" height="510" frameborder=0 border=0 scrolling=no name="program_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>	
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>5.Activity�Ұ�</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_4.display='none';" onclick="dnum(4);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
 <tr>
	<td colspan="4" id="dismenu_4" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4"><input type="hidden" name="activity_info"><iframe src="camp_editor02.php?num=<?=$num?>&control=activity_info" width="100%" height="510" frameborder=0 border=0 scrolling=no name="activity_info_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>6.������� �󼼾ȳ�</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_5.display='none';" onclick="dnum(5);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
 <tr>
	<td colspan="4" id="dismenu_5" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4"><input type="hidden" name="cost_info"><iframe src="camp_editor02.php?num=<?=$num?>&control=cost_info" width="100%" height="510" frameborder=0 border=0 scrolling=no name="cost_info_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>

  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>7.�̹���</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_6.display='none';" onclick="dnum(6);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
 <tr>
	<td colspan="4" id="dismenu_6" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
<? for ($i=2; $i<=9; $i++){?>
   <tr>
    <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>�̹���<?=$i-1?></strong></td>
	<td colspan="4" class="a_s_text_title">	<input name='school_file<?=$i?>' type=file class=cc style='width:40%;'>   &nbsp;&nbsp;                     
						 <?if($data[school_file.$i._name]){?>
                         <img src="../data/camp/<?=$num?>/<?=$data[school_file.$i._name]?>" width="60" height="40" align="absmiddle"> <input name='del_file<?=$i?>' type=checkbox id="del_file<?=$i?>" value='1'>���� 
                          <?}?>
	</td>
  </tr>
<?}?>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>

</table>
</td>
</tr>

<?}else{?>
   <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>ķ������</strong></td>
	<td bgcolor="#FFFFFF" colspan="3" ><select name="section"  class="select3">
        <?=rg_html_option($_const[camp_type],$data[section])?>
       </select>
    </td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
<tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>�����䰭</strong> <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_0.display='none';" onclick="dnum(0);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
   <tr id="dismenu_0" style="DISPLAY: none;" >
	<td colspan="4" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4"><input type="hidden" name="info"><iframe src="school_editor02.php?num=<?=$num?>&control=info" width="100%" height="510" frameborder=0 border=0 scrolling=no name="info_frm"></iframe></td>
	</tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>1.���Լ���</strong> <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_1.display='none';" onclick="dnum(1);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4" id="dismenu_1" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4"><input type="hidden" name="program"><iframe src="camp_editor02.php?num=<?=$num?>&control=program" width="100%" height="510" frameborder=0 border=0 scrolling=no name="program_frm"></iframe></td>
	</tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>2.����� ���α׷�</strong> <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_2.display='none';" onclick="dnum(2);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4" id="dismenu_2" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">   
  <tr>
	<td colspan="4"><input type="hidden" name="after_info"><iframe src="camp_editor02.php?num=<?=$num?>&control=after_info" width="100%" height="510" frameborder=0 border=0 scrolling=no name="after_info_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>3.�ָ� ���α׷�</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_3.display='none';" onclick="dnum(3);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>  
  <tr>
	<td colspan="4" id="dismenu_3" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4"><input type="hidden" name="wk_pro"><iframe src="camp_editor02.php?num=<?=$num?>&control=wk_pro" width="100%" height="510" frameborder=0 border=0 scrolling=no name="wk_pro_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>	
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>4.��ü�����ȳ�</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_4.display='none';" onclick="dnum(4);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
 <tr>
	<td colspan="4" id="dismenu_4" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4"><input type="hidden" name="schedule"><iframe src="camp_editor02.php?num=<?=$num?>&control=schedule" width="100%" height="510" frameborder=0 border=0 scrolling=no name="schedule_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>5.ķ�� �б� �ȳ�</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_5.display='none';" onclick="dnum(5);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
 <tr>
	<td colspan="4" id="dismenu_5" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4"><input type="hidden" name="camp_school"><iframe src="camp_editor02.php?num=<?=$num?>&control=camp_school" width="100%" height="510" frameborder=0 border=0 scrolling=no name="camp_school_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>6.Ȩ������ ��Ȱ����</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_6.display='none';" onclick="dnum(6);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
 <tr>
	<td colspan="4" id="dismenu_6" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4"><input type="hidden" name="homestay"><iframe src="camp_editor02.php?num=<?=$num?>&control=homestay" width="100%" height="510" frameborder=0 border=0 scrolling=no name="homestay_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>   
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>7.��������-��Ŭ���� ����</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_7.display='none';" onclick="dnum(7);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
 <tr>
	<td colspan="4" id="dismenu_7" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4"><input type="hidden" name="national_info"><iframe src="camp_editor02.php?num=<?=$num?>&control=national_info" width="100%" height="510" frameborder=0 border=0 scrolling=no name="national_info_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>8.ķ�� ���α׷� Q & A</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_8.display='none';" onclick="dnum(8);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
 <tr>
	<td colspan="4" id="dismenu_8" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4"><input type="hidden" name="camp_qna"><iframe src="camp_editor02.php?num=<?=$num?>&control=camp_qna" width="100%" height="510" frameborder=0 border=0 scrolling=no name="camp_qna_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
<?}?>
        
</table>
  <table border="0" cellpadding="0" cellspacing="0" width="800" align=center>
	<tr>
		<td bgcolor="#FFFFFF" height="8"></td>
	</tr> 	
	<tr>
		<td bgcolor="#666666" height="2"></td>
	</tr> 
  </table>

  </td>
  </tr>
</table>
<br>
<table width="200" border="0"  align=center>
	<tr>
		<td width="100" align="center"><INPUT onfocus=this.blur() type=image src="images/bt_write.gif"></td>
		<td width="100" align="center"><img src="images/bt_list2.gif" onClick="history.back();" style="hand:cursor"></td>
	</tr>
</table>
</form>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>