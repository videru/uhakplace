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
		<td align=\"center\"><B>���(�˻�) �� �ڷᰡ �����ϴ�.</td>
	</tr>";
	}
	
	$rs_mb=new $rs_class($dbcon);
	$rs_mb->set_table($_table['real_regi']);	
	while($R=$rs_list->fetch()) {


?>
<link rel="stylesheet" href="../css/style.css" type="text/css">
<style>
.scroll_area
{
	margin-left: 28px;
}
.tt4
{
	display:block;
	width:110px;
	alignment-baseline:center;
	overflow:hidden;
}
</style>
								<script language = "javascript">
                                	var html,wait_flag=true;
                                	var bMouseOver = 1;
                                	var content_num_a_page =4;
                                	var scrollspeed =1;
                                	var scrollerheight=100;
                                	var waitingtime = 2000;
                                	var scroll_content = new Array();
                                	var area_cnt;
                                	function startscroll(){
                                		area_cnt= Math.ceil(scroll_content.length /content_num_a_page);
                                		var j;
                                		for(j=0;j<area_cnt;j++)insert_area(j); 
                                		window.setTimeout("scrolling()",waitingtime);
                                	}
                                	function scrolling(){
                                		 if( bMouseOver && wait_flag ){ 
                                			var j;
                                			for( j=0; j<area_cnt; j++){
                                				tmp = document.getElementById('scroll_area'+j).style;
                                				tmp.top = parseInt(tmp.top) - scrollspeed;
                                				if(parseInt(tmp.top) <= -scrollerheight){
                                					tmp.top = scrollerheight * (area_cnt-1);
                                					wait_flag = false;
                                					window.setTimeout("wait_flag=true;",waitingtime);
                                				}
                                			}
                                		}
                                		window.setTimeout("scrolling()",1);
                                		
                                	}
                                	function insert_area(n){
                                		
                                		var j;
                                		try {
	                                		html='<div style="left: 0px; width: 470;overflow:hidden; position: absolute; top: '+(scrollerheight*n)+'px" class="scroll_area" id="scroll_area'+n+'">';
	                                    	
	                                    	html+='<table height=100% cellpadding=0 cellspacing=0><tr>';
	                                    	for(j=n*content_num_a_page;j<(n+1)*content_num_a_page;j++)
	                                    	{
	                                    		if(j<scroll_content.length)
	                                    		{
	                                    			html+='<td width=117px style=left:0px;overflow:hidden>';
	                                    			html+=scroll_content[j]+'';
	                                    			html+='</td>';
	                                    		}
	                                    	}
	                                    		
	                                    		
	                                    	html+='</tr></table></div>';
	                                    	document.write(html);
	                                    }
	                                    catch(e)
	                                    {
	                                    	alert(e);
	                                    }
                                	}
	
                                	
                                	scroll_content[0] = "<table width=100% cellpadding=0 cellspacing=0><tr><td align=center width=75><a href=../phil/school_view.php?num=4&national=3 target=_parent><img src=../img/banner/main_bs_cia.gif border=0></a></td></tr><tr><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>���� / ��Ÿ� ��ġ, SM ������ ���� 2���̸�...</a></span></td></tr></table>";
                                	scroll_content[1] = "<table width=100% cellpadding=0 cellspacing=0><tr><td align=center width=75><a href=../phil/school_view.php?num=11&national=3 target=_parent><img src=../img/banner/main_bs_sme.gif border=0></a></td></tr><tr><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>���� / Ŭ���� ���۽��� �ó� ��Ÿ� ������ ...</a></span></td></tr></table>";
                                	 scroll_content[2] = "<table width=100% cellpadding=0 cellspacing=0><tr><td align=center width=75><a href=../phil/school_view.php?num=12&national=3 target=_parent><img src=../img/banner/main_bs_cdu.gif border=0></a></td></tr><tr><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>���� / Park Mall ���� 5�� �Ÿ��̸� ����...</a></span></td></tr></table>";
                                     scroll_content[3] = "<table width=100% cellpadding=0 cellspacing=0><tr><td align=center width=75><a href=../phil/school_view.php?num=9&national=3 target=_parent><img src=../img/banner/main_bs_mtm.gif border=0></a></td></tr><tr><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>���� / �Ż�������� ��ġ�ϸ� ����, ȯ����, �Ĵ�,...</a></span></td></tr></table>";
									 scroll_content[4] = "<table width=100% cellpadding=0 cellspacing=0><tr><td align=center width=75><a href=../phil/school_view.php?num=17&national=3 target=_parent><img src=../img/banner/main_bs_cnn.gif border=0></a></td></tr><tr><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>���Ҷ� / ���������� ���Ҷ� ������ Memorial ...</a></span></td></tr></table>";
                                	 scroll_content[5] = "<table width=100% cellpadding=0 cellspacing=0><tr><td align=center width=75><a href=../phil/school_view.php?num=20&national=3 target=_parent><img src=../img/banner/main_bs_apc.gif border=0></a></td></tr><tr><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>���Ҷ� / ��� �������� ��ġ�ϰ� ����(���Ҷ� ����...</a></span></td></tr></table>";
                                	 scroll_content[6] = "<table width=100% cellpadding=0 cellspacing=0><tr><td align=center width=75><a href=../phil/school_view.php?num=19&national=3 target=_parent><img src=../img/banner/main_bs_c21.gif border=0></a></td></tr><tr><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>C21 ���� �������� Century21�� �����̸� 1999...</a></span></td></tr></table>";
                                     scroll_content[7] = "<table width=100% cellpadding=0 cellspacing=0><tr><td align=center width=75><a href=../phil/school_view.php?num=25&national=3 target=_parent><img src=../img/banner/main_bs_jels.gif border=0></a></td></tr><tr><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>�Ҽ� ��� �� �б��� ������ ���� 1��1 ����...</a></span></td></tr></table>";
									 scroll_content[8] = "<table width=100% cellpadding=0 cellspacing=0><tr><td align=center width=75><a href=../phil/school_view.php?num=21&national=3 target=_parent><img src=../img/banner/main_bs_help.gif border=0></a></td></tr><tr><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>�ʸ��ɿ��� ���ʷ� ���ĸ�Ÿ �ý��� Ŀ��ŧ���� ����...</a></span></td></tr></table>";
                                	 scroll_content[9] = "<table width=100% cellpadding=0 cellspacing=0><tr><td align=center width=75><a href=../phil/school_view.php?num=23&national=3 target=_parent><img src=../img/banner/main_bs_monol.gif border=0></a></td></tr><tr><td><a href=../phil/school_view.php?num=4&national=3 target=_parent><span class=tt4>4���� ���ĸ�ŸĿ��ŧ������ �����Ǵ� �� ���п�...</a></span></td></tr></table>";					
// 								
								</script>
                                
                                	
                                    <div style="left: 0px; width: 527;clip: rect(0px 527px 306px 0px); position: absolute; top: 0px; height: 306px" onMouseover="bMouseOver=0" onMouseout="bMouseOver=1" id="scroll_image">                               
									  
									  
									  <script>
                                        startscroll();
                                      </script>
                                    </div>
                                  
  	<?
	}
	?>
