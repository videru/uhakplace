<?

include_once("../include/lib.php");
include_once('../include/config_new.php');




$str="";
$nationalcode = $_GET['nationalcode'];
$state = $_GET['state'];
$city = $_GET['city'];

if ($nationalcode==1) {
	$area = $_const['area1']; // 뉴질랜드지역
}elseif($nationalcode==2) {
	$area = $_const['area2']; // 호주지역
}elseif($nationalcode==3) {
	$area = $_const['area3']; //필리핀지역
}elseif($nationalcode==4) {
	$area = $_const['area4']; // 영국지역
}elseif($nationalcode==5) {
	$area = $_const['area5']; // 캐나다지역
}elseif($nationalcode==6) {
	$area = $_const['area6']; // 미국지역
}





if($nationalcode)
{
	if($nationalcode == 3)//필리핀
	{
		
		if($city != null)//학교 찾기
		{
			$rs_list = new $rs_class($dbcon);
			$rs_list->clear();
			$rs_list->set_table($_table['school']);
			if($nationalcode==3){
				$rs_list->add_where("national = 3");
			}else{
				$rs_list->add_where("national = $nationalcode" );
			}
				
				
			if($city){
					
				$rs_list->add_where("area = $city");
			}
				
			$rs_list->add_order("num asc");
				
			$str='{"schools":[';
			while($R=$rs_list->fetch()) {
				$str.="{".'"num"'.":".$R[num].",".'"title"'.":".'"'.$R[title].'"'."},";
				
			}
			$str = substr($str, 0, strlen($str)-1);
			$str.="]}";
		}else
		{
			$str='{"cities":[';
			for($i=0;$i<=sizeof($_const['area3']);$i++)
			{
				
				
					if($_const['area3'][$i])
					{
						$name=$_const['area3'][$i];
						$str.="{".'"index"'.":".$i.",".'"name"'.":".'"'.$name.'"'."}";
						if($i != sizeof($_const['area3'])-1)
							$str.=",";
					}
				
			}
			$str.="]}";
		}
		echo "$str";
	}
	else//필리핀이외
	{
		if($state ==null)//주 찾기
		{
			for($i=0;$i<=sizeof($_const['state'][$nationalcode]);$i++)
			{
				if($_const['state'][$nationalcode][$i])
					$str.=$_const['state'][$nationalcode][$i]."--__--";
			}
			
			
		}
		else//도시찾기
		{
			if($city != null)//학교 찾기
			{
				$rs_list = new $rs_class($dbcon);
				$rs_list->clear();
				$rs_list->set_table($_table['school']);
				if($nationalcode==3){
					$rs_list->add_where("national = 3");
				}else{
					$rs_list->add_where("national = $nationalcode" );
				}
				
				
				if($city){
						
					$rs_list->add_where("area = $city");
				}
				
				$rs_list->add_order("num asc");
				
				$str='{"schools":[';
				while($R=$rs_list->fetch()) {
					$str.="{".'"num"'.":".$R[num].",".'"title"'.":".'"'.$R[title].'"'."},";
				
				}
				$str = substr($str, 0, strlen($str)-1);
				$str.="]}";
			}
			else
			{
				$str='{"cities":[';
				for($i=0;$i<sizeof($_const['statecitynum'][$nationalcode][$state]);$i++)
				{
				
				$name= $area[$_const['statecitynum'][$nationalcode][$state][$i]];
				$str.="{".'"index"'.":".$i.",".'"name"'.":".'"'.$name.'"'."}";
				if($i != sizeof($_const['statecitynum'][$nationalcode][$state])-1)
					$str.=",";
				}
				$str.="]}";
				
			}
			
		}
		echo "$str";
	}
	
	
}
else if($state)
{

}
 
?>