<?
	include_once("../include/lib.php");
	require_once("admin_chk.php");


  	$fileN1 = $year."년_".$month."월_등록현황";
	header( "Content-type: application/vnd.ms-exel" ); 
	header("Cache-control: private");
	header( "Content-Disposition: attachment; filename=$fileN1.xls" ); 
	header( "Content-Description: PHP4 Generated Data" );  
 

//   if ($year=="") {
//		$year=date("Y");
//	}
//	if ($month=="") {
//		$month=date("m");
//	}


    //total
	$rs_ch = new $rs_class($dbcon);
	$rs_ch->clear();
	$rs_ch->set_table($_table['regi']);
//	$rs_ch->add_where("chain = 1");		
	if ($year) { $rs_ch->add_where("abroad_date1 = $year");  }
	if ($month) { $rs_ch->add_where("abroad_date2 = $month");  }
   
	while($R=$rs_ch->fetch()) {
    $total_num++;
	$total_price = $total_price + ($R[study_gigan] + $R[study_gigan2]);     
		
	}

	//기대수익


	$rs_next = new $rs_class($dbcon);
	$rs_next->clear();
	$rs_next->set_table($_table['regi_account']);
    $rs_next->add_where("insen_check <> 1");  	

	if ($year) { $rs_next->add_where("iphak_date1  = $year");  }
	if ($month) { $rs_next->add_where("iphak_date2 = $month");  }	

	while($next=$rs_next->fetch()) {
	$total_innext = $total_innext + $next[next_import]; 
    }	

	//당월수익

	$rs_in = new $rs_class($dbcon);
	$rs_in->clear();
	$rs_in->set_table($_table['regi_account']);
	if ($year) { $rs_in->add_where("iphak_date1 = $year");  }
	if ($month) { $rs_in->add_where("iphak_date2  = $month");  }

	while($Rinc=$rs_in->fetch()) {
	$total_iphak = $total_iphak + $Rinc[iphak];  		
	$total_in = $total_in + ($Rinc[class_in] + $Rinc[etc_in]);  
	$total_insen = $total_insen + ($Rinc[class_insen] + $Rinc[etc_insen]); 

	}

	$total_cost = $total_iphak + $total_in - $total_insen; 

  //뉴질랜드
	$rs_nat1 = new $rs_class($dbcon);
	$rs_nat1->clear();
	$rs_nat1->set_table($_table['regi']);
	$rs_nat1->add_where("national = 1");		
	if ($year) { $rs_nat1->add_where("abroad_date1 = $year");  }
	if ($month) { $rs_nat1->add_where("abroad_date2 = $month");  }		
	while($Rn1=$rs_nat1->fetch()) {
    $total_nnum11++;
	$total_nprice11 = $total_nprice11 + $Rn1[study_gigan]; 
    }
	$rs_nat11 = new $rs_class($dbcon);
	$rs_nat11->clear();
	$rs_nat11->set_table($_table['regi']);
	$rs_nat11->add_where("national2 = 1");		
	if ($year) { $rs_nat11->add_where("abroad_date1 = $year");  }
	if ($month) { $rs_nat11->add_where("abroad_date2 = $month");  }		
	while($Rn1=$rs_nat11->fetch()) {
    $total_nnum12++;
	$total_nprice12 = $total_nprice12+ $Rn11[study_gigan2]; 
    }
    $total_nnum1 = $total_nnum11 + $total_nnum12 ;
	$total_nprice1 = $total_nprice11 + $total_nprice12;


    //호주
	$rs_nat2 = new $rs_class($dbcon);
	$rs_nat2->clear();
	$rs_nat2->set_table($_table['regi']);
	$rs_nat2->add_where("national = 2");		
	if ($year) { $rs_nat2->add_where("abroad_date1 = $year"); }  
	if ($month) { $rs_nat2->add_where("abroad_date2 = $month");   }	   
	while($Rn2=$rs_nat2->fetch()) {
    $total_nnum21++;
	$total_nprice21 = $total_nprice21 +  $Rn2[study_gigan]; 
    }
	$rs_nat21 = new $rs_class($dbcon);
	$rs_nat21->clear();
	$rs_nat21->set_table($_table['regi']);
	$rs_nat21->add_where("national2 = 2");		
	if ($year) { $rs_nat21->add_where("abroad_date1 = $year"); }  
	if ($month) { $rs_nat21->add_where("abroad_date2 = $month");   }	   
	while($Rn21=$rs_nat21->fetch()) {
    $total_nnum22++;
	$total_nprice22 = $total_nprice22 +  $Rn21[study_gigan2]; 
    }
    $total_nnum2 = $total_nnum21 + $total_nnum22 ;
	$total_nprice2 = $total_nprice21 + $total_nprice22;


    //필리핀
	$rs_nat3 = new $rs_class($dbcon);
	$rs_nat3->clear();
	$rs_nat3->set_table($_table['regi']);
	$rs_nat3->add_where("national = 3");		
	if ($year) { $rs_nat3->add_where("abroad_date1 = $year");   }
	if ($month) { $rs_nat3->add_where("abroad_date2 = $month");  } 			
   
	while($Rn3=$rs_nat3->fetch()) {
    $total_nnum3++;
	$total_nprice3 = $total_nprice3 + $Rn3[study_gigan]; 
    }

    //영국
	$rs_nat4 = new $rs_class($dbcon);
	$rs_nat4->clear();
	$rs_nat4->set_table($_table['regi']);
	$rs_nat4->add_where("national = 4");		
	if ($year) { $rs_nat4->add_where("abroad_date1 = $year");   }
	if ($month) { $rs_nat4->add_where("abroad_date2 = $month");  	 }		
   
	while($Rn4=$rs_nat4->fetch()) {
    $total_nnum41++;
	$total_nprice41 = $total_nprice41 +  $Rn4[study_gigan1]; 
    }

	$rs_nat41 = new $rs_class($dbcon);
	$rs_nat41->clear();
	$rs_nat41->set_table($_table['regi']);
	$rs_nat41->add_where("national2 = 4");		
	if ($year) { $rs_nat41->add_where("abroad_date1 = $year"); }  
	if ($month) { $rs_nat41->add_where("abroad_date2 = $month");   }	   
	while($Rn41=$rs_nat41->fetch()) {
    $total_nnum42++;
	$total_nprice42 = $total_nprice42 + $Rn41[study_gigan2]; 
    }
    $total_nnum4 = $total_nnum41 + $total_nnum42 ;
	$total_nprice4 = $total_nprice41 + $total_nprice42;


    //캐나다
	$rs_nat5 = new $rs_class($dbcon);
	$rs_nat5->clear();
	$rs_nat5->set_table($_table['regi']);
	$rs_nat5->add_where("national = 5");		
	if ($year) { $rs_nat5->add_where("abroad_date1 = $year");   }
	if ($month) { $rs_nat5->add_where("abroad_date2 = $month");  	 }		
   
	while($Rn5=$rs_nat5->fetch()) {
    $total_nnum51++;
	$total_nprice51 = $total_nprice51 +  $Rn5[study_gigan]; 
    }

	$rs_nat51 = new $rs_class($dbcon);
	$rs_nat51->clear();
	$rs_nat51->set_table($_table['regi']);
	$rs_nat51->add_where("national2 = 5");		
	if ($year) { $rs_nat51->add_where("abroad_date1 = $year"); }  
	if ($month) { $rs_nat51->add_where("abroad_date2 = $month");   }	   
	while($Rn51=$rs_nat51->fetch()) {
    $total_nnum52++;
	$total_nprice52 = $total_nprice52 + $Rn51[study_gigan2]; 
    }
    $total_nnum5 = $total_nnum51 + $total_nnum52 ;
	$total_nprice5 = $total_nprice51 + $total_nprice52;


    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['regi']);
   // $rs_list->add_where("process_state < 11");	
			
    /***********************************************************************/
   // 필터 조건에 의한 필터링

     if($out==1){ $rs_list->add_where("process_state < 10");	}

	 if($ss[0]){ $rs_list->add_where("process_state = $ss[0]"); } 
	 if($ss[1]){ $rs_list->add_where("national = $ss[1] or national2 = $ss[1]"); } 

	// 검색어로 검색
	if($kw) { $rs_list->add_where("student_name LIKE '%$kw%' escape '".$dbcon->escape_ch."'");} 
    if($year){ $rs_list->add_where("abroad_date1 = $year"); }
	if($month){ $rs_list->add_where("abroad_date2 = $month");  }
	if($consult){ $rs_list->add_where("consult = $consult"); } 

	switch ($ot) {
		case 10 : $rs_list->add_order("regi_no DESC");		break;
		default : $rs_list->add_order("abroad_date1 ASC, regi_no ASC");		break;
	}
