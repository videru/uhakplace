<?

	include_once("../include/lib.php");
	require_once("admin_chk.php");

	if($mode=='modify' || $mode=='delete') {
		$rs->clear();
		$rs->set_table(	$_table['regi']);
		$rs->add_where("regi_no=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // ������ �ùٸ��� �ʴٸ�
			rg_href('','������ ã���� �����ϴ�.','back');
		}
		$data=$rs->fetch();		

	$rs_ac = new $rs_class($dbcon);
	$rs_ac->clear();
	$rs_ac->set_table($_table['regi_account']);
	$rs_ac->add_where("stu_no=$num");
	$rs_ac->select();	
	$data_ac=$rs_ac->fetch();		
	} else {
		$data=$rs->fetch();
	}
	
	// �б� ����
	if($mode=='delete') {	
	
		
	 $rs_sc = new $rs_class($dbcon);
	$rs_sc->clear();
	$rs_sc->set_table($_table['regi']);
	$rs_sc->add_where("regi_no=$num");
	$rs_sc->select();	
	$data_sc=$rs_sc->fetch();		

		
		$rs->clear();
		$rs->set_table($_table['regi']);
		$rs->add_where("regi_no=$num");
		$rs->delete();
		
		$rs->commit();

		$rs->clear();
		$rs->set_table($_table['regi_account']);
		$rs->add_where("stu_no=$num");
		$rs->delete();
		
		$rs->commit();


	    $rs_jlist = new $rs_class($dbcon);
		$rs_jlist->clear();
		$rs_jlist->set_table(	$_table['school']);
		$rs_jlist->add_where("num=$data_sc[school_name_no]");
		$rs_jlist->select();

	   $SC_gigan=$rs_jlist->fetch();


            $total_gigan =  $SC_gigan[total_gigan] - 1;

			$rs->clear();
	    	$rs->set_table($_table['school']);
			$rs->add_field("total_gigan","$total_gigan");	

			$rs->add_where("num=$SC_gigan[num]");
			$rs->update();
	     	$rs->commit();	


		rg_href("regi_list.php?$_get_param[3]");
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {     	
	
			
    if($abroad_date){
	$ab_date=explode("-",$abroad_date);		
	$abroad_date1 =$ab_date[0];
	$abroad_date2 =$ab_date[1];
	$abroad_date3 =$ab_date[2];
    }

    if($open_date){
	$op_date=explode("-",$open_date);	
	$op_date1 =$op_date[0];
	$op_date2 =$op_date[1];
	$op_date3 =$op_date[2];

    $open_date1 = mktime(0,0,0,$op_date2,$op_date3,$op_date1);
    $end_date1 = mktime(0,0,0,$op_date2,$op_date3+($study_gigan*7),$op_date1);
	}

    if($open_date2){
	$op_date2=explode("-",$open_date2);	
	$op_date21 =$op_date2[0];
	$op_date22 =$op_date2[1];
	$op_date23 =$op_date2[2];

    $open_date21 = mktime(00,00,00,$op_date22,$op_date23,$op_date21);
    $end_date21 = mktime(00,00,00,$op_date22,$op_date23+($study_gigan2*7),$op_date21);
	}

    if($regi_date){
	$rg_date=explode("-",$regi_date);		
	$regi_date1 =$rg_date[0];
	$regi_date2 =$rg_date[1];
	$regi_date3 =$rg_date[2];
    }

    if($airpoet_date){
	$air_date=explode("-",$airpoet_date);		
	$airpoet_date1 =$air_date[0];
	$airpoet_date2 =$air_date[1];
	$airpoet_date3 =$air_date[2];

	$airpoet_date_int = mktime(0,0,0,$airpoet_date2,$airpoet_date3,$airpoet_date1);
    }
			$rs->clear();
	    	$rs->set_table($_table['regi']);
			$rs->add_field("open_date","$open_date");	
			$rs->add_field("open_date1","$open_date1");					
			$rs->add_field("end_date1","$end_date1");	
			$rs->add_field("open_date2","$open_date2");	
			$rs->add_field("open_date21","$open_date21");					
			$rs->add_field("end_date21","$end_date21");	
			$rs->add_field("student_name","$student_name");	
			$rs->add_field("student_ename","$student_ename");					
			$rs->add_field("chain","$chain");		
			$rs->add_field("consult","$consult");	
	    	$rs->add_field("regi_date","$regi_date");
	    	$rs->add_field("regi_date1","$regi_date1");
	    	$rs->add_field("regi_date2","$regi_date2");
 	    	$rs->add_field("regi_date3","$regi_date3");
	    	$rs->add_field("abroad_date","$abroad_date");
	    	$rs->add_field("abroad_date1","$abroad_date1");
	    	$rs->add_field("abroad_date2","$abroad_date2");
	    	$rs->add_field("abroad_date3","$abroad_date3");
	    	$rs->add_field("airpoet_date","$airpoet_date");
	    	$rs->add_field("airpoet_date1","$airpoet_date1");
	    	$rs->add_field("airpoet_date2","$airpoet_date2");	
	    	$rs->add_field("airpoet_date3","$airpoet_date3");	
	    	$rs->add_field("airpoet_date_int","$airpoet_date_int");						
	    	$rs->add_field("national","$national");	
	    	$rs->add_field("national2_check","$national2_check");
	    	$rs->add_field("national2","$national2");
	    	$rs->add_field("school_name","$school_name");	
	    	$rs->add_field("school_name_no","$school_name_no");
	    	$rs->add_field("school_name2","$school_name2");	
	    	$rs->add_field("study_gigan","$study_gigan");	
	    	$rs->add_field("study_gigan2","$study_gigan2");	
		   	$rs->add_field("passport","$passport");
	    	$rs->add_field("passport_check","$passport_check");	
	    	$rs->add_field("passport_no","$passport_no");	
			$rs->add_field("regi_cost","$regi_cost");
	    	$rs->add_field("regi_cost_check","$regi_cost_check");	
			$rs->add_field("school_regi","$school_regi");
	    	$rs->add_field("school_regi_check","$school_regi_check");					
	    	$rs->add_field("air_reserve","$air_reserve");	
	    	$rs->add_field("air_reserve_check","$air_reserve_check");
	    	$rs->add_field("air_paid","$air_paid");		
	    	$rs->add_field("air_paid_check","$air_paid_check");
	    	$rs->add_field("air_ticket","$air_ticket");
	    	$rs->add_field("air_ticket_check","$air_ticket_check");
	    	$rs->add_field("insu","$insu");
	    	$rs->add_field("insu_check","$insu_check");
			$rs->add_field("cost_paid","$cost_paid");	
	    	$rs->add_field("cost_paid_check","$cost_paid_check");			
			$rs->add_field("abroad_ot","$abroad_ot");
	    	$rs->add_field("abroad_ot_check","$abroad_ot_check");
	    	$rs->add_field("abroad","$abroad");	
	    	$rs->add_field("abroad_check","$abroad_check");				
	    	$rs->add_field("dormi","$dormi");
	    	$rs->add_field("dormi_check","$dormi_check");
	    	$rs->add_field("pickup","$pickup");
	    	$rs->add_field("pickup_check","$pickup_check");
	    	$rs->add_field("mb_id","$mb_id");	
	    	$rs->add_field("email","$email");		
	    	$rs->add_field("tel","$tel");	
	    	$rs->add_field("etc","$etc");	
	    	$rs->add_field("process_state","$process_state");	
	    	$rs->add_field("rgi_type","$rgi_type");	
	    	$rs->add_field("cost_bank_check","$cost_bank_check");	
	    	$rs->add_field("cost_bank","$cost_bank");	
	    	$rs->add_field("insen_check","$insen_check");	
	    	$rs->add_field("insen_year","$insen_year");	
	    	$rs->add_field("insen_mon","$insen_mon");	

		if($mode=='modify') {
			$rs->add_where("regi_no=$num");
			$rs->update();
		} else {
			$rs->insert();
			$num=$rs->get_insert_id();		
		}
	     	$rs->commit();	


	        if($mode=='new' and $national==3) {


/*
	    $rs_jlist = new $rs_class($dbcon);
		$rs_jlist->clear();
		$rs_jlist->set_table(	$_table['school']);
		$rs_jlist->add_where("num='$school_name_no'");
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

		 }

	
	 // ���� ���ε�

       $school_path="../data/student_file/";

	    for($fi=1;$fi<6;$fi++) {
		if(${"del_file{$fi}"}) {
			@unlink($school_path.${"school_file{$fi}_name"});
			${"school_file{$fi}_name"} = '';
	
		 $rs->clear();
			$rs->set_table($_table['regi']);
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

			$rs->add_where("regi_no=$num");
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
			$rs->set_table($_table['regi']);
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





			$rs->add_where("regi_no=$num");
			$rs->update();
     		$rs->commit();	


            if($iphak_date){
     		$iph_date=explode("-",$iphak_date);	
     		$iphak_date1 =$iph_date[0];
     		$iphak_date2 =$iph_date[1];
     		$iphak_date3 =$iph_date[2];
			}


            if($cost_in_date){
     		$coin_date=explode("-",$cost_in_date);	
     		$cost_in_date1 =$coin_date[0];
     		$cost_in_date2 =$coin_date[1];
     		$cost_in_date3 =$coin_date[2];
			}
            if($cost_out_date){
     		$coout_date=explode("-",$cost_out_date);	
     		$cost_out_date1 =$coout_date[0];
     		$cost_out_date2 =$coout_date[1];
     		$cost_out_date3 =$coout_date[2];
        	}


            if($cost_in_date21){
     		$coin_date21=explode("-",$cost_in_date21);	
     		$cost_in_date211 =$coin_date21[0];
     		$cost_in_date212 =$coin_date21[1];
     		$cost_in_date213 =$coin_date21[2];
        	}

            if($cost_out_date21){
     		$coout_date21=explode("-",$cost_out_date21);	
     		$cost_out_date211 =$coout_date21[0];
     		$cost_out_date212 =$coout_date21[1];
     		$cost_out_date213 =$coout_date21[2];
        	}

     		$class_in = $comm - $sale + $exchange - $bank_fee ;
     		$etc_in = $insu_comm + $air_comm + $etc_comm ;
     		$class_insen = $class_in * 0.15 ;
     		$etc_insen = $etc_in * 0.15 ;

		    $rs->clear();
			$rs->set_table($_table['regi_account']);
			$rs->add_field("chain","$chain");		
			$rs->add_field("consult","$_mb[mb_name]");	
			$rs->add_field("stu_no","$num");
			$rs->add_field("iphak","$iphak");
			$rs->add_field("cost_in","$cost_in");	
			$rs->add_field("cost_out","$cost_out");
			$rs->add_field("cost_in2","$cost_in2");	
			$rs->add_field("cost_out2","$cost_out2");
			$rs->add_field("exchange","$exchange");
			$rs->add_field("bank_fee","$bank_fee");	
			$rs->add_field("comm","$comm");
			$rs->add_field("sale","$sale");	
			$rs->add_field("comm_share1","$comm_share1");
			$rs->add_field("comm_share2","$comm_share2");
			$rs->add_field("air_comm","$air_comm");
			$rs->add_field("insu_comm","$insu_comm");	
			$rs->add_field("etc_comm","$etc_comm");	
			$rs->add_field("iphak_date","$iphak_date");	    
			$rs->add_field("iphak_date1","$iphak_date1");	         
			$rs->add_field("iphak_date2","$iphak_date2");	            
			$rs->add_field("iphak_date3","$iphak_date3");	
			$rs->add_field("cost_in_date","$cost_in_date");			
			$rs->add_field("cost_in_date1","$cost_in_date1");	         
			$rs->add_field("cost_in_date2","$cost_in_date2");	             
			$rs->add_field("cost_in_date3","$cost_in_date3");	
			$rs->add_field("cost_out_date","$cost_out_date");	     
			$rs->add_field("cost_out_date1","$cost_out_date1");	        
			$rs->add_field("cost_out_date2","$cost_out_date2");	  
			$rs->add_field("cost_out_date3","$cost_out_date3");	     
			$rs->add_field("cost_in_date21","$cost_in_date21");	
			$rs->add_field("cost_in_date211","$cost_in_date211");	 
			$rs->add_field("cost_in_date212","$cost_in_date212");	 
			$rs->add_field("cost_in_date213","$cost_in_date213");	         
			$rs->add_field("cost_out_date21","$cost_out_date21");	      
			$rs->add_field("cost_out_date211","$cost_out_date211");	  
			$rs->add_field("cost_out_date212","$cost_out_date212");	     
			$rs->add_field("cost_out_date213","$cost_out_date213");	  
			$rs->add_field("exch_date1","$exch_date1");	      
			$rs->add_field("exch_date2","$exch_date2");	        
			$rs->add_field("exch_date3","$exch_date3");	             
			$rs->add_field("ba_fee_date1","$ba_fee_date1");	            
			$rs->add_field("ba_fee_date2","$ba_fee_date2");	  
			$rs->add_field("ba_fee_date3","$ba_fee_date3");	              
			$rs->add_field("comm_date1","$comm_date1");	
			$rs->add_field("comm_date2","$comm_date2");	             
			$rs->add_field("comm_date3","$comm_date3");	
			$rs->add_field("sale_date1","$sale_date1");	
			$rs->add_field("sale_date2","$sale_date2");	              
			$rs->add_field("sale_date3","$sale_date3");	 
			$rs->add_field("co_sh1_date1","$co_sh1_date1");	            
			$rs->add_field("co_sh1_date2","$co_sh1_date2");	          
			$rs->add_field("co_sh1_date3","$co_sh1_date3");	          
			$rs->add_field("co_sh2_date1","$co_sh2_date1");	
			$rs->add_field("co_sh2_date2","$co_sh2_date2");	      
			$rs->add_field("co_sh2_date3","$co_sh2_date3");	          
			$rs->add_field("air_date1","$air_date1");	          
			$rs->add_field("air_date2","$air_date2");	         
			$rs->add_field("air_date3","$air_date3");	           
			$rs->add_field("insu_date1","$insu_date1");	     
			$rs->add_field("insu_date2","$insu_date2");	            
			$rs->add_field("insu_date3","$insu_date3");	        
			$rs->add_field("etc_date1","$etc_date1");	            
			$rs->add_field("etc_date2","$etc_date2");	
			$rs->add_field("etc_date3","$etc_date3");	
			$rs->add_field("sale_comm","$sale_comm");	
 			$rs->add_field("next_import","$next_import");	
	    	$rs->add_field("process_state","$process_state");	
			$rs->add_field("class_in","$class_in");	
			$rs->add_field("etc_in","$etc_in");	
 			$rs->add_field("class_insen","$class_insen");	
	    	$rs->add_field("etc_insen","$etc_insen");	
	    	$rs->add_field("insen_check","$insen_check");


	$rs_ac1 = new $rs_class($dbcon);
	$rs_ac1->clear();
	$rs_ac1->set_table($_table['regi_account']);
	$rs_ac1->add_where("stu_no=$num");
	$rs_ac1->select();


			if($rs_ac1->num_rows()!=1) { 
			$rs->insert();
		    }else{	
			$rs->add_where("stu_no=$num");					
			$rs->update();
			}
			$rs->commit();	
		
		
	//	if($pp=="2"){			
	 //   rg_href("abroad_student_list.php?$_get_param[3]");
	//	}
		//else{
		rg_href("regi_list.php?$_get_param[3]&year=$year&month=$month");
	//	}
	}

if(!$data['consult']){
$data['consult'] = $_mb[mb_name];
}else{
$data['consult'] = $data['consult'];
}
	$MENU_L='m5';

?>

<? include("_header.php"); ?>
<? include("admin.header.php"); ?>
<table border="0" cellpadding="0" cellspacing="0" width="800" align="center">
  <tr height="40">
    <td background="images/title_bg.gif" style="padding:9pt 0pt 0pt 10pt" valign="top"><font color=#000000><b>����ڰ���</b></font></td>
  </tr>
</table>
<form name="regi_form" method="post" action="?<?=$_get_param[3]?>" onSubmit="return validate(this)" enctype="multipart/form-data">
<input type="hidden" name="mode" value="<?=$mode?>" />
<input type="hidden" name="num" value="<?=$num?>" />
<input type="hidden" name="year" value="<?=$year?>" />
<input type="hidden" name="month" value="<?=$month?>" />
<table border="0" cellspacing="0" cellpadding="0" width="800" align="center">
   <tr>
     <td class="a_sub_title">�����Ȳ<? if($mode=='modify') { ?>����<?}else{?>���<? } ?></td>
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
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>		
	<tr>
		<td width="110" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�̸�</td>
		<td width="275" class="a_s_text_title"><input name="student_name" type="text" value="<?=$data['student_name']?>" class="cc" size=6>   (����: <input name="student_ename" type="text" value="<?=$data['student_ename']?>" class="cc" size=22>)</td>
		<td width="110"  bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">ȸ��ID</td>
		<td width="275"  class="a_s_text_title"><input name="mb_id" type="text" value="<?=$data['mb_id']?>" class="cc" size=10></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">��ϰ��</td>
		<td colspan="3"  class="a_s_text_title"><select name="rgi_type" class="select">
<?=rg_html_option($_const['root'],$data['rgi_type'])?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�̸���</td>
		<td  class="a_s_text_title"><input name="email" type="text" value="<?=$data['email']?>" class="cc" size=33></td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">��ȭ��ȣ</td>
		<td class="a_s_text_title"><input name="tel" type="text" value="<?=$data['tel']?>" class="cc" size=33></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�������</td>
		<td class="a_s_text_title"><select name="chain" class="select">
<?=rg_html_option($_regi['chain'],$data['chain'])?>
		</select></td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">���Ӵ����</td>
		<td  class="a_s_text_title"><select name="consult" class="select">
         <?       
	    $rs_list = new $rs_class($dbcon);
	    $rs_list->clear();
	    $rs_list->set_table($_table['member']);
        $rs_list->add_where("mb_id != 'webadmin'");	
        $rs_list->add_where("mb_level >= 90");	
	    while($RV=$rs_list->fetch()) {

		?>
	<option value="<?=$RV[mb_num]?>" <?if ($RV[mb_num]==$data['consult']) { ?>selected<?}?>><?=$RV[mb_name]?></option>  <?     } ?> 
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�����</td>
		<td class="a_s_text_title"><img src="./images/icon_07.gif" style="cursot:hand" onclick="popUpCalendar(this, regi_date, 'yyyy-mm-dd')" align="absmiddle">&nbsp;<input type="text" name="regi_date" class="cc" size="10" value="<?=$data['regi_date']?>" readonly onclick="popUpCalendar(this, regi_date, 'yyyy-mm-dd')" ></td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�����</td>
		<td class="a_s_text_title"><img src="./images/icon_07.gif" style="cursot:hand" onclick="popUpCalendar(this, abroad_date, 'yyyy-mm-dd')" align="absmiddle"> <input type="text" name="abroad_date" class="cc" size="10" value="<?=$data['abroad_date']?>" readonly onclick="popUpCalendar(this, abroad_date, 'yyyy-mm-dd')" ></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�ⱹ��</td>
		<td  class="a_s_text_title"><img src="./images/icon_07.gif" style="cursot:hand" onclick="popUpCalendar(this, airpoet_date, 'yyyy-mm-dd')" align="absmiddle"> <input type="text" name="airpoet_date" class="cc" size="10" value="<?=$data['airpoet_date']?>" readonly onclick="popUpCalendar(this, airpoet_date, 'yyyy-mm-dd')" ></td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">����</td>
		<td class="a_s_text_title"><select name="national" class="select2">
<?=rg_html_option($_const['national'],$data['national'])?>
		</select>&nbsp;<input type="checkbox" name="national2_check" value="1" <? if($data[national2_check] == "1") {echo "checked";} ?>>���� <select name="national2" class="select2">
		<option>=���� ����=</option>
<?=rg_html_option($_const['national'],$data['national2'])?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�����Ⱓ</td>
		<td colspan="3" class="a_s_text_title"><input name="study_gigan" type="text" value="<?=$data['study_gigan']?>" class="cc" size=3>��&nbsp;&nbsp;|&nbsp;&nbsp;����:<input name="study_gigan2" type="text" value="<?=$data['study_gigan2']?>" class="cc" size=3>��</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">��������/����</td>
		<td colspan="3" class="a_s_text_title"><input type="text" name="open_date" class="cc" size="10" value="<?=$data['open_date']?>" readonly onclick="popUpCalendar(this, open_date, 'yyyy-mm-dd')" > ~ <?=rg_date($data[end_date1],'%Y-%m-%d')?>&nbsp;&nbsp;|&nbsp;&nbsp;����:<input type="text" name="open_date2" class="cc" size="10" value="<?=$data['open_date2']?>" readonly onclick="popUpCalendar(this, open_date2, 'yyyy-mm-dd')" > ~ <?=rg_date($data[end_date21],'%Y-%m-%d')?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">����б�</td>
		<td colspan="3" class="a_s_text_title">�ʸ���: <select name="school_name_no" class="select">
         <option value="" >=�����ϼ���=</option>
		 <?       
	    $rs_sc = new $rs_class($dbcon);
	    $rs_sc->clear();
	    $rs_sc->set_table($_table['school']);
        $rs_sc->add_where("national = 3");	
	    while($SC=$rs_sc->fetch()) {

		?>
	<option value="<?=$SC[num]?>" <?if ($SC[num]==$data['school_name_no']) { ?>selected<?}?>><?=$SC[title]?></option>  <?  } ?> 
		</select><br>����(or ��Ÿ����): <input name="school_name2" type="text" value="<?=$data['school_name2']?>" class="cc" size=35></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�����Ȳ</td>
		<td colspan="2" class="a_s_text_title"><select name="process_state" class="select3">
<?=rg_html_option($_process['process_state'],$data['process_state'])?>
		</select></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="passport_check" value="1" <? if($data[passport_check] == "1") {echo "checked";} ?>>����/���� Ȯ��</td>
		<td colspan="3" class="a_s_text_title"><input name="passport" type="text" value="<?=$data['passport']?>" class="cc" size=85> (���ǹ�ȣ:<input name="passport_no" type="text" value="<?=$data['passport_no']?>" class="cc" size=8>)</td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="regi_cost_check" value="1" <? if($data[regi_cost_check] == "1") {echo "checked";} ?>>���б� �Ա�</td>
		<td colspan="3" class="a_s_text_title"><input name="regi_cost" type="text" value="<?=$data['regi_cost']?>" class="cc" size=95></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="school_regi_check" value="1" <? if($data[school_regi_check] == "1") {echo "checked";} ?>>���б� ���</td>
		<td colspan="3" class="a_s_text_title"><input name="school_regi" type="text" value="<?=$data['school_regi']?>" class="cc" size=95></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="air_reserve_check" value="1" <? if($data[air_reserve_check] == "1") {echo "checked";} ?>>�װ� ����</td>
		<td colspan="3" class="a_s_text_title"><input name="air_reserve" type="text" value="<?=$data['air_reserve']?>" class="cc" size=95></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="air_paid_check" value="1" <? if($data[air_paid_check] == "1") {echo "checked";} ?>>�װ��� �ϳ�</td>
		<td colspan="3" class="a_s_text_title"><input name="air_paid" type="text" value="<?=$data['air_paid']?>" class="cc" size=95></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><input type="checkbox" name="air_ticket_check" value="1" <? if($data[air_ticket_check] == "1") {echo "checked";} ?>>�װ��� �߱�</td>
		<td colspan="3" class="a_s_text_title"><input name="air_ticket" type="text" value="<?=$data['air_ticket']?>" class="cc" size=95></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="cost_paid_check" value="1" <? if($data[cost_paid_check] == "1") {echo "checked";} ?>>�к��Ա�</td>
		<td colspan="3" class="a_s_text_title"><input name="cost_paid" type="text" value="<?=$data['cost_paid']?>" class="cc" size=95></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>		
		<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="cost_bank_check" value="1" <? if($data[cost_bank_check] == "1") {echo "checked";} ?>>�к�۱�</td>
		<td colspan="3" class="a_s_text_title"><input name="cost_bank" type="text" value="<?=$data['cost_bank']?>" class="cc" size=95></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="insu_check" value="1" <? if($data[insu_check] == "1") {echo "checked";} ?>>���谡��</td>
		<td colspan="3" class="a_s_text_title"><input name="insu" type="text" value="<?=$data['insu']?>" class="cc" size=95></td>
	</tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="abroad_ot_check" value="1" <? if($data[abroad_ot_check] == "1") {echo "checked";} ?>>�ⱹ O/T</td>
		<td colspan="3" class="a_s_text_title"><input name="abroad_ot" type="text" value="<?=$data['abroad_ot']?>" class="cc" size=95></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="abroad_check" value="1" <? if($data[abroad_check] == "1") {echo "checked";} ?>>�ⱹ</td>
		<td colspan="3" class="a_s_text_title"><br><input name="abroad" type="text" value="<?=$data['abroad']?>" class="cc" size=95></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="dormi_check" value="1" <? if($data[dormi_check] == "1") {echo "checked";} ?>>����</td>
		<td colspan="3" class="a_s_text_title"><input name="dormi" type="text" value="<?=$data['dormi']?>" class="cc" size=95></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt"><input type="checkbox" name="pickup_check" value="1" <? if($data[pickup_check] == "1") {echo "checked";} ?>>�Ⱦ�</td>
		<td colspan="3" class="a_s_text_title"><br><input name="pickup" type="text" value="<?=$data['pickup']?>" class="cc" size=95></td>
	</tr>


    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt">������</td>
		<td colspan="3" class="a_s_text_title"><textarea name="etc" style="width:97%;" rows="6" class="cc"><?=$data['etc']?></textarea></td>
    </tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 3pt">���γ���</td>
		<td colspan="3" class="a_s_text_title"><input name="sale_comm" type="text" value="<?=$data_ac['sale_comm']?>" class="cc" size=95></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
    <tr>
	    <td height="10" colspan="4"></td>
    </tr>
    <tr>
	    <td height="30" colspan="4" align="right">ex.)3500000, ','���� ���ڸ� �����ϼ���</td>
    </tr>
    <tr>
	    <td bgcolor="#BECCDD" height="2" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">���б�</td>
		<td colspan="3" class="a_s_text_title"><img src="./images/icon_07.gif" style="cursot:hand" onclick="popUpCalendar(this, iphak_date, 'yyyy-mm-dd')" align="absmiddle"> <input type="text" name="iphak_date" class="cc" size="10" value="<?=$data_ac['iphak_date']?>" readonly onclick="popUpCalendar(this, iphak_date, 'yyyy-mm-dd')" > <input name="iphak" type="text" value="<?=$data_ac['iphak']?>" class="cc" size=8>��</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�к�(�ʸ���) �Ա�</td>
		<td class="a_s_text_title"><img src="./images/icon_07.gif" style="cursot:hand" onclick="popUpCalendar(this, cost_in_date, 'yyyy-mm-dd')" align="absmiddle"> <input type="text" name="cost_in_date" class="cc" size="10" value="<?=$data_ac['cost_in_date']?>" readonly onclick="popUpCalendar(this, cost_in_date, 'yyyy-mm-dd')" > <input name="cost_in" type="text" value="<?=$data_ac['cost_in']?>" class="cc"size=8>��  
		</td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�к�(�ʸ���) �۱�</td>
        <td class="a_s_text_title"><img src="./images/icon_07.gif" style="cursot:hand" onclick="popUpCalendar(this, cost_out_date, 'yyyy-mm-dd')" align="absmiddle"> <input type="text" name="cost_out_date" class="cc" size="10" value="<?=$data_ac['cost_out_date']?>" readonly onclick="popUpCalendar(this, cost_out_date, 'yyyy-mm-dd')" > <input name="cost_out" type="text" value="<?=$data_ac['cost_out']?>" class="cc" size=8>��</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�к�(����or��Ÿ) �Ա�</td>
		<td class="a_s_text_title"><img src="./images/icon_07.gif" style="cursot:hand" onclick="popUpCalendar(this, cost_in_date21, 'yyyy-mm-dd')" align="absmiddle"> <input type="text" name="cost_in_date21" class="cc" size="10" value="<?=$data_ac['cost_in_date21']?>" readonly onclick="popUpCalendar(this, cost_in_date21, 'yyyy-mm-dd')" > <input name="cost_in2" type="text" value="<?=$data_ac['cost_in2']?>" class="cc" size=8>��  
		</td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�к�(����or��Ÿ) �۱�</td>		
		<td class="a_s_text_title"><img src="./images/icon_07.gif" style="cursot:hand" onclick="popUpCalendar(this, cost_out_date21, 'yyyy-mm-dd')" align="absmiddle"> <input type="text" name="cost_out_date21" class="cc" size="10" value="<?=$data_ac['cost_out_date21']?>" readonly onclick="popUpCalendar(this, cost_out_date21, 'yyyy-mm-dd')" > <input name="cost_out2" type="text" value="<?=$data_ac['cost_out2']?>" class="cc" size=8>��</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">ȯ����</td>
		<td class="a_s_text_title"><input name="exchange" type="text" value="<?=$data_ac['exchange']?>" class="cc" size=8>��</td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�۱ݼ�����</td>
		<td class="a_s_text_title"><input name="bank_fee" type="text" value="<?=$data_ac['bank_fee']?>" class="cc" size=8>��</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�к���</td>
		<td  class="a_s_text_title"><input name="comm" type="text" value="<?=$data_ac['comm']?>" class="cc" size=8>��</td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">���ξ�</td>
		<td  class="a_s_text_title"><input name="sale" type="text" value="<?=$data_ac['sale']?>" class="cc" size=8>��</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�װ���</td>
		<td class="a_s_text_title"><input name="air_comm" type="text" value="<?=$data_ac['air_comm']?>" class="cc" size=8>��</td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">������</td>
		<td class="a_s_text_title"><input name="insu_comm" type="text" value="<?=$data_ac['insu_comm']?>" class="cc" size=8>��</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>		
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">��Ÿ��</td>
		<td class="a_s_text_title"><input name="etc_comm" type="text" value="<?=$data_ac['etc_comm']?>" class="cc" size=8>��</td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">������</td>
		<td class="a_s_text_title"><input name="next_import" type="text" value="<?=$data_ac['next_import']?>" class="cc" size=8>�� <?if($data['consult'] == $_mb[mb_num] or $_mb[mb_level] ){?>/ <select name="insen_year" class="select3">
<option>=����=</option>
<?=rg_html_option($_const[year],$data['insen_year'])?>
		</select>�� <select name="insen_mon" class="select3">
<option>=����=</option>
<?=rg_html_option($_const[month],$data['insen_mon'])?>
		</select>�� <input type="checkbox" name="insen_check" value="1" <? if($data[insen_check] == "1") {echo "checked";} ?>>�޿�����<?}?></td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="2" colspan="4"></td>
    </tr>	
  <? if($_mb[mb_level] > 90){?>
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�к������</td>
		<td class="a_s_text_title"><?=number_format($data_ac['class_in'])?>��</td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">��Ÿ������</td>
		<td class="a_s_text_title"><?=number_format($data_ac['etc_in'])?>��</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">�к��μ�Ƽ��</td>
		<td class="a_s_text_title"><?=number_format($data_ac['class_insen'])?>��</td>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">��Ÿ�μ�Ƽ��</td>
		<td class="a_s_text_title"><?=number_format($data_ac['etc_insen'])?>��</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">������</td>
		<td class="a_s_text_title" colspan="3">�Ѹ����: <?=number_format($data_ac['class_in']+$data_ac['etc_in'])?>�� | �μ�Ƽ��: <?=number_format($data_ac['class_insen']+$data_ac['etc_insen'])?>�� | ������: <?=number_format($data_ac['class_in']+$data_ac['etc_in']-$data_ac['class_insen']-$data_ac['etc_insen'])?>��</td>
	</tr>
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
<?}?>
    <tr>
	    <td height="30" colspan="4"></td>
    </tr>	
    <tr>
	    <td bgcolor="#BECCDD" height="1" colspan="4"></td>
    </tr>	
<? for ($i=1; $i<=10; $i++){?>
   <tr>
    <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>����<?=$i?></strong></td>
	<td colspan="3" class="a_s_text_title" class="a_s_text_title">	<input name='school_file<?=$i?>' type=file class=cc style='width:40%;'>&nbsp;&nbsp;<?if($data[school_file.$i._name]){?><input name='del_file<?=$i?>' type=checkbox id="del_file<?=$i?>" value='1'>���� (<a href="../data/student_file/<?=$data[school_file.$i._name]?>"><?=$data[school_file.$i._name]?></a>)<?}?>	</td>
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
	<td width="100" align="center"><input type=image src="images/bt_list2.gif" onClick="history.back();" ></td>
  </tr>
</table>
</form>
 <?if($mode=='modify'){?>
<br>
<table width=800 border=1 align="center" cellpadding=0 cellspacing=0 bordercolorlight="#E1E1E1" bordercolordark="white">
  <tr>
     <td colspan="2" bgcolor="#F7F7F7"><div align="center">�л�����</div></td>
   </tr>
 <?
	    $rs_comment = new $rs_class($dbcon);
	    $rs_comment->clear();
	    $rs_comment->set_table($_table['ca_mem_comm']);
        $rs_comment->add_where("cmt_regi_num = '$num'");	
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
		  <a href="./ca_mem_comm_edit.php?&page_no=<?=$page?>&mode=delete&num=<?=$cdata[num]?>&cmt_num=<?=$num?>"><img src="./images/c_del.gif" alt="����" border="0"></a> <br> <div align="right"></div></td>
      </tr> <? }?>
    </table>
   <table width=800 border=1 align="center" cellpadding=0 cellspacing=0 bordercolorlight="#E1E1E1" bordercolordark="white">
<form name=form_comment method=post action='ca_mem_comm_edit.php' autocomplete=off>
<input type=hidden name=cmt_regi_num value='<?=$num?>'>
<input type=hidden name=cmt_name value='<?=$_mb[mb_name]?>'>
<input type=hidden name=page_no value='<?=$page?>'>
<input type=hidden name=pp value='regi'>
          <tr>             
          <td bgcolor="#FFFFFF" align="center"><textarea rows=2 name=cmt_comment class=textarea style='width:97%' required itemname='�ڸ�Ʈ����' style='border-width:1; border-color:rgb(136,136,136); border-style:solid;'></textarea>
           </td>
            <td width="80" height="100%" bgcolor="#FFFFFF"><input type=submit value='  �� ��  ' style="font-style:normal; font-size:12px; color:white; background-color:#404040; border-width:1px; border-color:rgb(221,221,221); border-style:solid; height:100%;width:100%"></td></tr> 
         </form>
	    </table>  					
    </tr>
    </table>
<?}?>
<? include("admin.footer.php"); ?>
<? include("_footer.php"); ?>