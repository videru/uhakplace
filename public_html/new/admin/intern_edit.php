<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
	if ($national=="") {
		$national="3";
	}

	if ($national=="1") {
     $ss_list = $_const['area1']; // 뉴질랜드지역
    }elseif($national=="2") {
     $ss_list = $_const['area2']; // 호주지역
	}elseif($national=="3") {
     $ss_list = $_const['area3']; //필리핀지역
    }elseif($national=="4") {
     $ss_list = $_const['area4']; // 영국지역
    }

	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table($_table['intern']);
		$rs->add_where("num=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // 정보가 올바르지 않다면
			rg_href('','정보를 찾을수 없습니다.','back');
		}
		$data=$rs->fetch();		
	
	} else {
		$data=$rs->fetch();	
	}

   // 삭제
	if($mode=='delete') {	
		
		// 학교 삭제
		$rs->clear();
		$rs->set_table($_table['intern']);
		$rs->add_where("num=$num");
		$rs->delete();		
		$rs->commit();
		rg_href("young_list.php?$_get_param[3]");
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {

			$rs->clear();
	    	$rs->set_table($_table['intern']);	
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
			$rs->add_field("gigan","$gigan");	
			$rs->add_field("start_date","$start_date");				
			$rs->add_field("end_date","$end_date");			    
			$rs->add_field("cost","$cost");	
			$rs->add_field("promotion","$promotion");				
			$rs->add_field("intro","$intro");		
  			$rs->add_field("info","$info");		 
		
		if($mode=='modify') {
			$rs->add_where("num=$num");
			$rs->update();
		} else {
			$rs->insert();
			$num=$rs->get_insert_id();		
		}
	
       // 파일 업로드

        @mkdir("../data/intern/".$num."/", 0707);
        @chmod("../data/intern/".$num."/", 0707);   
	   
	     $school_path="../data/intern/".$num."/";

	    for($fi=1;$fi<42;$fi++) {
		if(${"del_file{$fi}"}) {
			@unlink($school_path.${"school_file{$fi}_name"});
			${"school_file{$fi}_name"} = '';
	
		 $rs->clear();
			$rs->set_table($_table['intern']);
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
			$rs->set_table($_table['intern']);
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

			$rs->add_where("num=$num");
			$rs->update();
				  
	
		
		$rs->commit();	
	
	
	
		rg_href("intern_list.php?$_get_param[3]");	
	
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
		alert("국가를 선택해 주세요");
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
		alert("분류를 선택해 주세요");
		f.nation.focus();
		return false;
	  }
/*
	if(f.category.value == "")
	{
		alert("분류를 선택해 주세요");
		f.category.focus();
		return false;
	}
*/

	if(f.title.value == "")
	{
		alert("학교명이 비었습니다.");
		f.title.focus();
		return false;
	}
/*
	if(f.city.value == "")
	{
		alert("도시가 비었습니다.");
		f.city.focus();
		return false;
	}
*/

	f.info.value      = document.info_frm.myeditor.outputBodyHTML();	
/*	
	if(f.national.value == "3")
	{
	f.program.value   = document.program_frm.myeditor.outputBodyHTML();		
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
*/
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
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>학교관리</b></font></td>
  </tr>
</table>
<form name="school_form" method="post" action="?<?=$_get_param[3]?>" Onsubmit="return(chk());" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="num" value="<?=$num?>" />
<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title"><b>학교정보 <? if($mode=='modify') { ?>수정<?}else{?>등록<? } ?></td>
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
    <td width="130" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">학교연락처</td>
	<td width="365" bgcolor="#FFFFFF" ><input name="office_tel" type="text" value="<?=$data['office_tel']?>" class="cc" size=15></td>
	<td width="130" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">이메일</td>
	<td width="365" bgcolor="#FFFFFF" ><input name="msn" type="text" value="<?=$data['msn']?>" class="cc" size=40></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">특이사항 <input type="checkbox" name="check" value="1" <? if($data[check] == "1") {echo "checked";} ?>></td>
	<td bgcolor="#FFFFFF" colspan="3"><textarea name="admin_memo"  style="width:98%;"  rows=4  class="cc"><?if(!$data['admin_memo']){?>관리자메모<?}?><?=$data['admin_memo']?></textarea></td>
  </tr>	
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>추천학교</strong></td>
	<td bgcolor="#FFFFFF" colspan="2" class="a_s_text_title"><input type="checkbox" name="best" value="1" <? if($data[best] == "1") {echo "checked";} ?>>&nbsp;추천학교일 경우 체크하세요</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>  
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>나라</strong></td>
	<td bgcolor="#FFFFFF" ><select name="national" class="input" id="national" onchange="change(this);" class="select">
         <?=rg_html_option($_const['national'],$national)?>
       </select>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>지역</strong></td>
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
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>로고</strong></td>
	<td colspan="3"> <?if($data[school_file1_name]){?>
			  <img src=../data/intern/<?=$num?>/<?=$data[school_file1_name]?> width="80" height="30" align="absmiddle">
			  <?}?> 			  
			  <input name='school_file1' type=file class=cc style='width:40%;'>   &nbsp;&nbsp;                         
						 <?if($data[school_file1_name]){?>
						 <input name='del_file1' type=checkbox id="del_file1" value='1'>삭제 
                          <?}?></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr >
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>교육기관</strong></td>
	<td colspan="3"><input name="s_title" type="text" value="<?=$data['s_title']?>" class="cc" size=10> (<input name="title" type="text" value="<?=$data['title']?>" class="cc" size=60>)</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
   <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>연수기간</strong></td>
	<td colspan="3"><input name="gigan" type="text" value="<?=$data['gigan']?>" class="cc" size=40></td>
  </tr> 
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>  
   <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>출발일</strong></td>
	<td colspan="3"><input name="start_date" type="text" value="<?=$data['start_date']?>" class="cc" size=90></td>
  </tr> 
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>  
    <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>마감일</strong></td>
	<td colspan="3"><input name="end_date" type="text" value="<?=$data['end_date']?>" class="cc" size=90></td>
  </tr> 
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>  
    <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>비용</strong></td>
	<td colspan="3"><input name="cost" type="text" value="<?=$data['cost']?>" class="cc" size=90></td>
  </tr> 
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr> 
     <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>등록혜택</strong><br>(프로모션)</td>
	<td colspan="3"><input name="promotion" type="text" value="<?=$data['promotion']?>" class="cc" size=90></td>
  </tr> 
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr> 
     <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>개요</strong><br></td>
	<td colspan="3"><input name="intro" type="text" value="<?=$data['intro']?>" class="cc" size=90></td>
  </tr> 
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>   
  <tr>
	<td colspan="4"><input type="hidden" name="info"><iframe src="intern_editor02.php?num=<?=$num?>&control=info" width="100%" height="510" frameborder=0 border=0 scrolling=no name="info_frm"></iframe></td>
	</tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
<? for ($i=2; $i<=5; $i++){?>
   <tr>
    <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>이미지<?=$i-1?></strong></td>
	<td colspan="4" class="a_s_text_title">	<input name='school_file<?=$i?>' type=file class=cc style='width:40%;'>   &nbsp;&nbsp;                     
						 <?if($data[school_file.$i._name]){?>
                         <img src="../data/intern/<?=$num?>/<?=$data[school_file.$i._name]?>" width="60" height="40" align="absmiddle"> <input name='del_file<?=$i?>' type=checkbox id="del_file<?=$i?>" value='1'>삭제 
                          <?}?>
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