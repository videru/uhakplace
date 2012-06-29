<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");
	
  	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table(	$_table['consult']);
		$rs->add_where("num=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // 정보가 올바르지 않다면
			rg_href('','정보를 찾을수 없습니다.','back');
		}
		$data=$rs->fetch();		

	} else {
		$data=$rs->fetch();		

	}

		// 상담 삭제
	if($mode=='delete') {	
		$rs->clear();
		$rs->set_table($_table['consult']);
		$rs->add_where("num=$num");
		$rs->delete();
		
		$rs->commit();
		rg_href("consult_list.php?$_get_param[3]");
	}


   if($process2 ==2) {

		$rs->clear();
	   	$rs->set_table($_table['consult']);	
		$rs->add_field("process2","2");		
		$rs->add_where("num=$num");
		$rs->update();




     	$rs->clear();
	   	$rs->set_table($_table['cafe_member']);
	   	$rs->add_field("name","$name");   
    	$rs->add_field("root","$root");	
    	$rs->add_field("tel1","$tel1");	  
	   	$rs->add_field("tel2","$tel2");	  
	   	$rs->add_field("tel3","$tel3");			
    	$rs->add_field("email","$email");
    	$rs->add_field("etc","$etc");	
     	$rs->add_field("regi_state","1");	   
		$rs->add_field("regi_date",time());	
		$rs->insert();	

	   	$rs->commit();	

		rg_href("consult_list.php?$_get_param[3]");	
   }
	
?>
<? include("_header.php"); ?>
<table border="0" cellspacing="0" cellpadding="0" width="300" align="center">
   <tr>
     <td style="padding: 5px 5px 5px 5px"><?=$data['etc_memo']?></td>
   </tr>
</table>
<? include("_footer.php"); ?>