?>	
<? include("_header.php"); ?>
<table width="1600" border="0" cellspacing="0" cellpadding="0" >
  <tr> 
    <td align="center" class="text15_b" colspan="20" align="center"><?=$year?>년 <?=$month?>월 등록 현황</td>
  </tr>
</table>
<br>
<table width="1600" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC" border="1">
  <tr bgcolor="#c6c6c6" height="25"> 
    <td width="50" align="center" >NO</td>
	<td width="55" align="center" >이름</td>
	<td width="90" align="center" >국가</td>
	<td width="55" align="center" >담당자</td>
	<td align="center" >경로</td>
	<td width="250" align="center" >학교</td>
	<td width="90" align="center" >출국일</td>
	<td width="90" align="center" >기간</td>
	<td width="70" align="center" >등록금</td>	
	<td width="80" align="center" >학비입금</td>	
	<td width="80" align="center" >학비송금</td>	
	<td width="70" align="center" >환차액</td>	
	<td width="70" align="center" >송금수수료</td>	
 	<td width="70" align="center" >학비컴</td>
 	<td width="70" align="center" >할인액</td>	
 	<td width="70" align="center" >컴쉐어</td>	
 	<td width="80" align="center" >항공컴</td>	
 	<td width="80" align="center" >보험컴</td>	
 	<td width="70" align="center" >기타컴</td>	
 	<td width="70" align="center" >유플순수</td>	
	<td width="70" align="center" >등록일</td>
  </tr>   
  <?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"100\"  bgcolor=\"#FFFFFF\" >
		<td align=\"center\" colspan=\"12\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_list->set_table($_table['regi']);
	
	$no = 0;
	while($R=$rs_list->fetch()) {
		$no++;

   if($R[national2_check] == 1){
     $national = $R[national2];
     $two = "<font color=red>[연계]</font>";
   }else{
     $national = $R[national];
     $two = "";
   }

        $rs_na = new $rs_class($dbcon);
	    $rs_na->clear();
	    $rs_na->set_table($_table['member']);
        $rs_na->add_where("mb_num = $R[consult]");	
        $name=$rs_na->fetch();

 
	    $rs_sc = new $rs_class($dbcon);
	    $rs_sc->clear();
	    $rs_sc->set_table($_table['school']);
        $rs_sc->add_where("national = 3");	
        $rs_sc->add_where("num = '$R[school_name_no]'");	
	    $SC=$rs_sc->fetch() ;


	$rs_ac = new $rs_class($dbcon);
	$rs_ac->clear();
	$rs_ac->set_table($_table['regi_account']);
	$rs_ac->add_where("stu_no='$R[regi_no]'");
	$rs_ac->select();	
	$data_ac=$rs_ac->fetch();		



?>
  <tr height="30" bgcolor="#FFFFFF"> 
    <td align="center" ><?=$no?></td>
	<td align="center" ><?=$R[student_name]?> <?=$R[num]?></td>	   
    <td align="center" ><?=$_const['national'][$national]?><?=$two?></td>	
	 <td align="center" ><?=$name[mb_name]?></td>
    <td align="center" ><?=$_const['root'][$R['rgi_type']]?></td>
    <td align="center" ><?=$SC[title]?><br><?=$data['school_name2']?></td>
    <td align="center" ><?=$R['airpoet_date']?></td>
 	<td align="center"  ><?=$R[study_gigan]?><?if($R[study_gigan2]>0){?>(+<?=$R[study_gigan2]?>)<?}?>주</td>  
    <td align="center" ><?=number_format($data_ac['iphak'])?></td>
    <td align="center" ><?=number_format($data_ac['cost_in'])?></td>
    <td align="center" ><?=number_format($data_ac['cost_out'])?></td>
    <td align="center" ><?=number_format($data_ac['exchange'])?></td>
    <td align="center" ><?=number_format($data_ac['bank_fee'])?></td>
    <td align="center" ><?=number_format($data_ac['comm'])?></td>
    <td align="center" ><?=number_format($data_ac['sale'])?></td>
    <td align="center" ><?=number_format($data_ac['class_insen'])?><br><?=number_format($data_ac['etc_insen'])?></td>
    <td align="center" ><?=number_format($data_ac['air_comm'])?></td>
    <td align="center" ><?=number_format($data_ac['insu_comm'])?></td>
    <td align="center" ><?=number_format($data_ac['etc_comm'])?></td>
    <td align="center" ><?=number_format($data_ac['class_in']+$data_ac['etc_in']-$data_ac['class_insen']-$data_ac['etc_insen'])?></td>
    <td align="center" ><?=$R[abroad_date1]?>.<?=$R[abroad_date2]?>.<?=$R[abroad_date3]?></td>	
  </tr>
<?
}
?>
</table>
<? include("_footer.php"); ?>