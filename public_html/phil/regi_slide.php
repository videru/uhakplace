<?
	include_once("../include/lib.php");
    
	
    $rs_list = new $rs_class($dbcon);
	$rs_list->clear();
	$rs_list->set_table($_table['real_regi']);
            
?>
<?
	if($rs_list->num_rows()<1) {
		echo "
	<tr height=\"40\">
		<td align=\"center\"><B>등록(검색) 된 자료가 없습니다.</td>
	</tr>";
	}
	
	$rs_mb=new $rs_class($dbcon);
	$rs_mb->set_table($_table['real_regi']);	
	while($R=$rs_list->fetch()) {


?>
<link rel="stylesheet" href="../css/style.css" type="text/css">
								<script language = "javascript">
                                	var html,total_area=0,wait_flag=true;
                                	var bMouseOver = 1;
                                	var scrollspeed =1;
                                	var scrollerheight=16;
                                	var waitingtime = 2000;
                                	var scroll_content = new Array();
                                	
                                	function startscroll(){
                                		for(i in scroll_content)insert_area(total_area++); 
                                		window.setTimeout("scrolling()",waitingtime);
                                	}
                                	function scrolling(){
                                		if( bMouseOver && wait_flag ){ 
                                			for( i=0; i<total_area; i++){
                                				tmp = document.getElementById('scroll_area'+i).style;
                                				tmp.top = parseInt(tmp.top) - scrollspeed;
                                				if(parseInt(tmp.top) <= -scrollerheight){
                                					tmp.top = scrollerheight * (total_area-1);
                                					wait_flag = false;
                                					window.setTimeout("wait_flag=true;",waitingtime);
                                				}
                                			}
                                		}
                                		window.setTimeout("scrolling()",1);
                                		
                                	}
                                	function insert_area(n){
                                		html='<div style="left: 0px; width: 220; position: absolute; top: '+(scrollerheight*n)+'px" id="scroll_area'+n+'">';
                                    		html+=scroll_content[n]+'';
                                    		html+='</div>';
                                    		document.write(html);
                                	}
	
                                	
                                	scroll_content[0] = "<img src=../img/main_real_national<?=$R[v1_national]?>.gif>&nbsp;<?=$R[v1]?>";
                                	scroll_content[1] = "<img src=../img/main_real_national<?=$R[v2_national]?>.gif>&nbsp;<?=$R[v2]?>";
                                	scroll_content[2] = "<img src=../img/main_real_national<?=$R[v3_national]?>.gif>&nbsp;<?=$R[v3]?>";
                                    scroll_content[3] = "<img src=../img/main_real_national<?=$R[v4_national]?>.gif>&nbsp;<?=$R[v4]?>";
									scroll_content[4] = "<img src=../img/main_real_national<?=$R[v5_national]?>.gif>&nbsp;<?=$R[v5]?>";
                                	scroll_content[5] = "<img src=../img/main_real_national<?=$R[v6_national]?>.gif>&nbsp;<?=$R[v6]?>";
                                	scroll_content[6] = "<img src=../img/main_real_national<?=$R[v7_national]?>.gif>&nbsp;<?=$R[v7]?>";
                                    scroll_content[7] = "<img src=../img/main_real_national<?=$R[v8_national]?>.gif>&nbsp;<?=$R[v8]?>";
									scroll_content[8] = "<img src=../img/main_real_national<?=$R[v9_national]?>.gif>&nbsp;<?=$R[v9]?>";
                                	scroll_content[9] = "<img src=../img/main_real_national<?=$R[v10_national]?>.gif>&nbsp;<?=$R[v10]?>";	
	                               	scroll_content[10] = "<img src=../img/main_real_national<?=$R[v11_national]?>.gif>&nbsp;<?=$R[v11]?>";
                                	scroll_content[11] = "<img src=../img/main_real_national<?=$R[v12_national]?>.gif>&nbsp;<?=$R[v12]?>";
                                	scroll_content[12] = "<img src=../img/main_real_national<?=$R[v13_national]?>.gif>&nbsp;<?=$R[v13]?>";
                                    scroll_content[13] = "<img src=../img/main_real_national<?=$R[v14_national]?>.gif>&nbsp;<?=$R[v14]?>";
									scroll_content[14] = "<img src=../img/main_real_national<?=$R[v15_national]?>.gif>&nbsp;<?=$R[v15]?>";
                                	scroll_content[15] = "<img src=../img/main_real_national<?=$R[v16_national]?>.gif>&nbsp;<?=$R[v16]?>";
                                	scroll_content[16] = "<img src=../img/main_real_national<?=$R[v17_national]?>.gif>&nbsp;<?=$R[v17]?>";
                                    scroll_content[17] = "<img src=../img/main_real_national<?=$R[v18_national]?>.gif>&nbsp;<?=$R[v18]?>";
									scroll_content[18] = "<img src=../img/main_real_national<?=$R[v19_national]?>.gif>&nbsp;<?=$R[v19]?>";
                                	scroll_content[19] = "<img src=../img/main_real_national<?=$R[v20_national]?>.gif>&nbsp;<?=$R[v20]?>";									
								</script>
                                
                                	<span style="width: 220; position: relative; height=100%" id="main2">
                                    <div style="left: 0px; width: 320; clip: rect(0px 220 145px 0px); position: absolute; top: 0px; height: 145px" onMouseover="bMouseOver=0" onMouseout="bMouseOver=1" id="scroll_image">                               
									  
									  
									  <script>
                                        startscroll();
                                      </script>
                                    </div>
                                  </span>
  	<?
	}
	?>