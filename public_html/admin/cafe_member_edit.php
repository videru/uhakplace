<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
	if ($national=="1") {
     $ss_list = $_const['area1']; // 독일지역
    }elseif($national=="2") {
     $ss_list = $_const['area2']; // 몰타지역
	}elseif($national=="3") {
     $ss_list = $_const['area3']; //미국지역
    }elseif($national=="4") {
     $ss_list = $_const['area4']; // 영국지역
    }elseif($national=="5") {
     $ss_list = $_const['area5']; // 일본지역
	}


	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table(	$_table['cafe_member']);
		$rs->add_where("num=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // 정보가 올바르지 않다면
			rg_href('','정보를 찾을수 없습니다.','back');
		}
		$data=$rs->fetch();		

	} else {
		$data=$rs->fetch();		
	}



	// 학교 삭제
	if($mode=='delete') {	
		$rs->clear();
		$rs->set_table($_table['cafe_member']);
		$rs->add_where("num=$num");
		$rs->delete();
		
		$rs->commit();
		rg_href("cafe_member_list.php?$_get_param[3]");
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {

     		$rs->clear();
	    	$rs->set_table($_table['cafe_member']);
	    	$rs->add_field("consult","$consult");	
	    	$rs->add_field("name","$name");	          
	    	$rs->add_field("nick","$nick");	           
	    	$rs->add_field("root","$root");	
	    	$rs->add_field("tel1","$tel1");	  
		   	$rs->add_field("tel2","$tel2");	  
		   	$rs->add_field("tel3","$tel3");		
		    $rs->add_field("et_tel1","$et_tel1");	
		    $rs->add_field("et_tel2","$et_tel2");	
		    $rs->add_field("et_tel3","$et_tel3");			
	    	$rs->add_field("email","$email");	          
	    	$rs->add_field("msn","$msn");	          
	    	$rs->add_field("national","$national");	     
	    	$rs->add_field("area","$area");	  
	    	$rs->add_field("addr","$addr");	
	    	$rs->add_field("abroad_date","$abroad_date");	           
	    	$rs->add_field("etc","$etc");	
 	    	$rs->add_field("regi_state","$regi_state");	  
 	    	$rs->add_field("rate","$rate");	  
		if($mode=='modify') {
			$rs->add_where("num=$num");
			$rs->update();
		} else {
			$rs->add_field("regi_date",time());	
			$rs->insert();
			$num=$rs->get_insert_id();		
		}
	     	$rs->commit();	


       if($regi_state ==2){

        $regi_date1= date("Y", $regi_date);
        $regi_date2 = date("m", $regi_date);
        $regi_date3 = date("d", $regi_date);

        $abroad_date1= date("Y");
        $abroad_date2 = date("m");
        $abroad_date3 = date("d");

        $abroad_date= $abroad_date1."-".$abroad_date2."-".$abroad_date3 ;


        $tel1 = $_const[tel][$tel1];
		$tel = $tel1."-".$tel2."-".$tel3;


     		$rs->clear();
	    	$rs->set_table($_table['regi']);
			$rs->add_field("student_name","$name");		
			$rs->add_field("chain","1");		
			$rs->add_field("consult","$consult");	
	    	$rs->add_field("regi_date1","$regi_date1");
	    	$rs->add_field("regi_date2","$regi_date2");
 	    	$rs->add_field("regi_date3","$regi_date3");
	    	$rs->add_field("abroad_date","$abroad_date");
	    	$rs->add_field("abroad_date1","$abroad_date1");
	    	$rs->add_field("abroad_date2","$abroad_date2");	
	    	$rs->add_field("abroad_date3","$abroad_date3");				
	    	$rs->add_field("national","$national");	
	    	$rs->add_field("rgi_type","1");		
	    	$rs->add_field("email","$email");		
	    	$rs->add_field("tel","$tel");
		    $rs->add_field("et_tel1","$et_tel1");	
		    $rs->add_field("et_tel2","$et_tel2");	
		    $rs->add_field("et_tel3","$et_tel3");	
	    	$rs->add_field("etc","$etc");	
	    	$rs->add_field("process_state","1");	
	    	$rs->add_field("rgi_type","$root");	

			$rs->insert();
            $regi_num=$rs->get_insert_id();		
	     	$rs->commit();	

        	$rs->clear();
	    	$rs->set_table($_table['ca_mem_comm']);
	    	$rs->add_field("cmt_regi_num","$regi_num");	
			$rs->add_where("cmt_num='$num'");
			$rs->update();        


/*

	    $rs_jlist = new $rs_class($dbcon);
		$rs_jlist->clear();
		$rs_jlist->set_table(	$_table['school']);
		$rs_jlist->add_where("num=$school_name_no");
		$rs_jlist->select();

	   $SC_gigan=$rs_jlist->fetch();

            $total_gigan =  $SC_gigan[total_gigan] + 1;

			$rs->clear();
	    	$rs->set_table($_table['school']);
			$rs->add_field("total_gigan","$total_gigan");	

			$rs->add_where("num=$SC_gigan[num]");
			$rs->update();
	     	$rs->commit();	
*/
	   rg_href("regi_list.php");

	   }

		rg_href("cafe_member_list.php?$_get_param[3]");
	}

   $MENU_L='m5';


?>
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

//-->
</script>
<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>상담관리</b></font></td>
  </tr>
</table>
<form name="regi_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="num" value="<?=$num?>" />
<input type="hidden" name="pp" value="<?=$pp?>" />
<input type="hidden" name="regi_date" value="<?=$data[regi_date]?>" />
<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title">상담관리<? if($mode=='modify') { ?>수정<?}else{?>등록<? } ?></td>
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
<table border="0" cellpadding="0" cellspacing="0" width="770" align="center" >
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">등록일</td>
		<td colspan="2"><?=rg_date($data[regi_date])?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	   
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">국가</td>
		<td colspan="2"><select name="national" class="select2" onchange="change(this);" class="select">
<?=rg_html_option($_const['national'],$national)?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">지역</td>
		<td colspan="2"><select name="area" class="select2">
<?=rg_html_option($ss_list,$data['area'])?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td width="110" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">수속담당자</td>
		<td colspan="2"><select name="consult" class="select">
         <?       
	    $rs_list = new $rs_class($dbcon);
	    $rs_list->clear();
	    $rs_list->set_table($_table['member']);
        $rs_list->add_where("mb_id != 'webadmin'");	
        $rs_list->add_where("mb_level >= 90");	
	    while($RV=$rs_list->fetch()) {

		?>
	<option value="<?=$RV[mb_num]?>" <?if ($RV[mb_num]==$data['consult']) { ?>selected<?}?>><?=$RV[mb_name]?></option>  <?  } ?> 
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td width="110" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">이름</td>
		<td colspan="2"><input name="name" type="text" value="<?=$data['name']?>" class="cc" size=10> (닉네임: <input name="nick" type="text" value="<?=$data['nick']?>" class="cc" size=10>)</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>		
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">경로</td>
		<td colspan="2"><select name="root" class="select2">
<?=rg_html_option($_const['root'],$data['root'])?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">핸드폰</td>
		<td colspan="2"><select name="tel1" class="select3">
<?=rg_html_option($_const['tel'],$data['tel1'])?>
		</select>-<input name="tel2" type="text" value="<?=$data['tel2']?>" class="cc" size=4>-<input name="tel3" type="text" value="<?=$data['tel3']?>" class="cc" size=4> (기타연락처: <input name="et_tel1" type="text" value="<?=$data['et_tel1']?>" class="cc" size=4>-<input name="et_tel2" type="text" value="<?=$data['et_tel2']?>" class="cc" size=4>-<input name="et_tel3" type="text" value="<?=$data['et_tel3']?>" class="cc" size=4></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>		
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">이메일</td>
		<td colspan="2"><input name="email" type="text" value="<?=$data['email']?>" class="cc" size=33></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">메신저</td>
		<td colspan="2"><input name="msn" type="text" value="<?=$data['msn']?>" class="cc" size=33></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">사는지역</td>
		<td colspan="2"><input name="addr" type="text" value="<?=$data['addr']?>" class="cc" size=33></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">출국예정일</td>
		<td colspan="2"><input name="abroad_date" type="text" value="<?=$data['abroad_date']?>" class="cc" size=33></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">궁금한점</td>
		<td colspan="2"><textarea rows="4" name="etc" class=textarea style='width:97%'  style='border-width:1; border-color:rgb(200,200,200); border-style:solid;'><?=$data['etc']?></textarea></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">진행상황</td>
		<td colspan="2"><select name="regi_state" class="select3">
<?=rg_html_option($_reserv['regi_state'],$data['regi_state'])?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">수속확률</td>
		<td colspan="2"><select name="rate" class="select3">
<?=rg_html_option($_const[rate],$data['rate'])?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="3"></td>
    </tr>	
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
		<td width="100" align="center"><a href="./cafe_member_list.php?page=<?=$page?>"><img src="images/bt_list2.gif" border="0"></a></td>
	</tr>
</table>
</form>
<br>
 <?if($mode=='modify'){?>
<table width=800 border=1 align="center" cellpadding=0 cellspacing=0 bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr>
     <td colspan="2" bgcolor="#F7F7F7"><div align="center">학생관리</div></td>
   </tr>
 <?
	    $rs_comment = new $rs_class($dbcon);
	    $rs_comment->clear();
	    $rs_comment->set_table($_table['ca_mem_comm']);
        $rs_comment->add_where("cmt_num = '$num'");	
		$rs_comment->add_order("num DESC");
	    while($cdata=$rs_comment->fetch()) {		
		$cmt_reg_date = rg_date($cdata[cmt_reg_date]);		
?> <tr> 
        <td width="19%" bgcolor="#FFFFFF" class=bbs style='padding:3px; padding-left:10px; padding-right:10px;'> 
          [<?=$cmt_reg_date?>]<br>
          <?=$cdata[cmt_name]?>
          </td>
        <td bgcolor="#FFFFFF" class=bbs style='padding:3px; padding-left:10px; padding-right:10px;'>
          <?=$cdata[cmt_comment]?> &nbsp;&nbsp; 
		  <a href="./ca_mem_comm_edit.php?&page_no=<?=$page?>&mode=delete&num=<?=$cdata[num]?>&cmt_num=<?=$num?>&national=<?=$national?>"><img src="./images/c_del.gif" alt="삭제" border="0"></a> <br> <div align="right"></div></td>
      </tr> <? }?>
    </table>
   <table width=800 border=1 align="center" cellpadding=0 cellspacing=0 bordercolorlight="#E1E1E1" bordercolordark="white">
<form name=form_comment method=post action='ca_mem_comm_edit.php' autocomplete=off>
<input type=hidden name=cmt_num value='<?=$num?>'>
<input type=hidden name=cmt_name value='<?=$_mb[mb_name]?>'>
<input type=hidden name=page_no value='<?=$page?>'>
<input type=hidden name=national value='<?=$national?>'>
          <tr>             
          <td bgcolor="#FFFFFF" align="center"><textarea rows=2 name=cmt_comment class=textarea style='width:97%' required itemname='코멘트내용' style='border-width:1; border-color:rgb(136,136,136); border-style:solid;'></textarea>
           </td>
            <td width="80" height="100%" bgcolor="#FFFFFF"><input type=submit value='  입 력  ' style="font-style:normal; font-size:12px; color:white; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid; height:100%;width:100%"></td></tr> 
         </form>
	    </table>  					
    </tr>
    </table>
<?}?>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>