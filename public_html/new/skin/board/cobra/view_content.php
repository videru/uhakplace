<?
$bd_content = ereg_replace("<P>"," ",$bd_content);
$bd_content = ereg_replace("</P>","<br>",$bd_content);
?>

<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
	<tr><td><?=$bd_content?></td>
	</tr>
</table>
