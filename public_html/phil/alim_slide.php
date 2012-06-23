<?
	include_once("../include/lib.php");
    	
	$rs_list = new $rs_class($dbcon);
	$rs_list->clear();	
	$rs_list->set_table($_table['alim']);

	$rs_list->add_order("num DESC");	
	$rs_list->limit ="10";		
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
                                	var scrollerheight=18;
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
                                		html='<div style="left: 0px; width: 200; position: absolute; top: '+(scrollerheight*n)+'px" id="scroll_area'+n+'">';
                                    		html+=scroll_content[n]+'';
                                    		html+='</div>';
                                    		document.write(html);
                                	}
	
                                	
                                	scroll_content[0] = "<?=$text[0]?>";
                                	scroll_content[1] = "<?=$text[1]?>";
                                	scroll_content[2] = "<?=$text[2]?>";
                                    scroll_content[3] = "<?=$text[3]?>";
									scroll_content[4] = "<?=$text[4]?>";
                                	scroll_content[5] = "<?=$text[5]?>";
                                	scroll_content[6] = "<?=$text[6]?>";
                                    scroll_content[7] = "<?=$text[7]?>";
									scroll_content[8] = "<?=$text[8]?>";
                                	scroll_content[9] = "<?=$text[9]?>";	

								</script>
                                
                                	<span style="width: 200; position: relative; height=100%" id="main2">
                                    <div style="left: 0px; width: 200; clip: rect(0px 200 54x 0px); position: absolute; top: 0px; height: 54px" onMouseover="bMouseOver=0" onMouseout="bMouseOver=1" id="scroll_image">                               
									  
									  
									  <script>
                                        startscroll();
                                      </script>
                                    </div>
                                  </span>