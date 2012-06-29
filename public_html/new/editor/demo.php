<html>
<head>

<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel='stylesheet' href='./style.css' type='text/css'>
</head>

<?
// 결과
if($_POST['AAAA']==1){
	ECHO stripslashes(trim($content));
	exit;
}
?>

<?
include_once('./func_editor.php');
$content = "test";
// 이미지 업로드 사용 (1은 사용안함)
$upload_image = '';
// 미디어 업로드 사용 (1은 사용안함)
$upload_media = '';
?>
<body>

		<form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="add_form">
		<input type="HIDDEN" NAME="AAAA" value="1">
		<?=myEditor(1,'.','add_form','content','100%','200','utf-8');?>
		<input type="button" value="Submit" onClick="editor_wr_ok();">
		</form>
</body>
</html>
