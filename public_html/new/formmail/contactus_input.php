<?
###############################
#Coded By. 샤프라이플         #
#Coded. 2002/9/24             #
#Update. 2005/6/30            #
###############################

include "config.php";

if(!$name){
	error_back('이름을 입력하세요');
	exit;
}

if(!$text){
	error_back('내용을 입력하세요');
	exit;
}
if(!file_exists("data/count.txt")){
	$fp = fopen("data/count.txt", "w"); #데이터 생성
	fwrite($fp, "0");
	fclose($fp);
	chmod("data/count.txt", 0777);
}

$files = file("data/count.txt");
$count = $files[0];
$number = $count+1;

$time = date("Y년 m월 d일 a h시 i분");

$fp = fopen("data/$number.txt", "w"); #데이터 생성
fwrite($fp, "날짜: $time\n");
fwrite($fp, "이름: $name\n");
fwrite($fp, "E-Mail: $mail\n");
fwrite($fp, "연락처: $tel\n");
fwrite($fp, "연수희망과정: $e1\n");
fwrite($fp, "연수기간: $p4\n");
fwrite($fp, "예상출국시기: $p1\n");
fwrite($fp, "[내용]\n$text");
fclose($fp);
$fp = fopen("data/count.txt", "w"); #데이터 생성
fwrite($fp, "$number");
fclose($fp);
	 
	 echo "<center><font color=blue>온라인 상담 신청이 성공적으로 접수되었습니다.
		<script language=javascript>
			setTimeout('window.close()', 3000);
		</script>
			";
		exit;
?>