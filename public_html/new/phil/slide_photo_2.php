<?
	include_once("../include/lib.php");

	
	$rs_list = new $rs_class($dbcon);
	$rs_list->clear();	
	$rs_list->set_table($_table['bbs_body']);
	$rs_list->add_where("bbs_db_num = '12'");		
	$rs_list->add_where("cat_num = '35'");			
	$rs_list->add_order("bd_write_date DESC, bd_next_num DESC");	
	$rs_list->limit ="4";		
	$k=0;	
	while($R=$rs_list->fetch()) {
	$Ktitle[$k] = $R[bd_subject];
	$Kidx[$k] = $R[bd_num];

	$Kcomment[$k] = $R[bd_comment_count ];
	$k++;
	}	
	
            
?>
<style type="text/css">
<!--
body {
	background-color: #FFF;
}

td { font-size: 12px; line-height: 160%; color: #3F3E3E; font-family: "±¼¸²";}
p { font-size: 12px; line-height: 160%; color: #3F3E3E; font-family: "±¼¸²";}
div { font-size: 12px; line-height: 160%; color: #3F3E3E; font-family: "±¼¸²";}
A:link {
	FONT-SIZE: 12px;
	COLOR: #2E2E2E;
	FONT-FAMILY: µ¸¿ò,verdana;
	TEXT-DECORATION: none;
	line-height: 17px;
}
A:visited {
	FONT-SIZE: 12px;
	COLOR: #2E2E2E;
	FONT-FAMILY: µ¸¿ò,verdana;
	TEXT-DECORATION: none;
	line-height: 17px;
}
A:hover {
	FONT-SIZE: 12px;
	COLOR: #4665AA;
	FONT-FAMILY: µ¸¿ò,verdana;
	TEXT-DECORATION: none;
	line-height: 17px;
}
-->
</style>
								<script language = "javascript">
                                	var html,total_area=0,wait_flag=true;
                                	var bMouseOver = 1;
                                	var scrollspeed =2;
                                	var scrollerheight=52;
                                	var waitingtime = 3000;
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
                                		html='<div style="left: 0px; width: 221; position: absolute; top: '+(scrollerheight*n)+'px" id="scroll_area'+n+'">';
                                    		html+=scroll_content[n]+'';
                                    		html+='</div>';
                                    		document.write(html);
                                	}
	
                                	
                                	scroll_content[0] = "<table width=100% cellpadding=0 cellspacing=0><tr><td width=75><a href=../board/view.php?bbs_code=interview&bd_num=<?=$Kidx[0]?> target=_parent><img src=../img/banner/movie6.gif width=70 height=50 border=0></a></td><td><a href=../board/view.php?bbs_code=interview&bd_num=<?=$Kidx[0]?> target=_parent><?=$Ktitle[0]?> <font color=blue>[<?=$Kcomment[0]?>]</font></a></td></tr></table>";
                                	scroll_content[1] = "<table width=100% cellpadding=0 cellspacing=0><tr><td width=75><a href=../board/view.php?bbs_code=interview&bd_num=<?=$Kidx[1]?> target=_parent><img src=../img/banner/movie7.gif width=70 height=50 border=0></a></td><td><a href=../board/view.php?bbs_code=interview&bd_num=<?=$Kidx[1]?> target=_parent><?=$Ktitle[1]?>  <font color=blue>[<?=$Kcomment[1]?>]</font></a></td></tr></table>";
                                	scroll_content[2] = "<table width=100% cellpadding=0 cellspacing=0><tr><td width=75><a href=../board/view.php?bbs_code=interview&bd_num=<?=$Kidx[2]?> target=_parent><img src=../img/banner/movie8.gif width=70 height=50 border=0></a></td><td><a href=../board/view.php?bbs_code=interview&bd_num=<?=$Kidx[2]?> target=_parent><?=$Ktitle[2]?>  <font color=blue>[<?=$Kcomment[2]?>]</font></a></td></tr></table>";
                                    scroll_content[3] = "<table width=100% cellpadding=0 cellspacing=0><tr><td width=75><a href=../board/view.php?bbs_code=interview&bd_num=<?=$Kidx[3]?> target=_parent><img src=../img/banner/movie9.gif width=70 height=50 border=0></a></td><td><a href=../board/view.php?bbs_code=interview&bd_num=<?=$Kidx[3]?> target=_parent><?=$Ktitle[3]?>  <font color=blue>[<?=$Kcomment[3]?>]</font></a></td></tr></table>";
											</script>
                                
                                	<span style="width: 221; position: relative; height=100%" id="main2">
                                    <div style="left: 0px; width: 221; clip: rect(0px 221 50px 0px); position: absolute; top: 0px; height: 50px" onMouseover="bMouseOver=0" onMouseout="bMouseOver=1" id="scroll_image">
                                      <script>
                                        startscroll();
                                      </script>
                                    </div>
                                  </span>
