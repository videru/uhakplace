<?
###수정부분####################
$password = "1234"; #관리패스워드
###############################
function error_back($message) {
echo "<center><font color=blue>$message
		<script language=javascript>
			setTimeout('history.go(-1)', 2000);
		</script>
			"; 
exit; 
}
function error_cls($message) {
echo "<center><font color=blue>$message
		<script language=javascript>
			setTimeout('window.close()', 2000);
		</script>
			"; 
exit; 
}
?>