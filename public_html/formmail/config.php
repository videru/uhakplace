<?
###�����κ�####################
$password = "1234"; #�����н�����
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