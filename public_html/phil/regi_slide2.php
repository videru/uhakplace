<?
	include_once("../include/lib.php");
    	
	$rs_list = new $rs_class($dbcon);
	$rs_list->clear();	
	$rs_list->set_table($_table['main_regi']);

	$rs_list->add_order("num DESC");	
	$rs_list->limit ="50";		
	$k=0;	
	while($R=$rs_list->fetch()) {
	$national[$k] = $R[national];
	$text[$k] = rg_cut_string($R[text], 31) ;
	$k++;
	}	
	
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
	
                                	
                                	scroll_content[0] = "<img src=../img/main_real_national<?=$national[0]?>.gif>&nbsp;<?=$text[0]?>";
                                	scroll_content[1] = "<img src=../img/main_real_national<?=$national[1]?>.gif>&nbsp;<?=$text[1]?>";
                                	scroll_content[2] = "<img src=../img/main_real_national<?=$national[2]?>.gif>&nbsp;<?=$text[2]?>";
                                    scroll_content[3] = "<img src=../img/main_real_national<?=$national[3]?>.gif>&nbsp;<?=$text[3]?>";
									scroll_content[4] = "<img src=../img/main_real_national<?=$national[4]?>.gif>&nbsp;<?=$text[4]?>";
                                	scroll_content[5] = "<img src=../img/main_real_national<?=$national[5]?>.gif>&nbsp;<?=$text[5]?>";
                                	scroll_content[6] = "<img src=../img/main_real_national<?=$national[6]?>.gif>&nbsp;<?=$text[6]?>";
                                    scroll_content[7] = "<img src=../img/main_real_national<?=$national[7]?>.gif>&nbsp;<?=$text[7]?>";
									scroll_content[8] = "<img src=../img/main_real_national<?=$national[8]?>.gif>&nbsp;<?=$text[8]?>";
                                	scroll_content[9] = "<img src=../img/main_real_national<?=$national[9]?>.gif>&nbsp;<?=$text[9]?>";	
	                               	scroll_content[10] = "<img src=../img/main_real_national<?=$national[10]?>.gif>&nbsp;<?=$text[10]?>";
                                	scroll_content[11] = "<img src=../img/main_real_national<?=$national[11]?>.gif>&nbsp;<?=$text[11]?>";
                                	scroll_content[12] = "<img src=../img/main_real_national<?=$national[12]?>.gif>&nbsp;<?=$text[12]?>";
                                    scroll_content[13] = "<img src=../img/main_real_national<?=$national[13]?>.gif>&nbsp;<?=$text[13]?>";
									scroll_content[14] = "<img src=../img/main_real_national<?=$national[14]?>.gif>&nbsp;<?=$text[14]?>";
                                	scroll_content[15] = "<img src=../img/main_real_national<?=$national[15]?>.gif>&nbsp;<?=$text[15]?>";
                                	scroll_content[16] = "<img src=../img/main_real_national<?=$national[16]?>.gif>&nbsp;<?=$text[16]?>";
                                    scroll_content[17] = "<img src=../img/main_real_national<?=$national[17]?>.gif>&nbsp;<?=$text[17]?>";
									scroll_content[18] = "<img src=../img/main_real_national<?=$national[18]?>.gif>&nbsp;<?=$text[18]?>";
                                	scroll_content[19] = "<img src=../img/main_real_national<?=$national[19]?>.gif>&nbsp;<?=$text[19]?>";			
		                            scroll_content[20] = "<img src=../img/main_real_national<?=$national[20]?>.gif>&nbsp;<?=$text[20]?>";
                                	scroll_content[21] = "<img src=../img/main_real_national<?=$national[21]?>.gif>&nbsp;<?=$text[21]?>";
                                	scroll_content[22] = "<img src=../img/main_real_national<?=$national[22]?>.gif>&nbsp;<?=$text[22]?>";
                                    scroll_content[23] = "<img src=../img/main_real_national<?=$national[23]?>.gif>&nbsp;<?=$text[23]?>";
									scroll_content[24] = "<img src=../img/main_real_national<?=$national[24]?>.gif>&nbsp;<?=$text[24]?>";
                                	scroll_content[25] = "<img src=../img/main_real_national<?=$national[25]?>.gif>&nbsp;<?=$text[25]?>";
                                	scroll_content[26] = "<img src=../img/main_real_national<?=$national[26]?>.gif>&nbsp;<?=$text[26]?>";
                                    scroll_content[27] = "<img src=../img/main_real_national<?=$national[27]?>.gif>&nbsp;<?=$text[27]?>";
									scroll_content[28] = "<img src=../img/main_real_national<?=$national[28]?>.gif>&nbsp;<?=$text[28]?>";
                                	scroll_content[29] = "<img src=../img/main_real_national<?=$national[29]?>.gif>&nbsp;<?=$text[29]?>";	
	                               	scroll_content[30] = "<img src=../img/main_real_national<?=$national[30]?>.gif>&nbsp;<?=$text[30]?>";
                                	scroll_content[31] = "<img src=../img/main_real_national<?=$national[31]?>.gif>&nbsp;<?=$text[31]?>";
                                	scroll_content[32] = "<img src=../img/main_real_national<?=$national[32]?>.gif>&nbsp;<?=$text[32]?>";
                                    scroll_content[33] = "<img src=../img/main_real_national<?=$national[33]?>.gif>&nbsp;<?=$text[33]?>";
									scroll_content[34] = "<img src=../img/main_real_national<?=$national[34]?>.gif>&nbsp;<?=$text[34]?>";
                                	scroll_content[35] = "<img src=../img/main_real_national<?=$national[35]?>.gif>&nbsp;<?=$text[35]?>";
                                	scroll_content[36] = "<img src=../img/main_real_national<?=$national[36]?>.gif>&nbsp;<?=$text[36]?>";
                                    scroll_content[37] = "<img src=../img/main_real_national<?=$national[37]?>.gif>&nbsp;<?=$text[37]?>";
									scroll_content[38] = "<img src=../img/main_real_national<?=$national[38]?>.gif>&nbsp;<?=$text[38]?>";
                                	scroll_content[39] = "<img src=../img/main_real_national<?=$national[39]?>.gif>&nbsp;<?=$text[39]?>";			
									scroll_content[40] = "<img src=../img/main_real_national<?=$national[40]?>.gif>&nbsp;<?=$text[40]?>";
                                	scroll_content[41] = "<img src=../img/main_real_national<?=$national[41]?>.gif>&nbsp;<?=$text[41]?>";
                                	scroll_content[42] = "<img src=../img/main_real_national<?=$national[42]?>.gif>&nbsp;<?=$text[42]?>";
                                    scroll_content[43] = "<img src=../img/main_real_national<?=$national[43]?>.gif>&nbsp;<?=$text[43]?>";
									scroll_content[44] = "<img src=../img/main_real_national<?=$national[44]?>.gif>&nbsp;<?=$text[44]?>";
                                	scroll_content[45] = "<img src=../img/main_real_national<?=$national[45]?>.gif>&nbsp;<?=$text[45]?>";
                                	scroll_content[46] = "<img src=../img/main_real_national<?=$national[46]?>.gif>&nbsp;<?=$text[46]?>";
                                    scroll_content[47] = "<img src=../img/main_real_national<?=$national[47]?>.gif>&nbsp;<?=$text[47]?>";
									scroll_content[48] = "<img src=../img/main_real_national<?=$national[48]?>.gif>&nbsp;<?=$text[48]?>";
                                	scroll_content[49] = "<img src=../img/main_real_national<?=$national[49]?>.gif>&nbsp;<?=$text[49]?>";					

								</script>
                                
                                	<span style="width: 220; position: relative; height=100%" id="main2">
                                    <div style="left: 0px; width: 320; clip: rect(0px 220 145px 0px); position: absolute; top: 0px; height: 145px" onMouseover="bMouseOver=0" onMouseout="bMouseOver=1" id="scroll_image">                               
									  
									  
									  <script>
                                        startscroll();
                                      </script>
                                    </div>
                                  </span>