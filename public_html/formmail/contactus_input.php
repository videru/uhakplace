<?
###############################
#Coded By. ����������         #
#Coded. 2002/9/24             #
#Update. 2005/6/30            #
###############################

include "config.php";

if(!$name){
	error_back('�̸��� �Է��ϼ���');
	exit;
}

if(!$text){
	error_back('������ �Է��ϼ���');
	exit;
}
if(!file_exists("data/count.txt")){
	$fp = fopen("data/count.txt", "w"); #������ ����
	fwrite($fp, "0");
	fclose($fp);
	chmod("data/count.txt", 0777);
}

$files = file("data/count.txt");
$count = $files[0];
$number = $count+1;

$time = date("Y�� m�� d�� a h�� i��");

$fp = fopen("data/$number.txt", "w"); #������ ����
fwrite($fp, "��¥: $time\n");
fwrite($fp, "�̸�: $name\n");
fwrite($fp, "E-Mail: $mail\n");
fwrite($fp, "����ó: $tel\n");
fwrite($fp, "�����������: $e1\n");
fwrite($fp, "�����Ⱓ: $p4\n");
fwrite($fp, "�����ⱹ�ñ�: $p1\n");
fwrite($fp, "[����]\n$text");
fclose($fp);
$fp = fopen("data/count.txt", "w"); #������ ����
fwrite($fp, "$number");
fclose($fp);
	 
	 echo "<center><font color=blue>�¶��� ��� ��û�� ���������� �����Ǿ����ϴ�.
		<script language=javascript>
			setTimeout('window.close()', 3000);
		</script>
			";
		exit;
?>