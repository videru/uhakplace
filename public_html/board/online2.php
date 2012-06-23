<?
    $bbs_code = "online" ;
	include_once("../include/lib.php");

    if(!$national){
    $national = 3;
    }

if($num){

		$rs->clear();
		$rs->set_table($_table['school']);
		$rs->add_where("num=$num");
		$rs->select();
		$data=$rs->fetch();		
$national=$data['national'] ;
}
	
	if($_SERVER['REQUEST_METHOD']=='POST') {

     		$rs->clear();
	    	$rs->set_table($_table['pre_regi']);
			$rs->add_field("student_name","$student_name");		
			$rs->add_field("chain","$chain");		
			$rs->add_field("consult","$consult");	
	    	$rs->add_field("regi_date1","$regi_date1");
	    	$rs->add_field("regi_date2","$regi_date2");
 	    	$rs->add_field("regi_date3","$regi_date3");
	    	$rs->add_field("abroad_date1","$abroad_date1");
	    	$rs->add_field("abroad_date2","$abroad_date2");	
	    	$rs->add_field("abroad_date3","$abroad_date3");	
	    	$rs->add_field("airpoet_date1","$airpoet_date1");
	    	$rs->add_field("airpoet_date2","$airpoet_date2");	
	    	$rs->add_field("airpoet_date3","$airpoet_date3");				
	    	$rs->add_field("national","$national");	
	    	$rs->add_field("school_name","$school_name");	
	    	$rs->add_field("study_gigan","$study_gigan");	
		   	$rs->add_field("passport","$passport");
	    	$rs->add_field("passport_check","$passport_check");	
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
	    	$rs->add_field("mb_id","$mb_id");	
	    	$rs->add_field("email","$email");		
	    	$rs->add_field("tel","$tel");	
	    	$rs->add_field("etc","$etc");	
	    	$rs->add_field("regi_date",time());	
	    	$rs->add_field("insert_gubun",2);
			$rs->add_field("process_state","1");
		if($mode=='modify') {
			$rs->add_where("regi_no=$num");
			$rs->update();
		} else {
			$rs->insert();
			$num=$rs->get_insert_id();		
		}
	     	$rs->commit();	
		   rg_href("./online2.php","상담 문의가 접수되었습니다.");

}
?>

<link href="<?=$_url['css']?>style.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

table.tstyle1{float:center; width:739px; border-top:#9db6cc solid 2px;  border-bottom:#c9d4de solid 1px; border-left:1px solid #dedede; color:#555555; font-size:12px;}
table.tstyle1 caption{position:absolute; width:0; height:0;	font-size:0; line-height:0;	overflow:hidden; visibility:hidden;}

table.tstyle1 tr th{font-size:12px; border-bottom:#dedede solid 1px; border-right:1px solid #dedede;  padding:8px; text-align:left; background-color:#f1f5f8; color:#0069a0; font-weight:bold; }

table.tstyle1 tr td{font-size:12px; text-align:left;  border-bottom:1px solid #dedede; border-right:#dedede solid 1px; padding:8px 8px 8px 10px;;}
table.tstyle1 tr td.box{background-color:#d0ebf4;}
table tr td.td_left{text-align:left; padding-left:10px;}


table.tstyle2{float:center; width:739px; border-top:#9db6cc solid 2px;  border-bottom:#c9d4de solid 1px; border-left:1px solid #dedede; color:#555555; font-size:12px;}
table.tstyle2 caption{position:absolute; width:0; height:0;	font-size:0; line-height:0;	overflow:hidden; visibility:hidden;}

table.tstyle2 tr th{font-size:12px; border-bottom:#dedede solid 1px; border-right:1px solid #dedede;  padding:8px; text-align:center; background-color:#f1f5f8; color:#0069a0; font-weight:bold; }

table.tstyle2 tr td{font-size:12px; text-align:center; border-bottom:1px solid #dedede; border-right:#dedede solid 1px; padding:8px 8px 8px 10px;;}
table.tstyle2 tr td.box{background-color:#d0ebf4;}
-->
</style>

<form name="regi_form" method="post" action="?" onSubmit="return validate(this)" enctype="multipart/form-data">

<table border="0" cellpadding="0" cellspacing="0" width="739" class="tstyle1">

	<tr>
		<td width="110" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">이름</td>
		<td colspan="2"><input name="student_name" type="text" value="<?=$data['student_name']?>" class="cc" size=10></td>
	</tr>

	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">이메일</td>
		<td colspan="2"><input name="email" type="text" value="<?=$data['email']?>" class="cc" size=33></td>
	</tr>

	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">전화번호</td>
		<td colspan="2"><input name="tel" type="text" value="<?=$data['tel']?>" class="cc" size=33></td>
	</tr>

	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">담당지사</td>
		<td colspan="2"><select name="chain" class="select">
<?=rg_html_option($_regi['chain'],$data['chain'])?>
		</select></td>
	</tr>

	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">국가</td>
		<td colspan="2"><select name="national" class="select2">
<?=rg_html_option($_const['national'],$national)?>
		</select></td>
	</tr>

	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">등록학교</td>
		<td colspan="2"><input name="title" type="text" value="<?=$data['title']?>" class="cc" size=50></td>
	</tr>

	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">등록기간</td>
		<td colspan="2"><input name="study_gigan" type="text" value="<?=$data['study_gigan']?>" class="cc" size=4>주</td>
	</tr>

	<tr>
		<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt">상담사항</td>
		<td ><textarea name="etc" style="width:97%;" rows="6" class="cc"><?=$data['etc']?></textarea></td>
    </tr>

</table>

<br>
<table width="200" border="0"  align=center>
	<tr>
		<td width="100" align="center"><INPUT onfocus=this.blur() type=image src="../img/btn_regi.gif"></td>
		<td width="100" align="center"><input type=image src="../img/btn_cancel.gif" onClick="history.back();" ></td>
	</tr>
</table>
</form>