<?
// $mode <- ������ ��� (1)�ؽ�Ʈ���, (2)�����͸��
// $editor_Url <- ������ ��� ../editor
// $formName <- �� �̸� <form name="���̸�">
// $contentForm <- �� �̸�2 <textarea name="���̸�2"></textarea>
// $content <- �� ���� <textarea>�� ����</textarea>
// $textWidth <- �� width�� (���ڸ� �Է�)
// $textHeight <- �� height�� (���ڸ� �Է�)
// $lang <- ������ [�Է°��� ������ euc-kr]
// $upload_image <- �̹��� ���ε� ��� (1�� ������)
// $upload_media <- �̵�� ���ε� ��� (1�� ������)

function myEditor($mode,$editor_Url,$formName,$contentForm,$textWidth,$textHeight,$lang=''){
	global $content,$upload_image,$upload_media,$msg;

	if(empty($editor_Url)) $editor_Url = '.';
	if(empty($formName)) $formName = 'add_form';
	if(empty($contentForm)) $contentForm = 'content';
	$textWidth = $textWidth ? $textWidth : '100%';
	$textHeight = $textHeight ? $textHeight : '200';
	$lang = $lang ? $lang : 'euc-kr';

	if($mode==1){
		@include_once ($editor_Url.'/editor.php');
	}
	else{
		ECHO "
		<textarea style='width:".$textWidth.";' rows=20 name='".$contentForm."' wrap='physical' style='ime-mode: active' class='input'>".$content."</textarea>
		";
	}
}

?>


