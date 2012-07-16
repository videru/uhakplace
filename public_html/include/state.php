<?

include_once("../include/lib.php");
include_once('../include/config_new.php');




$str="";
$nationalcode = $_GET['nationalcode'];
$state = $_GET['state'];
$city = $_GET['city'];

if ($nationalcode==1) {
	$area = $_const['area1']; // �������
}elseif($nationalcode==2) {
	$area = $_const['area2']; // ȣ����
}elseif($nationalcode==3) {
	$area = $_const['area3']; //�ʸ�����
}elseif($nationalcode==4) {
	$area = $_const['area4']; // ������
}elseif($nationalcode==5) {
	$area = $_const['area5']; // ĳ������
}elseif($nationalcode==6) {
	$area = $_const['area6']; // �̱���
}





if($nationalcode)
{
	if($nationalcode == 3)//�ʸ���
	{
		
		if($city != null)//�б� ã��
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
						$str.="{".'"index"'.":".($i+1).",".'"name"'.":".'"'.$name.'"'."}";
						if($i != sizeof($_const['area3'])-1)
							$str.=",";
					}
				
			}
			$str.="]}";
		}
		echo "$str";
	}
	else//�ʸ����̿�
	{
		if($state ==null)//�� ã��
		{
			for($i=0;$i<=sizeof($_const['state'][$nationalcode]);$i++)
			{
				if($_const['state'][$nationalcode][$i])
					$str.=$_const['state'][$nationalcode][$i]."--__--";
			}
			
			
		}
		else//����ã��
		{
			if($city != null)//�б� ã��
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
				$str.="{".'"index"'.":".($i).",".'"name"'.":".'"'.$name.'"'."}";
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