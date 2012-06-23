<?
// $mode <- 에디터 모드 (1)텍스트모드, (2)에디터모드
// $editor_Url <- 에디터 경로 ../editor
// $formName <- 폼 이름 <form name="폼이름">
// $contentForm <- 폼 이름2 <textarea name="폼이름2"></textarea>
// $content <- 폼 내용 <textarea>폼 내용</textarea>
// $textWidth <- 폼 width값 (숫자만 입력)
// $textHeight <- 폼 height값 (숫자만 입력)
// $lang <- 랭귀지 [입력값이 없으면 euc-kr]
// $upload_image <- 이미지 업로드 사용 (1은 사용안함)
// $upload_media <- 미디어 업로드 사용 (1은 사용안함)

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


