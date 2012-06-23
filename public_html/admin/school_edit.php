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
		$rs->set_table($_table['school']);
		$rs->add_where("num=$num");
		$rs->select();
		if($rs->num_rows()!=1) { // 정보가 올바르지 않다면
			rg_href('','정보를 찾을수 없습니다.','back');
		}
		$data=$rs->fetch();		
        $rs_co = new $rs_class($dbcon);
		$rs_co->clear();
		$rs_co->set_table($_table['school_cost']);
		$rs_co->add_where("sc_no=$num");
		$rs_co->select();
		$data_co=$rs_co->fetch();			
	} else {
		$data=$rs->fetch();	
	}

   // 삭제
	if($mode=='delete') {	
		
		// 학교 삭제
		$rs->clear();
		$rs->set_table($_table['school']);
		$rs->add_where("num=$num");
		$rs->delete();		
		$rs->commit();
		rg_href("school_list.php?$_get_param[3]");
	}

	if($_SERVER['REQUEST_METHOD']=='POST') {
	   
	   for($i=0; $i<count($sc_typeN); $i++) 
	   {		   
	   $sc_type = $sc_type.$sc_typeN[$i].",";	
       }		

//			echo $img2_name;
//			exit;

			$rs->clear();
	    	$rs->set_table($_table['school']);	
			$rs->add_field("office_tel","$office_tel");		
			$rs->add_field("msn","$msn");		
			$rs->add_field("check","$check");		
			$rs->add_field("admin_memo","$admin_memo");		            
			$rs->add_field("best","$best");		          
			$rs->add_field("national","$national");		
			$rs->add_field("section","$section");	
			$rs->add_field("sc_type","$sc_type");	
			$rs->add_field("movielink","$movielink");		               
			$rs->add_field("area","$area");	
			$rs->add_field("title","$title");		
			$rs->add_field("s_title","$s_title");		
			$rs->add_field("location","$location");		
			$rs->add_field("open_date","$open_date");		  
			$rs->add_field("class_time","$class_time");		           
			$rs->add_field("teacher_no","$teacher_no");		
			$rs->add_field("native_class","$native_class");		
			$rs->add_field("sparta_program","$sparta_program");		
			$rs->add_field("dorm_type","$dorm_type");		             
			$rs->add_field("etc_facility","$etc_facility");		
			$rs->add_field("special","$special");		
			$rs->add_field("adress","$adress");		            
			$rs->add_field("homepage","$homepage");		
			$rs->add_field("tel","$tel");		    
			$rs->add_field("korean","$korean");		
			$rs->add_field("info","$info");		    
			$rs->add_field("program","$program");		      
			$rs->add_field("row","$row");		
			$rs->add_field("map","$map");		       
			$rs->add_field("total","$total");					
			$rs->add_field("img2_name","$img2_name");
			$rs->add_field("img3_name","$img3_name");
			$rs->add_field("img4_name","$img4_name");
			$rs->add_field("img5_name","$img5_name");
			$rs->add_field("img6_name","$img6_name");
			$rs->add_field("img7_name","$img7_name");
			$rs->add_field("img8_name","$img8_name");
			$rs->add_field("img9_name","$img9_name");
			$rs->add_field("img10_name","$img10_name");
			$rs->add_field("img11_name","$img11_name");
			$rs->add_field("img12_name","$img12_name");
			$rs->add_field("img13_name","$img13_name");
			$rs->add_field("img14_name","$img14_name");
			$rs->add_field("img15_name","$img15_name");
			$rs->add_field("img16_name","$img16_name");
			$rs->add_field("img17_name","$img17_name");
			$rs->add_field("img18_name","$img18_name");
			$rs->add_field("img19_name","$img19_name");
			$rs->add_field("img20_name","$img20_name");
			$rs->add_field("img21_name","$img21_name");
			$rs->add_field("img22_name","$img22_name");
			$rs->add_field("img23_name","$img23_name");
			$rs->add_field("img24_name","$img24_name");
			$rs->add_field("img25_name","$img25_name");
			$rs->add_field("img26_name","$img26_name");
			$rs->add_field("img27_name","$img27_name");
			$rs->add_field("img28_name","$img28_name");
			$rs->add_field("img29_name","$img29_name");
			$rs->add_field("img30_name","$img30_name");
			$rs->add_field("img31_name","$img31_name");
			$rs->add_field("img32_name","$img32_name");
			$rs->add_field("img33_name","$img33_name");
			$rs->add_field("img34_name","$img34_name");
			$rs->add_field("img35_name","$img35_name");
			$rs->add_field("img36_name","$img36_name");
			$rs->add_field("img37_name","$img37_name");
			$rs->add_field("img38_name","$img38_name");
			$rs->add_field("img39_name","$img39_name");
			$rs->add_field("img40_name","$img40_name");
			$rs->add_field("img41_name","$img41_name");
			$rs->add_field("native_info","$native_info");
			$rs->add_field("native_time","$native_time");
			$rs->add_field("native_cost","$native_cost");
		    $rs->add_field("native_course","$native_course");
	    	$rs->add_field("native_promo","$native_promo");
		
		if($mode=='modify') {
			$rs->add_where("num=$num");
			$rs->update();
		} else {
			$rs->insert();
			$num=$rs->get_insert_id();		
		}
	
       // 파일 업로드

        @mkdir("../data/school/".$num."/", 0707);
        @chmod("../data/school/".$num."/", 0707);   
	   
	     $school_path="../data/school/".$num."/";

	    for($fi=1;$fi<42;$fi++) {
		if(${"del_file{$fi}"}) {
			@unlink($school_path.${"school_file{$fi}_name"});
			${"school_file{$fi}_name"} = '';
	
		 $rs->clear();
			$rs->set_table($_table['school']);
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
			$rs->set_table($_table['school']);
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

	        $rs->clear();
	    	$rs->set_table($_table['school_cost']);
			$rs->add_field("sc_no","$num");		
			$rs->add_field("pro_name1","$pro_name1");		
			$rs->add_field("pro_name2","$pro_name2");	
			$rs->add_field("pro_name3","$pro_name3");	
			$rs->add_field("pro_name4","$pro_name4");	
			$rs->add_field("pro_name5","$pro_name5");	
			$rs->add_field("pro_name6","$pro_name6");	
			$rs->add_field("pro_name7","$pro_name7");	
			$rs->add_field("pro_name8","$pro_name8");	
			$rs->add_field("pro_cost1","$pro_cost1");		
			$rs->add_field("pro_cost2","$pro_cost2");	
			$rs->add_field("pro_cost3","$pro_cost3");	
			$rs->add_field("pro_cost4","$pro_cost4");	
			$rs->add_field("pro_cost5","$pro_cost5");	
			$rs->add_field("pro_cost6","$pro_cost6");	
			$rs->add_field("pro_cost7","$pro_cost7");	
			$rs->add_field("pro_cost8","$pro_cost8");	
			$rs->add_field("pro_cost9","$pro_cost9");	
			$rs->add_field("pro_cost10","$pro_cost10");	
			$rs->add_field("pro_cost11","$pro_cost11");	
			$rs->add_field("pro_cost12","$pro_cost12");	
			$rs->add_field("dorm_name1","$dorm_name1");		
			$rs->add_field("dorm_name2","$dorm_name2");	
			$rs->add_field("dorm_name3","$dorm_name3");	
			$rs->add_field("dorm_name4","$dorm_name4");	
			$rs->add_field("dorm_name5","$dorm_name5");	
			$rs->add_field("dorm_name6","$dorm_name6");	
			$rs->add_field("dorm_name7","$dorm_name7");	
			$rs->add_field("dorm_name8","$dorm_name8");	
			$rs->add_field("dorm_name9","$dorm_name9");	
			$rs->add_field("dorm_name10","$dorm_name10");	
			$rs->add_field("dorm_name11","$dorm_name11");	
			$rs->add_field("dorm_name12","$dorm_name12");	
			$rs->add_field("dorm_cost1","$dorm_cost1");		
			$rs->add_field("dorm_cost2","$dorm_cost2");	
			$rs->add_field("dorm_cost3","$dorm_cost3");	
			$rs->add_field("dorm_cost4","$dorm_cost4");	
			$rs->add_field("dorm_cost5","$dorm_cost5");	
			$rs->add_field("dorm_cost6","$dorm_cost6");	
			$rs->add_field("dorm_cost7","$dorm_cost7");	
			$rs->add_field("dorm_cost8","$dorm_cost8");	
			$rs->add_field("dorm_cost9","$dorm_cost9");	
			$rs->add_field("dorm_cost10","$dorm_cost10");	
			$rs->add_field("dorm_cost11","$dorm_cost11");	
			$rs->add_field("dorm_cost12","$dorm_cost12");	
			$rs->add_field("sale_cost8","$sale_cost8");	
			$rs->add_field("sale_cost12","$sale_cost12");	
			$rs->add_field("sale_cost16","$sale_cost16");	
			$rs->add_field("sale_cost20","$sale_cost20");	
			$rs->add_field("sale_cost24","$sale_cost24");
			$rs->add_field("iphak_cost","$iphak_cost");	
			$rs->add_field("deposit_cost1","$deposit_cost1");	
			$rs->add_field("deposit_cost2","$deposit_cost2");	
			$rs->add_field("deposit_name1","$deposit_name1");	
			$rs->add_field("deposit_name2","$deposit_name2");	
			$rs->add_field("deposit_money1","$deposit_money1");	
			$rs->add_field("deposit_money2","$deposit_money2");	
			$rs->add_field("pickup_cost1","$pickup_cost1");	
			$rs->add_field("pickup_cost2","$pickup_cost2");	
			$rs->add_field("phi_out_cost","$phi_out_cost");	
			$rs->add_field("elect_name1","$elect_name1");	
			$rs->add_field("elect_name2","$elect_name2");	
			$rs->add_field("elect_name3","$elect_name3");				
			$rs->add_field("elect_cost1","$elect_cost1");	
			$rs->add_field("elect_cost2","$elect_cost2");	
			$rs->add_field("elect_cost3","$elect_cost3");	
			$rs->add_field("elect_type","$elect_type");	
			$rs->add_field("book_cost","$book_cost");	
			$rs->add_field("book_type","$book_type");	
			$rs->add_field("permoney","$permoney");	
			$rs->add_field("ssp_cost","$ssp_cost");	
			$rs->add_field("ssp_type","$ssp_type");	
			$rs->add_field("ssp_money","$ssp_money");	
			$rs->add_field("visaextra_cost4","$visaextra_cost4");	
			$rs->add_field("visaextra_cost8","$visaextra_cost8");	
			$rs->add_field("visaextra_cost12","$visaextra_cost12");	
			$rs->add_field("visaextra_cost16","$visaextra_cost16");	
			$rs->add_field("visaextra_cost20","$visaextra_cost20");	
			$rs->add_field("visaextra_cost24","$visaextra_cost24");	
			$rs->add_field("visaextra_money","$visaextra_money");	
			$rs->add_field("insu_cost","$insu_cost");		
			$rs->add_field("air_cost","$air_cost");		
			$rs->add_field("icard_p","$icard_p");		
			$rs->add_field("icard_d","$icard_d");	
			$rs->add_field("book_text","$book_text");					
			$rs->add_field("elect_text","$elect_text");	
			$rs->add_field("promo","$promo");			
			
			$rs_juy = new $rs_class($dbcon);
		    $rs_juy->clear();
		    $rs_juy->set_table($_table['school_cost']);
	        $rs_juy->add_where("sc_no='$num'");	
		    $rs_juy->select();

		    if($rs_juy->num_rows()==0) { // 등록이 안되었으면 등록한다.
			$rs->insert();
		} else {
			$rs->add_where("sc_no=$num");
			$rs->update();
		}
		
	
		
		$rs->commit();	
	
	
	
		rg_href("school_list.php?$_get_param[3]");	
	
	}	

	$MENU_L='m5';




if (ereg(",",$data[sc_type])) {
	   // echo ",있다.";
		$str_categoryS = explode(",",$data[sc_type]);
	//	echo sizeof($str_categoryS)."<-- str_categoryS<Br>";

		for ($i=0;$i<sizeof($str_categoryS)-1;$i++) {
			//echo $str_categoryS[$i]."<--<br>";
			
			switch ($str_categoryS[$i])  {
				   case('01') : $checked1 ="checked";break;
				   case('02') : $checked2 ="checked";break;
				   case('03') : $checked3 ="checked";break;
				   case('04') : $checked4 ="checked";break;
				   case('05') : $checked5 ="checked";break;
				   case('06') : $checked6 ="checked";break;
				   case('07') : $checked7 ="checked";break;
				   case('08') : $checked8 ="checked";break;
				   case('09') : $checked9 ="checked";break;
				   case('10') : $checked10="checked";break;
				   case('11') : $checked11="checked";break;
				   case('12') : $checked12="checked";break;
			}
		}
	}else{
	   // echo ",없다.";
			switch ($data[sc_type])  {
				   case('01') : $checked1 ="checked";break;
				   case('02') : $checked2 ="checked";break;
				   case('03') : $checked3 ="checked";break;
				   case('04') : $checked4 ="checked";break;
				   case('05') : $checked5 ="checked";break;
				   case('06') : $checked6 ="checked";break;
				   case('07') : $checked7 ="checked";break;
				   case('08') : $checked8 ="checked";break;
				   case('09') : $checked9 ="checked";break;
				   case('10') : $checked10="checked";break;
				   case('11') : $checked11="checked";break;
				   case('12') : $checked12="checked";break;
			}
	}

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
	f.program.value   = document.program_frm.myeditor.outputBodyHTML();
	f.row.value      = document.row_frm.myeditor.outputBodyHTML();
	f.map.value    = document.map_frm.myeditor.outputBodyHTML();
/*		
	f.schedule.value    = document.schedule_frm.myeditor.outputBodyHTML();
	f.schedule2.value    = document.schedule2_frm.myeditor.outputBodyHTML();
	f.cost.value      = document.cost_frm.myeditor.outputBodyHTML();
	f.cost2.value      = document.cost2_frm.myeditor.outputBodyHTML();

	f.row2.value      = document.row2_frm.myeditor.outputBodyHTML();

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
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>학교로고</strong></td>
	<td colspan="3"> <?if($data[school_file1_name]){?>
			  <img src=../data/school/<?=$num?>/<?=$data[school_file1_name]?> width="80" height="30" align="absmiddle">
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
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>학교이름</strong></td>
	<td colspan="3"><input name="s_title" type="text" value="<?=$data['s_title']?>" class="cc" size=10> (<input name="title" type="text" value="<?=$data['title']?>" class="cc" size=60>)</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>

<?if($national == 3){?>

  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>1.학교개요</strong> <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_0.display='none';" onclick="dnum(0);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
   <tr id="dismenu_0" style="DISPLAY: none;" >
	<td colspan="4" >
  <table width="100%" cellpadding="0" cellspacing="0">    
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>카테고리</strong></td>
	<td colspan="3">
      <table width="100%" cellpadding="0" cellspacing="0">    
       <tr>
	    <td bgcolor="#FFFFFF" class="a_text_title" ><input type="checkbox" name="sc_typeN[]" value="01" <?=$checked1?>> 스파르타어학원</td>
	    <td bgcolor="#FFFFFF" class="a_text_title" ><input type="checkbox" name="sc_typeN[]" value="02" <?=$checked2?>> 시설 좋은 어학원</td>
	    <td bgcolor="#FFFFFF" class="a_text_title" ><input type="checkbox" name="sc_typeN[]" value="03" <?=$checked3?>> 주변환경 짱 어학원</td>
	    <td bgcolor="#FFFFFF" class="a_text_title" ><input type="checkbox" name="sc_typeN[]" value="04" <?=$checked4?>> 영어기숙사 있는 어학원</td>
       </tr>
       <tr>
	    <td bgcolor="#FFFFFF" class="a_text_title" ><input type="checkbox" name="sc_typeN[]" value="05" <?=$checked5?>>1대1수업이 많은 어학원</td>
	    <td bgcolor="#FFFFFF" class="a_text_title" ><input type="checkbox" name="sc_typeN[]" value="06" <?=$checked6?>> 저렴한 어학원</td>
	    <td bgcolor="#FFFFFF" class="a_text_title" ><input type="checkbox" name="sc_typeN[]" value="07" <?=$checked7?>> 중,소규모어학원</td>
	    <td bgcolor="#FFFFFF" class="a_text_title" ><input type="checkbox" name="sc_typeN[]" value="08" <?=$checked8?>> 대규모어학원</td>
       </tr>
       <tr>
	    <td bgcolor="#FFFFFF" class="a_text_title" ><input type="checkbox" name="sc_typeN[]" value="09" <?=$checked9?>> 국적비율이 좋은 어학원</td>
	    <td bgcolor="#FFFFFF" class="a_text_title" ><input type="checkbox" name="sc_typeN[]" value="10" <?=$checked10?>> 대학부설 어학원</td>
	    <td bgcolor="#FFFFFF" class="a_text_title" ><input type="checkbox" name="sc_typeN[]" value="11" <?=$checked11?>> 다양한 코스</td>
	    <td bgcolor="#FFFFFF" class="a_text_title" ><input type="checkbox" name="sc_typeN[]" value="12" <?=$checked12?>> IELTS</td>
       </tr>
      </table>
	</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>	   
   <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>학교구분</strong></td>
	<td bgcolor="#FFFFFF"><select name="section"  class="select3">
        <?=rg_html_option($_const['section'],$data[section])?>
       </select>
    </td>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>홈페이지</strong></td>
	<td >http://<input name="homepage" type="text" value="<?=$data['homepage']?>" class="cc" size=40></td>
  </tr> 

  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>   

  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>지역/위치</strong></td>
	<td colspan="3"><input name="location" type="text" value="<?=$data['location']?>" class="cc" size=90></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>	
  <tr>
	<td width="130" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>설립연도</strong></td>
	<td width="365" ><input name="open_date" type="text" value="<?=$data['open_date']?>" class="cc" size=10>년</td>
	<td width="130" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>총인원</strong></td>
	<td width="365"><input name="total" type="text" value="<?=$data['total']?>" class="cc" size=10>명</td>
  </tr>	
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>1타임시간</strong></td>
	<td><input name="class_time" type="text" value="<?=$data['class_time']?>" class="cc" size=10>분</td>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>튜터</strong></td>
	<td><input name="teacher_no" type="text" value="<?=$data['teacher_no']?>" class="cc" size=10>명</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>네이티브</strong></td>
	<td><input name="native_class" type="text" value="<?=$data['native_class']?>" class="cc" size=10></td>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>스파르타</strong></td>
	<td><input name="sparta_program" type="text" value="<?=$data['sparta_program']?>" class="cc" size=10></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>	
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>기숙사형태</strong></td>
	<td colspan="3"><input name="dorm_type" type="text" value="<?=$data['dorm_type']?>" class="cc" size=90></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr> 
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>기타시설</strong></td>
	<td colspan="3"><input name="etc_facility" type="text" value="<?=$data['etc_facility']?>" class="cc" size=90></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>  
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>2.학교소개, 특징/TIP</strong> <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_1.display='none';" onclick="dnum(1);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4" id="dismenu_1" style="DISPLAY: none;" >
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
	<td colspan="4" style="padding:15 0 10 5"><strong>3.수업내용 및 상세 프로그램</strong> <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_2.display='none';" onclick="dnum(2);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4" id="dismenu_2" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">   
  <tr>
	<td colspan="4"><input type="hidden" name="program"><iframe src="school_editor02.php?num=<?=$num?>&control=program" width="100%" height="510" frameborder=0 border=0 scrolling=no name="program_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>4.주의사항, 규정, 경고 사항 등</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_3.display='none';" onclick="dnum(3);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>  
  <tr>
	<td colspan="4" id="dismenu_3" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4"><input type="hidden" name="row"><iframe src="school_editor02.php?num=<?=$num?>&control=row" width="100%" height="510" frameborder=0 border=0 scrolling=no name="row_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>	
</table>
</td>
</tr>
  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>5.지도 및 주소/ 현지&서울 연락처</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_4.display='none';" onclick="dnum(4);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
 <tr>
	<td colspan="4" id="dismenu_4" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4"><input type="hidden" name="map"><iframe src="school_editor02.php?num=<?=$num?>&control=map" width="100%" height="510" frameborder=0 border=0 scrolling=no name="map_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>
    <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>6.연수비용</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_5.display='none';" onclick="dnum(5);"  alt=""> (ex. 2345600(O)/2,360,000(X) 모든 금액은 , 없이 적어주세요)</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr> 
 <tr>
 <?//if($k_no or $d_no){?>
<!-- 	<td colspan="4" id="dismenu_5" style="DISPLAY: block;" >-->
<?//}else{?>
	<td colspan="4" id="dismenu_5" style="DISPLAY: none;" >
 <?//}?> 
  <table width="100%" cellpadding="0" cellspacing="0">   
 
<? 
/*
 if($k_no){
	 $k_no = $k_no;
 }else{
	 
 for ($s=1; $s<=8; $s++){
	 
	 if($data_co[pro_name.$s]){
     $k_no = $s;
	 }	 
 }
 }

 if($d_no){
	 $d_no = $d_no;
 }else{
	 
 for ($u=1; $u<=8; $u++){
	 
	 if($data_co[dorm_name.$u]){
     $d_no = $u;
	 }	 
 }
 }
*/
?> 
<!-- 
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>프로그램 수</strong></td>
	<td colspan="3">
<select name="k_no" class="input" id="k_no" onchange="change2(this);" class="select">
    <option >선택</option>
         <?=rg_html_option($_const['no'],$k_no)?>
       </select>
</td>
  </tr>
-->

 <? //for ($k=1; $k<=$k_no; $k++){?> 
 <? for ($k=1; $k<=12; $k++){?> 
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>프로그램<?=$k?></strong></td>
	<td><input name="pro_name<?=$k?>" type="text" value="<?=$data_co[pro_name.$k]?>" class="cc" size=20></td>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>금액<?=$k?></strong></td>
	<td><input name="pro_cost<?=$k?>" type="text" value="<?=$data_co[pro_cost.$k]?>" class="cc" size=10>원</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
<?}?>
  <tr>
	<td height="4" colspan="4"></td>
  </tr>
    <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
<!-- 
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>기숙사 수</strong></td>
	<td colspan="3">
<select name="k_no" class="input" id="d_no" onchange="change3(this);" class="select">
    <option >선택</option>
         <?=rg_html_option($_const['no'],$d_no)?>
       </select>
</td>
  </tr>
   <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr> 
  -->
 <? //for ($j=1; $j<=$d_no; $j++){?> 
 <? for ($j=1; $j<=12; $j++){?> 
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>기숙사<?=$j?></strong></td>
	<td><input name="dorm_name<?=$j?>" type="text" value="<?=$data_co[dorm_name.$j]?>" class="cc" size=20></td>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>금액<?=$j?></strong></td>
	<td><input name="dorm_cost<?=$j?>" type="text" value="<?=$data_co[dorm_cost.$j]?>" class="cc" size=10>원</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
<?}?>
  <tr>
	<td height="4" colspan="4"></td>
  </tr>
    <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>할인금액<?=$j?></strong></td>
	<td colspan="4">8주: <input name="sale_cost8" type="text" value="<?=$data_co[sale_cost8]?>" class="cc" size=7>원 | 12주: <input name="sale_cost12" type="text" value="<?=$data_co[sale_cost12]?>" class="cc" size=7>원 | 16주: <input name="sale_cost16" type="text" value="<?=$data_co[sale_cost16]?>" class="cc" size=7>원 | 20주: <input name="sale_cost20" type="text" value="<?=$data_co[sale_cost20]?>" class="cc" size=7>원 | 24주: <input name="sale_cost24" type="text" value="<?=$data_co[sale_cost24]?>" class="cc" size=7>원</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>

  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>등록비</strong></td>
	<td><input name="iphak_cost" type="text" value="<?=$data_co[iphak_cost]?>" class="cc" size=7>원</td>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>보증금</strong></td>
	<td><input name="deposit_name1" type="text" value="<?=$data_co[deposit_name1]?>" class="cc" size=10> <input name="deposit_cost1" type="text" value="<?=$data_co[deposit_cost1]?>" class="cc" size=7> <select name="deposit_money1" class="select2">
        <?=rg_html_option($_const['money'],$data_co['deposit_money1'])?>
        </select><br><input name="deposit_name2" type="text" value="<?=$data_co[deposit_name2]?>" class="cc" size=10> <input name="deposit_cost2" type="text" value="<?=$data_co[deposit_cost2]?>" class="cc" size=7> <select name="deposit_money2" class="select2">
        <?=rg_html_option($_const['money'],$data_co['deposit_money2'])?>
        </select></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>공항픽업비</strong></td>
	<td>개인: <input name="pickup_cost1" type="text" value="<?=$data_co[pickup_cost1]?>" class="cc" size=7>원 단체: <input name="pickup_cost1" type="text" value="<?=$data_co[pickup_cost1]?>" class="cc" size=7>원</td>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>공항이용료</strong></td>
	<td><input name="phi_out_cost" type="text" value="<?=$data_co[phi_out_cost]?>" class="cc" size=7>페소</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>전기세</strong></td>
	<td><select name="elect_type" class="select2">
        <?=rg_html_option($_const['money_type'],$data_co['elect_type'])?>
        </select><br><input name="elect_name1" type="text" value="<?=$data_co[elect_name1]?>" class="cc" size=10> <input name="elect_cost1" type="text" value="<?=$data_co[elect_cost1]?>" class="cc" size=7>원 <br><input name="elect_name2" type="text" value="<?=$data_co[elect_name2]?>" class="cc" size=10> <input name="elect_cost2" type="text" value="<?=$data_co[elect_cost2]?>" class="cc" size=7>원<br><input name="elect_name3" type="text" value="<?=$data_co[elect_name3]?>" class="cc" size=10> <input name="elect_cost3" type="text" value="<?=$data_co[elect_cost3]?>" class="cc" size=7> 원</td>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>교재비</strong></td>
	<td><input name="book_cost" type="text" value="<?=$data_co[book_cost]?>" class="cc" size=7>원/4주 <select name="book_type" class="select2">
        <?=rg_html_option($_const['money_type'],$data_co['book_type'])?>
        </select></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>SSP발급비</strong></td>
	<td><input name="ssp_cost" type="text" value="<?=$data_co[ssp_cost]?>" class="cc" size=7> <select name="ssp_money" class="select2">
        <?=rg_html_option($_const['money'],$data_co['ssp_money'])?>
        </select></td>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>SSP납부시점</strong></td>
	<td><select name="ssp_type" class="select2">
        <?=rg_html_option($_const['money_type'],$data_co['ssp_type'])?>
        </select></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>비자연장비</strong></td>
	<td colspan="4">1차: <input name="visaextra_cost8" type="text" value="<?=$data_co[visaextra_cost8]?>" class="cc" size=7> | 2차: <input name="visaextra_cost12" type="text" value="<?=$data_co[visaextra_cost12]?>" class="cc" size=7> | 3차: <input name="visaextra_cost16" type="text" value="<?=$data_co[visaextra_cost16]?>" class="cc" size=7> | 4차: <input name="visaextra_cost20" type="text" value="<?=$data_co[visaextra_cost20]?>" class="cc" size=7> | 5차: <input name="visaextra_cost24" type="text" value="<?=$data_co[visaextra_cost24]?>" class="cc" size=7> <select name="visaextra_money" class="select2">
        <?=rg_html_option($_const['money'],$data_co['visaextra_money'])?>
        </select></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>I-CARD</strong></td>
	<td colspan="4"><input name="icard_p" type="text" value="<?=$data_co[icard_p]?>" class="cc" size=10>페소 + <input name="icard_d" type="text" value="<?=$data_co[icard_d]?>" class="cc" size=10>달러</td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td height="4" colspan="4"></td>
  </tr>
    <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>항공료</strong></td>
	<td colspan="4"><input name="air_cost" type="text" value="<?=$data_co[air_cost]?>" class="cc" size=100></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>보험료</strong></td>
	<td colspan="4"><input name="insu_cost" type="text" value="<?=$data_co[insu_cost]?>" class="cc" size=100></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>개인용돈</strong></td>
	<td colspan="4"><input name="permoney" type="text" value="<?=$data_co[permoney]?>" class="cc" size=100></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>교재비</strong></td>
	<td colspan="4"><input name="book_text" type="text" value="<?=$data_co[book_text]?>" class="cc" size=100></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>전기세</strong></td>
	<td colspan="4"><input name="elect_text" type="text" value="<?=$data_co[elect_text]?>" class="cc" size=100></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>비고(프로모션)</strong></td>
	<td colspan="4"><input name="promo" type="text" value="<?=$data_co[promo]?>" class="cc" size=100></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>


  <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>7.이미지</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_6.display='none';" onclick="dnum(6);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
 <tr>
	<td colspan="4" id="dismenu_6" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4" style="padding:15 0 5 5"><strong>학교시설</strong></td>
  </tr>
<? for ($i=2; $i<=9; $i++){?>
   <tr>
    <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>이미지<?=$i-1?>(school_file<?=$i?>)</strong></td>
	<td colspan="4" class="a_s_text_title">	<input name='school_file<?=$i?>' type=file class=cc style='width:40%;'>   &nbsp;&nbsp;                     
						 <?if($data[school_file.$i._name]){?>
                         <img src="../data/school/<?=$num?>/<?=$data[school_file.$i._name]?>" width="60" height="40" align="absmiddle"> <input name='del_file<?=$i?>' type=checkbox id="del_file<?=$i?>" value='1'>삭제 
                          <?}?>
	</td>
  </tr>
<?}?>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4" style="padding:15 0 5 5"><strong>기숙사시설</strong></td>
  </tr>
 <? for ($i=10; $i<=17; $i++){?>
   <tr>
    <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>이미지<?=$i-9?>(school_file<?=$i?>)</strong></td>
	<td colspan="4" class="a_s_text_title">	<input name='school_file<?=$i?>' type=file class=cc style='width:40%;'>   &nbsp;&nbsp;                     
						 <?if($data[school_file.$i._name]){?>
                         <img src="../data/school/<?=$num?>/<?=$data[school_file.$i._name]?>" width="60" height="40" align="absmiddle"> <input name='del_file<?=$i?>' type=checkbox id="del_file<?=$i?>" value='1'>삭제 
                          <?}?>
	</td>
  </tr>
<?}?>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr> 
  <tr>
	<td colspan="4" style="padding:15 0 5 5"><strong>강의실&수업사진</strong></td>
  </tr>
 <? for ($i=18; $i<=25; $i++){?>
   <tr>
    <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>이미지<?=$i-17?>(school_file<?=$i?>)</strong></td>
	<td colspan="4" class="a_s_text_title">	<input name='school_file<?=$i?>' type=file class=cc style='width:40%;'>   &nbsp;&nbsp;                     
						 <?if($data[school_file.$i._name]){?>
                         <img src="../data/school/<?=$num?>/<?=$data[school_file.$i._name]?>" width="60" height="40" align="absmiddle"> <input name='del_file<?=$i?>' type=checkbox id="del_file<?=$i?>" value='1'>삭제 
                          <?}?>
	</td>
  </tr>
<?}?>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr> 
  <tr>
	<td colspan="4" style="padding:15 0 5 5"><strong>액티비티</strong></td>
  </tr>
 <? for ($i=26; $i<=33; $i++){?>
   <tr>
    <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>이미지<?=$i-25?>(school_file<?=$i?>)</strong></td>
	<td colspan="4" class="a_s_text_title">	<input name='school_file<?=$i?>' type=file class=cc style='width:40%;'>   &nbsp;&nbsp;                     
						 <?if($data[school_file.$i._name]){?>
                         <img src="../data/school/<?=$num?>/<?=$data[school_file.$i._name]?>" width="60" height="40" align="absmiddle"> <input name='del_file<?=$i?>' type=checkbox id="del_file<?=$i?>" value='1'>삭제 
                          <?}?>
	</td>
  </tr>
<?}?>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr> 
  <tr>
	<td colspan="4" style="padding:15 0 5 5"><strong>주변전경</strong></td>
  </tr>
 <? for ($i=34; $i<=41; $i++){?>
   <tr>
    <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>이미지<?=$i-33?>(school_file<?=$i?>)</strong></td>
	<td colspan="4" class="a_s_text_title">	<input name='school_file<?=$i?>' type=file class=cc style='width:40%;'>   &nbsp;&nbsp;                     
						 <?if($data[school_file.$i._name]){?>
                         <img src="../data/school/<?=$num?>/<?=$data[school_file.$i._name]?>" width="60" height="40" align="absmiddle"> <input name='del_file<?=$i?>' type=checkbox id="del_file<?=$i?>" value='1'>삭제 
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
	<td colspan="4" style="padding:15 0 10 5"><strong>1.학교개요</strong> <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_0.display='none';" onclick="dnum(0);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
   <tr id="dismenu_0" style="DISPLAY: none;" >
	<td colspan="4" >
  <table width="100%" cellpadding="0" cellspacing="0">    
 
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>주소</strong></td>
	<td colspan="3"><input name="location" type="text" value="<?=$data['location']?>" class="cc" size=90></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>	
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>홈페이지</strong></td>
	<td colspan="3">http://<input name="homepage" type="text" value="<?=$data['homepage']?>" class="cc" size=40></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>	
  <tr>
	<td width="130" bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>학교소개</strong></td>
	<td colspan="3"><input name="native_info" type="text" value="<?=$data['native_info']?>" class="cc" size=90></td>
  </tr>	
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>학생/수업시간</strong></td>
	<td colspan="3"><input name="native_time" type="text" value="<?=$data['native_time']?>" class="cc" size=90></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>입학금/수업료</strong></td>
	<td colspan="3"><input name="native_cost" type="text" value="<?=$data['native_cost']?>" class="cc" size=90></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr>	
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>코스</strong></td>
	<td colspan="3"><input name="native_course" type="text" value="<?=$data['native_course']?>" class="cc" size=90></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="1" colspan="4"></td>
  </tr> 
  <tr>
	<td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>프로모션</strong></td>
	<td colspan="3"><input name="native_promo" type="text" value="<?=$data['native_promo']?>" class="cc" size=90></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>  
</table>
</td>
</tr>
 <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>2.특징</strong> <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_1.display='none';" onclick="dnum(1);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4" id="dismenu_1" style="DISPLAY: none;" >
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
	<td colspan="4" style="padding:15 0 10 5"><strong>3.프로그램</strong> <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_2.display='none';" onclick="dnum(2);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
  <tr>
	<td colspan="4" id="dismenu_2" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">   
  <tr>
	<td colspan="4"><input type="hidden" name="program"><iframe src="school_editor02.php?num=<?=$num?>&control=program" width="100%" height="510" frameborder=0 border=0 scrolling=no name="program_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>

 <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>4.지도 및 주소</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_4.display='none';" onclick="dnum(3);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
 <tr>
	<td colspan="4" id="dismenu_3" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
  <tr>
	<td colspan="4"><input type="hidden" name="map"><iframe src="school_editor02.php?num=<?=$num?>&control=map" width="100%" height="510" frameborder=0 border=0 scrolling=no name="map_frm"></iframe></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
</table>
</td>
</tr>

   <tr>
	<td colspan="4" style="padding:15 0 10 5"><strong>5.이미지</strong>  <img src="./images/sc_more.gif"  align="absmiddle" style="CURSOR: hand" onmouseout="dismenu_6.display='none';" onclick="dnum(4);"  alt=""></td>
  </tr>
  <tr>
	<td bgcolor="#BECCDD" height="2" colspan="4"></td>
  </tr>
 <tr>
	<td colspan="4" id="dismenu_4" style="DISPLAY: none;" >
  <table width="100%" cellpadding="0" cellspacing="0">  
<? for ($i=2; $i<=9; $i++){?>
   <tr>
    <td bgcolor="#FFFFFF" class="a_text_title" style="padding:5pt 2pt 2pt 5pt"><strong>이미지<?=$i-1?></strong></td>
	<td colspan="4" class="a_s_text_title">	<input name='school_file<?=$i?>' type=file class=cc style='width:40%;'>   &nbsp;&nbsp;                     
						 <?if($data[school_file.$i._name]){?>
                         <img src="../data/school/<?=$num?>/<?=$data[school_file.$i._name]?>" width="60" height="40" align="absmiddle"> <input name='del_file<?=$i?>' type=checkbox id="del_file<?=$i?>" value='1'>삭제 
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
<script type="text/javascript">
 function pop()
 {
  window.open('../phil/school_cost.php?&num=<?=$num?>', 'window' ,'toolbar=no,width=400,height=550,fullscreen=no,directories=no,status=no,scrollbars=yes,resize=no,menubar=no,location=no');
 }   
</script>