<?

include_once("../include/lib.php");
include_once('../include/config_new.php');




$str="";
$nationalcode = $_GET['nationalcode'];
$state = $_GET['state'];


if ($nationalcode==1) {
	$area = $_const['area1']; // ������������
}elseif($nationalcode==2) {
	$area = $_const['area2']; // ȣ������
}elseif($nationalcode==3) {
	$area = $_const['area3']; //�ʸ�������
}elseif($nationalcode==4) {
	$area = $_const['area4']; // ��������
}elseif($nationalcode==5) {
	$area = $_const['area5']; // ĳ��������
}elseif($nationalcode==6) {
	$area = $_const['area6']; // �̱�����
}





if($nationalcode)
{
	if($state ==null)//�� ã��
	{
		 for($i=0;$i<sizeof($_const['state'][$nationalcode]);$i++)
		 { 
		 	if($_const['state'][$nationalcode][$i])
		 		$str.=$_const['state'][$nationalcode][$i]."--__--";
		 }
		 
		 echo "$str";
	}
	else//����ã��
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
		 echo $str;
	}
	
}
else if($state)
{

}
 
?>